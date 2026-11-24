<?php

namespace App\Http\Middleware;

use App\Support\SiteLanguage;
use Closure;
use Illuminate\Http\Request;

class setLanguage
{
    public function handle(Request $request, Closure $next)
    {
        if (config('default.dual_language')) {
            $language = SiteLanguage::fromRequest($request);

            $request->session()->put(SiteLanguage::SESSION_KEY, $language);
            app()->setLocale($language);

            // Many views check request()->language, so make sure it's always set.
            $request->merge(['language' => $language]);

            // Used by views to build links that keep the current language.
            view()->share('language', $language);
        }

        return $next($request);
    }
}
