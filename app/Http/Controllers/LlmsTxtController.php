<?php

namespace App\Http\Controllers;

use App\Models\Post;

class LlmsTxtController extends Controller
{
    public function index()
    {
        $posts = Post::published()->get();

        return response()
            ->view('llms-txt', [
                'posts'       => $posts,
                'caseStudies' => WorkController::all(),
            ])
            ->header('Content-Type', 'text/plain');
    }
}
