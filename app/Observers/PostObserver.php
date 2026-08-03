<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\IndexNowService;

class PostObserver
{
    public function created(Post $post): void
    {
        if ($post->is_published) {
            IndexNowService::submit(url('/blog/' . $post->slug));
        }
    }

    /**
     * Fires when a post goes live and also when live copy changes.
     *
     * This previously required wasChanged('is_published'), so rewriting a
     * published post never pinged anything. That defeats the point: IndexNow
     * exists to get changed content recrawled quickly, and a rewrite is
     * exactly the case where that matters.
     */
    public function updated(Post $post): void
    {
        if (! $post->is_published) {
            return;
        }

        $signals = ['is_published', 'title', 'excerpt', 'meta_description', 'body', 'faqs'];

        if ($post->wasChanged($signals)) {
            IndexNowService::submit(url('/blog/' . $post->slug));
        }
    }
}
