<?php

namespace App\Console\Commands;

use App\Models\Post;
use Database\Seeders\PostSeeder;
use Illuminate\Console\Command;

/**
 * PostSeeder uses firstOrCreate, so editing the copy in it does nothing to a
 * post that already exists. That is the right default: a deploy should never
 * silently overwrite something edited in the admin.
 *
 * This is the deliberate escape hatch. It reports what would change and writes
 * nothing unless --force is passed, so overwriting live copy is always an
 * explicit act rather than a side effect of running a seeder.
 */
class RefreshPostContent extends Command
{
    protected $signature = 'posts:refresh-content
                            {--force : Actually write the changes}
                            {--slug= : Limit to a single post}';

    protected $description = 'Push edited copy from PostSeeder onto posts that already exist';

    /** Fields worth syncing. Deliberately excludes published_at and is_published. */
    private const FIELDS = ['title', 'author_name', 'excerpt', 'meta_description', 'body', 'faqs'];

    public function handle(): int
    {
        $slug    = $this->option('slug');
        $write   = $this->option('force');
        $changed = 0;
        $missing = 0;

        foreach (PostSeeder::posts() as $data) {
            if ($slug && $data['slug'] !== $slug) {
                continue;
            }

            $post = Post::where('slug', $data['slug'])->first();

            if (! $post) {
                $this->warn("missing  {$data['slug']} (run db:seed --class=PostSeeder first)");
                $missing++;
                continue;
            }

            $diff = [];

            foreach (self::FIELDS as $field) {
                if (! array_key_exists($field, $data)) {
                    continue;
                }

                if ($post->{$field} != $data[$field]) {
                    $diff[$field] = $data[$field];
                }
            }

            if (! $diff) {
                $this->line("same     {$data['slug']}");
                continue;
            }

            $changed++;
            $this->info(($write ? 'updated  ' : 'would    ') . $data['slug'] . '  [' . implode(', ', array_keys($diff)) . ']');

            if ($write) {
                $post->update($diff);
            }
        }

        if ($missing) {
            $this->newLine();
            $this->warn("{$missing} post(s) not found in the database.");
        }

        if ($changed && ! $write) {
            $this->newLine();
            $this->comment("Dry run. Re-run with --force to write {$changed} change(s).");
        }

        return self::SUCCESS;
    }
}
