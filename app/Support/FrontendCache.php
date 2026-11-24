<?php

namespace App\Support;

use App\Models\Designation;
use App\Models\DocumentCategory;
use App\Models\Employee;
use App\Models\Link;
use App\Models\Menu;
use App\Models\OfficeDetail;
use App\Models\OfficeSetting;
use App\Models\OfficeSettingHeader;
use App\Models\SubDivision\SubDivision;
use App\Models\Subordinate;
use Closure;
use Illuminate\Support\Facades\Cache;

/**
 * Caches the data every public page needs (office settings, menus, footer links),
 * so it isn't queried again on each request. Saving or deleting any of the models
 * it's built from clears it, so admin edits show up straight away.
 */
class FrontendCache
{
    public const KEY = 'frontend.shared';

    /** Safety net in case a change bypasses model events (e.g. a raw query update). */
    private const TTL_SECONDS = 6 * 60 * 60;

    /** Models whose changes affect the cached data. */
    private const WATCHED_MODELS = [
        OfficeSetting::class,
        OfficeSettingHeader::class,
        Menu::class,
        Link::class,
        Employee::class,      // office chief / information officer
        Designation::class,
        DocumentCategory::class, // menu links point at these by slug
        OfficeDetail::class,
        SubDivision::class,
        Subordinate::class,
    ];

    public static function remember(Closure $callback): array
    {
        return Cache::remember(self::KEY, self::TTL_SECONDS, $callback);
    }

    public static function forget(): void
    {
        Cache::forget(self::KEY);
    }

    public static function flushOnModelChanges(): void
    {
        foreach (self::WATCHED_MODELS as $model) {
            $model::saved(fn () => self::forget());
            $model::deleted(fn () => self::forget());

            if (method_exists($model, 'restored')) {
                $model::restored(fn () => self::forget());
            }
        }
    }
}
