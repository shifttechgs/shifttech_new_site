<?php

namespace App\Http\Controllers;

class WorkController extends Controller
{
    /**
     * Portfolio grid. Every card links through to its own case study page.
     */
    public function index()
    {
        return view('work', ['projects' => static::all()]);
    }

    /**
     * Individual case study at /work/{slug}.
     */
    public function show(string $slug)
    {
        $project = config("case-studies.{$slug}");

        abort_if(blank($project), 404);

        $project['slug'] = $slug;

        // Same service type first, so a visitor reading about a mobile app is
        // offered other mobile apps rather than an unrelated website build.
        $related = collect(static::all())
            ->except($slug)
            ->sortByDesc(fn ($p) => $p['service_type'] === $project['service_type'])
            ->take(3)
            ->values()
            ->all();

        return view('work-show', compact('project', 'related'));
    }

    /**
     * All case studies with their slug folded into each entry, so views can
     * build links without carrying the array key around separately.
     */
    public static function all(): array
    {
        return collect(config('case-studies', []))
            ->map(fn (array $project, string $slug) => $project + ['slug' => $slug])
            ->all();
    }
}
