<?php

namespace App\Http\Middleware;

use App\Support\SiteLanguage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class checkIndexRoute
{

    public function handle(Request $request, Closure $next)
    {

        if ((Route::currentRouteName()=='welcome') && config('default.dual_language') && empty($request->language)){
                return redirect(route('welcome', ['language' => SiteLanguage::fromRequest($request)]));
        }

        return $next($request);
    }
}
