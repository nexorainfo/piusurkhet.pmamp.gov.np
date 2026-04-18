<?php

namespace App\Http\Middleware;

use App\Models\Ip;
use Closure;
use Illuminate\Http\Request;

class IpMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        Ip::create([
            'ip_address' => $request->ip()
        ]);

        return $next($request);
    }
}
