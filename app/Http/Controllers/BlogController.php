<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()->paginate(9);

        return view('blog', compact('posts'));
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published && $post->published_at <= now(), 404);

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->first();

        return view('blog-show', compact('post', 'related'));
    }
}
