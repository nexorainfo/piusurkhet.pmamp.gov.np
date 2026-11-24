{{--
    Responsive image from the public disk: the browser picks a resized WebP that fits.
    path     - path on the public disk, e.g. "slider/abc.jpg" (not a full URL)
    widths   - sizes to offer, from App\Support\ResizedImage::WIDTHS
    sizes    - how wide the image shows on screen, e.g. "(min-width: 992px) 66vw, 100vw"
    fallback - URL to show when there is no path (e.g. a placeholder avatar)
    eager    - true for the main image at the top of the page
--}}
@props([
    'path' => null,
    'widths' => [320, 640, 960],
    'sizes' => '100vw',
    'alt' => '',
    'fallback' => null,
    'eager' => false,
])

@php
    $resizable = \App\Support\ResizedImage::canResize($path);
    $src = $resizable
        ? \App\Support\ResizedImage::url($path, $widths[(int) floor((count($widths) - 1) / 2)])
        : ($path ? asset('storage/' . $path) : $fallback);
@endphp

@if ($src)
    <img src="{{ $src }}"
        @if ($resizable) srcset="{{ \App\Support\ResizedImage::srcset($path, $widths) }}" sizes="{{ $sizes }}" @endif
        alt="{{ $alt }}" decoding="async"
        @if ($eager) fetchpriority="high" @else loading="lazy" @endif
        {{ $attributes }}>
@endif
