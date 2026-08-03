<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public const CATEGORIES = ['Engineering', 'Design', 'AI', 'Process', 'Company'];

    protected $fillable = [
        'title', 'slug', 'category', 'excerpt', 'body', 'faqs', 'cover_image',
        'author_name', 'is_published', 'published_at', 'meta_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'faqs'         => 'array',
    ];

    /**
     * FAQ entries with both a question and an answer. Guards the schema and
     * the rendered block against half-filled rows.
     */
    public function getValidFaqsAttribute(): array
    {
        return collect($this->faqs ?? [])
            ->filter(fn ($faq) => filled($faq['question'] ?? null) && filled($faq['answer'] ?? null))
            ->values()
            ->all();
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');
    }

    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags((string) $this->body));

        return max(1, (int) ceil($words / 200));
    }

    /**
     * Uploaded cover if the post has one, otherwise the generated
     * per-category cover art (public/assets/images/blog/covers/*.svg).
     */
    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }

        return asset('assets/images/blog/covers/' . Str::slug($this->category) . '.svg');
    }
}
