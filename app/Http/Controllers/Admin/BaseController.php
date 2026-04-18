<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use App\Models\OfficeSetting;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct()
    {
        $sharedDocumentCategories = DocumentCategory::whereNull('document_category_id')->orderBy('position')->get();
        view()->share('sharedDocumentCategories', $sharedDocumentCategories);
    }
}
