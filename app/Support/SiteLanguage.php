<?php

namespace App\Support;

use Illuminate\Http\Request;

/**
 * The public site's language for the current visitor.
 *
 * Order: ?language= in the URL, then the visitor's own session, then the default.
 * It's kept in the session (one per visitor). It used to be kept in the shared cache,
 * so one visitor switching language changed it for everyone.
 */
class SiteLanguage
{
    public const SESSION_KEY = 'language';

    public static function fromRequest(Request $request): string
    {
        $requested = $request->query('language');
        if (self::isSupported($requested)) {
            return $requested;
        }

        $saved = $request->hasSession() ? $request->session()->get(self::SESSION_KEY) : null;

        return self::isSupported($saved) ? $saved : config('app.locale', 'ne');
    }

    public static function isSupported(mixed $language): bool
    {
        return is_string($language) && in_array($language, config('app.locales', ['ne', 'en']), true);
    }
}
