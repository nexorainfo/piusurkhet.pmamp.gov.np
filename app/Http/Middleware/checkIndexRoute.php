<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class checkIndexRoute
{

    public function handle(Request $request, Closure $next)
    {

        if ((Route::currentRouteName()=='welcome') && config('default.dual_language') && empty($request->language)){
                $locale = app()->getLocale();
                return redirect(route('welcome', ['language'=>$locale]));
        }

        return $next($request);
    }
}
