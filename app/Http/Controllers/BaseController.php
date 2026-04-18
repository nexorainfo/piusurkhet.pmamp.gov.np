<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Ip;
use App\Models\Link;
use App\Models\Menu;
use App\Models\OfficeSetting;
use App\Models\OfficeSettingHeader;
use Illuminate\Support\Facades\Cache;

class BaseController extends Controller
{
    public function __construct()
    {
        $sharedLinks = Link::latest()->limit(5)->get();
        $header = OfficeSetting::with('chief', 'chief.designation', 'informationOfficer', 'informationOfficer.designation')->latest()->first();

        $sharedMenus = Menu::with([
            'menus' => function ($query) {
                $query->with('model')->whereStatus(1)->orderBy('position');
            },
            'model'
        ])
            ->withCount('menus')
            ->whereNull('menu_id')
            ->whereStatus(1)
            ->orderBy('position', 'asc')
            ->get();

        view()->share('header', $header);
        view()->share('sharedLinks', $sharedLinks);
        view()->share('sharedMenus', $sharedMenus);
//        dd(session());
        view()->share('language', Cache::get('language') ?? $_GET['language'] ?? 'ne');
        view()->share('totalVisitors', Ip::distinct('ip_address')->count());
        view()->share('colors',Color::first());
        view()->share('officeSettingHeaders',OfficeSettingHeader::orderBy('position','asc')->get());
    }
}
