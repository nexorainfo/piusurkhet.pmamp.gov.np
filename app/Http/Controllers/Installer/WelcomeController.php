<?php

namespace App\Http\Controllers\Installer;

use Illuminate\Routing\Controller;

class WelcomeController extends Controller
{

    public function welcome()
    {
//         dd(config('install.core.minPhpVersion'));
        return view('installer.welcome');
    }
}
