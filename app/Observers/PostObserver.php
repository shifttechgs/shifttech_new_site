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

    public function updated(Post $post): void
    {
        if ($post->is_published && $post->wasChanged('is_published')) {
            IndexNowService::submit(url('/blog/' . $post->slug));
        }
    }
}
