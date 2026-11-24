<?php

namespace App\Support;

class NepaliNumber
{
    private const ASCII = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    private const NEPALI = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

    /** Digits in the page's language: Nepali digits on Nepali pages, 0-9 on English pages. */
    public static function localize(string|int|null $value): string
    {
        return app()->getLocale() === 'en' ? self::toAscii($value) : self::toNepali($value);
    }

    public static function toNepali(string|int|null $value): string
    {
        return str_replace(self::ASCII, self::NEPALI, (string) $value);
    }

    public static function toAscii(string|int|null $value): string
    {
        return str_replace(self::NEPALI, self::ASCII, (string) $value);
    }

    /** "1.2 MB" style size, digits localized. */
    public static function fileSize(?int $bytes): ?string
    {
        if ($bytes === null) {
            return null;
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $power = $bytes > 0 ? min((int) floor(log($bytes, 1024)), count($units) - 1) : 0;
        $size = round($bytes / (1024 ** $power), $power > 1 ? 1 : 0);

        return self::localize($size) . ' ' . $units[$power];
    }
}
