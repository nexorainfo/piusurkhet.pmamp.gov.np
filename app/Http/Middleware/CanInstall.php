<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanInstall
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->alreadyInstalled()) {
            $installedRedirect = config('install.installedAlreadyAction');

            switch ($installedRedirect) {

                case 'route':
                    $routeName = config('install.installed.redirectOptions.route.name');
                    $data = config('install.installed.redirectOptions.route.message');

                    return redirect()->route($routeName)->with(['data' => $data]);
                    break;

                case 'abort':
                    abort(config('install.installed.redirectOptions.abort.type'));
                    break;

                case 'dump':
                    $dump = config('install.installed.redirectOptions.dump.data');
                    dd($dump);
                    break;

                case '404':
                case 'default':
                default:
                    abort(404);
                    break;
            }
        }
        return $next($request);
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }
}
