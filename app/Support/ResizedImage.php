<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use RuntimeException;

/**
 * Resized WebP copies of images uploaded to the public disk.
 *
 * A copy lives at storage/app/public/resized/{width}/{original path}.webp, which is
 * public at /storage/resized/{width}/{original path}.webp. The first request for a
 * size that doesn't exist yet reaches Laravel, which makes it; after that the web
 * server serves the file directly. Originals are never changed or upscaled.
 */
class ResizedImage
{
    /** The only widths we generate, so nobody can make the server create endless sizes. */
    public const WIDTHS = [160, 320, 640, 960, 1280, 1920];

    private const QUALITY = 82;

    private const RESIZABLE = ['jpg', 'jpeg', 'png', 'webp'];

    public static function canResize(?string $path): bool
    {
        return !empty($path)
            && !str_contains($path, '..')
            && !preg_match('#^(https?:)?//#', $path)
            && in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), self::RESIZABLE, true);
    }

    public static function url(string $path, int $width): string
    {
        return asset('storage/resized/' . $width . '/' . ltrim($path, '/') . '.webp');
    }

    /** @param int[] $widths */
    public static function srcset(string $path, array $widths): string
    {
        return collect($widths)
            ->map(fn (int $width) => self::url($path, $width) . ' ' . $width . 'w')
            ->implode(', ');
    }

    public static function cachePath(string $path, int $width): string
    {
        return 'resized/' . $width . '/' . ltrim($path, '/') . '.webp';
    }

    /**
     * Make (if needed) the resized copy and return its absolute file path.
     */
    public static function generate(string $path, int $width): string
    {
        $disk = Storage::disk('public');
        $target = self::cachePath($path, $width);

        if ($disk->exists($target)) {
            return $disk->path($target);
        }

        $source = $disk->path($path);
        $image = self::load($source);

        if (imagesx($image) > $width) {
            $resized = imagescale($image, $width, -1, IMG_BICUBIC);
            imagedestroy($image);
            $image = $resized;
        }

        imagealphablending($image, false);
        imagesavealpha($image, true);

        $absoluteTarget = $disk->path($target);
        if (!is_dir(dirname($absoluteTarget))) {
            mkdir(dirname($absoluteTarget), 0775, true);
        }

        // Write to a temporary file first so a half-written image is never served.
        $temporary = $absoluteTarget . '.' . uniqid('', true) . '.tmp';
        imagewebp($image, $temporary, self::QUALITY);
        imagedestroy($image);
        rename($temporary, $absoluteTarget);

        return $absoluteTarget;
    }

    /** @return \GdImage */
    private static function load(string $source)
    {
        $type = @getimagesize($source)[2] ?? null;

        $image = match ($type) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($source),
            IMAGETYPE_PNG => @imagecreatefrompng($source),
            IMAGETYPE_WEBP => @imagecreatefromwebp($source),
            default => false,
        };

        if (!$image) {
            throw new RuntimeException("Can't read image {$source}");
        }

        if (!imageistruecolor($image)) {
            imagepalettetotruecolor($image);
        }

        // Phone photos are often stored sideways with a rotation flag; apply it.
        if ($type === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
            $orientation = @exif_read_data($source)['Orientation'] ?? 1;
            $angle = match ((int) $orientation) {
                3 => 180,
                6 => -90,
                8 => 90,
                default => 0,
            };
            if ($angle !== 0) {
                $rotated = imagerotate($image, $angle, 0);
                imagedestroy($image);
                $image = $rotated;
            }
        }

        return $image;
    }
}
