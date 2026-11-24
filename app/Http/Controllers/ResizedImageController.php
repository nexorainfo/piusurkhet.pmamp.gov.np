<?php

namespace App\Http\Controllers;

use App\Support\ResizedImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class ResizedImageController extends Controller
{
    /**
     * Reached only the first time a size is requested; afterwards the web server
     * serves the saved file from public/storage/resized directly.
     */
    public function __invoke(int $width, string $path)
    {
        $original = Str::beforeLast($path, '.webp');

        abort_unless(in_array($width, ResizedImage::WIDTHS, true), 404);
        abort_unless(ResizedImage::canResize($original), 404);
        abort_unless(Storage::disk('public')->exists($original), 404);

        try {
            $file = ResizedImage::generate($original, $width);
        } catch (Throwable $e) {
            report($e);

            // Fall back to the original rather than showing a broken image.
            return redirect(asset('storage/' . $original));
        }

        return response()->file($file, [
            'Content-Type' => 'image/webp',
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }
}
