<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\DocumentCategory;
use App\Models\Employee;
use App\Models\PhotoGallery;
use App\Models\Slider;
use App\Models\Smuggling;
use App\Models\SubDivision\SubDivisionDocument;
use App\Models\SubDivision\SubDivisionEmployee;

class DashboardController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        $employeeCount = !empty(auth()->user()->sub_division_id) ? SubDivisionEmployee::where('sub_division_id', auth()->user()->sub_division_id)->count() : Employee::count();
        $photoGalleryCount = !empty(auth()->user()->sub_division_id)
            ? Smuggling::where('sub_division_id', auth()->user()->sub_division_id)->count()
            : PhotoGallery::count();
        $sliderCount = Slider::count();
        $billCount = Bill::count();
        $documentCategories = empty(auth()->user()->sub_division_id) ? DocumentCategory::withCount('mainDocuments')->whereNull('document_category_id')->get() : collect();
        $subDivisionDocumentCount = config('default.subDivision')
            ? SubDivisionDocument::where('sub_division_id', auth()->user()->sub_division_id)->count()
            : 0;

        return view('dashboard', compact('employeeCount', 'photoGalleryCount', 'sliderCount', 'billCount', 'documentCategories', 'subDivisionDocumentCount'));
    }

}
