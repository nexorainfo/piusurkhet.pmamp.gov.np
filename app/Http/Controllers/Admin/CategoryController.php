<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\DocumentCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(DocumentCategory $documentCategory)
    {
        abort_if(
            Gate::denies('category_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $documentCategory->load('documentCategories');

        return view('admin.documents.category.index', compact('documentCategory'));
    }

    public function store(StoreCategoryRequest $request, DocumentCategory $documentCategory)
    {
        abort_if(
            Gate::denies('category_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $documentCategory->documentCategories()->create($request->validated());

        toast("Category Stored Successfully", 'success');

        return back();
    }


    public function edit(DocumentCategory $documentCategory, DocumentCategory $category)
    {
        abort_if(
            Gate::denies('category_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        return view('admin.documents.category.edit', compact('documentCategory', 'category')); //
    }

    public function update(UpdateCategoryRequest $request, DocumentCategory $documentCategory, DocumentCategory $category)
    {
        abort_if(
            Gate::denies('category_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $category->update($request->validated());

        toast("Category Updated Successfully", 'success');

        return redirect(route('admin.documentCategory.category.index', $documentCategory));
    }

    public function destroy(DocumentCategory $documentCategory, DocumentCategory $category)
    {
        abort_if(
            Gate::denies('category_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $category->delete();
        toast("Category Deleted Successfully", 'success');
        return back();
    }

    public function showOnIndex(DocumentCategory $documentCategory, DocumentCategory $category)
    {
        $category->update([
            'show_on_index' => !$category->show_on_index
        ]);

        toast('Status Updated Successfully', 'success');

        return back();
    }
}
