<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Link;
use App\Models\Menu;
use App\Models\OfficeSetting;
use App\Models\OfficeSettingHeader;
use App\Support\FrontendCache;

class BaseController extends Controller
{
    public function __construct()
    {
        $shared = FrontendCache::remember(function () {
            return [
                'header' => OfficeSetting::with('chief', 'chief.designation', 'informationOfficer', 'informationOfficer.designation')->latest()->first(),
                'sharedLinks' => Link::latest()->limit(5)->get(),
                'sharedMenus' => Menu::with([
                    'menus' => function ($query) {
                        $query->with('model')->whereStatus(1)->orderBy('position');
                    },
                    'model'
                ])
                    ->withCount('menus')
                    ->whereNull('menu_id')
                    ->whereStatus(1)
                    ->orderBy('position', 'asc')
                    ->get(),
                'officeSettingHeaders' => OfficeSettingHeader::orderBy('position', 'asc')->get(),
                // Rotating "important notices" in the header band on every page.
                'headerNotices' => Document::whereStatus(1)
                    ->whereMarkAsNew(1)
                    ->orderByBsPublishedDateDesc()
                    ->limit(10)
                    ->get(['id', 'slug', 'title', 'title_en', 'published_date']),
            ];
        });

        view()->share($shared);
        // Fallback only: the setLanguage middleware shares the visitor's actual language.
        view()->share('language', app()->getLocale());
    }
}
