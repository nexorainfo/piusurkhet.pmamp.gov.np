<?php

namespace App\Providers;

use App\Models\DocumentCategory;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\OfficeDetail;
use App\Models\OfficeSettingHeader;
use App\Models\SubDivision\SubDivisionEmployee;
use App\Observers\DocumentCategoryObserver;
use App\Observers\EmployeeObserver;
use App\Observers\MenuObserver;
use App\Observers\OfficeDetailObserver;
use App\Observers\OfficeSettingHeaderObserver;
use App\Observers\SubDivisionEmployeeObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        JsonResource::withoutWrapping();

        Model::preventLazyLoading();
        Employee::observe(EmployeeObserver::class);
        Menu::observe(MenuObserver::class);
        OfficeDetail::observe(OfficeDetailObserver::class);
        SubDivisionEmployee::observe(SubDivisionEmployeeObserver::class);
        DocumentCategory::observe(DocumentCategoryObserver::class);
        OfficeSettingHeader::observe(OfficeSettingHeaderObserver::class);
    }
}
