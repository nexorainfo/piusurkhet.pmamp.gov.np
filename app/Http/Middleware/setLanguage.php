<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class setLanguage
{

    public function handle(Request $request, Closure $next)
    {
        if (config('default.dual_language')) {
            if (!empty($request->language) && in_array($request->language, config('app.locales'))) {
//                session(['language' => $request->language]);
                Cache::put('language', $request->language, 60*60*12);
                app()->setLocale($request->language);
            }
            elseif(Cache::has('language')){
//                session(['language' => session('language')]);
                app()->setLocale(Cache::has('language'));
            } else{
                Cache::put('language', 'ne', 60*60*12);
                app()->setLocale('ne');
            }
        }
        return $next($request);
    }
}
