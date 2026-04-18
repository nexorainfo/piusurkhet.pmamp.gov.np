<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DocumentCategory\StoreDocumentCategoryRequest;
use App\Http\Requests\DocumentCategory\UpdateDocumentCategoryRequest;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DocumentCategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('document_category_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $documentCategories = DocumentCategory::whereNull('document_category_id')->orderBy('position')->get();

        return view('admin.documents.main_category.index', compact('documentCategories'));

    }

    public function store(StoreDocumentCategoryRequest $request)
    {

        abort_if(
            Gate::denies('document_category_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        DocumentCategory::create($request->validated());

        toast('Category Stored Successfully', 'success');

        return redirect(route('admin.documentCategory.index'));
    }

    public function edit(DocumentCategory $documentCategory)
    {
        abort_if(
            Gate::denies('document_category_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.documents.main_category.edit', compact('documentCategory'));
    }

    public function update(UpdateDocumentCategoryRequest $request, DocumentCategory $documentCategory)
    {
        abort_if(
            Gate::denies('document_category_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $documentCategory->update($request->validated());

        toast('Category Updated Successfully', 'success');

        return redirect(route('admin.documentCategory.index'));
    }

    public function destroy(DocumentCategory $documentCategory)
    {

        abort_if(
            Gate::denies('document_category_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $documentCategory->documentCategories()->delete();

        $documentCategory->delete();

        toast('Category Deleted Successfully', 'success');
        return back();
    }

    public function showOnIndex(DocumentCategory $documentCategory)
    {
        abort_if(
            Gate::denies('document_category_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $documentCategory->update([
            'show_on_index' => !$documentCategory->show_on_index
        ]);

        toast('Status Updated Successfully', 'success');

        return back();
    }
}
