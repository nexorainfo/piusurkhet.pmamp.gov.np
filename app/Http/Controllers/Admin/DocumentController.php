<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Requests\Document\UpdateDocumentRequest;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DocumentController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(DocumentCategory $documentCategory)
    {
        abort_if(
            Gate::denies('document_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $documentCategory->load(['mainDocuments' => function ($query) {
            $query->orderByDesc('published_date');
        }]);

        return view('admin.documents.document.index', compact('documentCategory'));
    }

    public function create(DocumentCategory $documentCategory)
    {
        abort_if(
            Gate::denies('document_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $documentCategory->load('documentCategories');

        return view('admin.documents.document.create', compact('documentCategory'));
    }

    public function store(StoreDocumentRequest $request, DocumentCategory $documentCategory)
    {
        abort_if(
            Gate::denies('document_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        DB::transaction(function () use ($request, $documentCategory) {
            $document = $documentCategory->mainDocuments()->create($request->validated());

            $this->uploadFiles($request, $documentCategory, $document);

        });
        toast($documentCategory->title . "Stored Successfully", 'success');

        return redirect(route('admin.documentCategory.document.index',$documentCategory));
    }

    public function show(DocumentCategory $documentCategory, Document $document)
    {
        abort_if(
            Gate::denies('document_show'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $document->load('files');
        return view('admin.documents.document.show',compact('documentCategory','document'));
    }

    public function edit(DocumentCategory $documentCategory, Document $document)
    {
        abort_if(
            Gate::denies('document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.documents.document.edit', compact('documentCategory','document'));
    }

    public function update(UpdateDocumentRequest $request, DocumentCategory $documentCategory, Document $document)
    {
        abort_if(
            Gate::denies('document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        DB::transaction(function () use ($request, $documentCategory,$document) {
            $document->update($request->validated());
            $this->uploadFiles($request, $documentCategory, $document);

        });
        toast($documentCategory->title . " Updated Successfully", 'success');
        return redirect(route('admin.documentCategory.document.index',$documentCategory));
    }

    public function destroy(DocumentCategory $documentCategory, Document $document)
    {
        abort_if(
            Gate::denies('document_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        foreach ($document->files as $file) {
            if ($file->url) {
                $this->deleteFile($file->url);
            }
        }
        $document->delete();

        toast($documentCategory->title . " Deleted Successfully", 'success');

        return back();
    }

    public function markAsNew(DocumentCategory $documentCategory, Document $document)
    {
        abort_if(
            Gate::denies('document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $document->update([
            'mark_as_new' => !$document->mark_as_new
        ]);

        toast('Updated Successfully', 'success');

        return back();
    }

    public function updateStatus(DocumentCategory $documentCategory, Document $document)
    {
        abort_if(
            Gate::denies('document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $document->update([
            'status' => !$document->status
        ]);

        toast('Updated Successfully', 'success');

        return back();
    }

    public function popUp(DocumentCategory $documentCategory, Document $document)
    {
        abort_if(
            Gate::denies('document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $document->update([
            'popUp' => !$document->popUp
        ]);

        toast('Updated Successfully', 'success');

        return back();
    }

    public function uploadFiles($request, $documentCategory, $document)
    {
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $document->files()->create([
                    'original_name' => $file_name,
                    'extension' => $extension,
                    'url' => $file->store(
                        $documentCategory->slug . '/' . $document->slug . '/file'
                        , 'public'
                    ),
                ]);
            }
        }
    }
}
