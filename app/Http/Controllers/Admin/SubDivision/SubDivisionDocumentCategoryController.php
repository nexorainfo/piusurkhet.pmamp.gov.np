<?php

namespace App\Http\Controllers\Admin\SubDivision;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubDivisionDocumentCategoryRequest;
use App\Http\Requests\UpdateSubDivisionDocumentCategoryRequest;
use App\Models\SubDivision\SubDivisionDocumentCategory;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubDivisionDocumentCategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('subDivision_document_category_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id)) {
            abort(401);
        }

        $subDivisionDocumentCategories = SubDivisionDocumentCategory::where('sub_division_id', auth()->user()->sub_division_id)->latest()->get();

        return view('admin.subDivision.documents.category.index', compact('subDivisionDocumentCategories'));
    }


    public function store(StoreSubDivisionDocumentCategoryRequest $request)
    {
        abort_if(
            Gate::denies('subDivision_document_category_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id)) {
            abort(401);
        }

        SubDivisionDocumentCategory::create($request->validated() + ['sub_division_id' => auth()->user()->sub_division_id]);

        toast('Sub Division Document Category Stored Successfully', 'success');
        return redirect(route('admin.subDivisionDocumentCategory.index'));
    }

    public function show(SubDivisionDocumentCategory $subDivisionDocumentCategory)
    {
        abort_if(
            Gate::denies('subDivision_document_category_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionDocumentCategory->sub_division_id) {
            abort(401);
        }
    }

    public function edit(SubDivisionDocumentCategory $subDivisionDocumentCategory)
    {
        abort_if(
            Gate::denies('subDivision_document_category_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionDocumentCategory->sub_division_id) {
            abort(401);
        }

        return view('admin.subDivision.documents.category.edit', compact('subDivisionDocumentCategory'));
    }

    public function update(UpdateSubDivisionDocumentCategoryRequest $request, SubDivisionDocumentCategory $subDivisionDocumentCategory)
    {
        abort_if(
            Gate::denies('subDivision_document_category_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionDocumentCategory->sub_division_id) {
            abort(401);
        }
        $subDivisionDocumentCategory->update($request->validated());
        toast('Sub Division Document Category Stored Successfully', 'success');
        return redirect(route('admin.subDivisionDocumentCategory.index'));
    }

    public function destroy(SubDivisionDocumentCategory $subDivisionDocumentCategory)
    {
        abort_if(
            Gate::denies('subDivision_document_category_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionDocumentCategory->sub_division_id) {
            abort(401);
        }
        $subDivisionDocumentCategory->delete();
        toast('Sub Division Document Category Stored Successfully', 'success');
        return redirect(route('admin.subDivisionDocumentCategory.index'));
    }
}
