@props([])

<p {{ $attributes->merge(['class' => 'eyebrow']) }}>{{ $slot }}</p>
