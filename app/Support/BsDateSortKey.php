<?php

namespace App\Support;

/**
 * Turns a Bikram Sambat date as staff typed it ("२०८३-२-६", "2083/2/6", "2083.02.06")
 * into a zero-padded "2083-02-06" string, so dates sort correctly as plain text.
 */
class BsDateSortKey
{
    private const NEPALI_DIGITS = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

    public static function from(?string $date): ?string
    {
        if ($date === null || trim($date) === '') {
            return null;
        }

        $ascii = str_replace(self::NEPALI_DIGITS, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], $date);

        // Year, month and day in that order, whatever separates them.
        if (!preg_match('/(\d{4})\D+(\d{1,2})\D+(\d{1,2})/', $ascii, $parts)) {
            return null;
        }

        [, $year, $month, $day] = $parts;

        return sprintf('%04d-%02d-%02d', $year, $month, $day);
    }
}
