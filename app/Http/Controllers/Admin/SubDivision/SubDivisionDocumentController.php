<?php

namespace App\Http\Controllers\Admin\SubDivision;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\StoreSubDivisionDocumentRequest;
use App\Http\Requests\UpdateSubDivisionDocumentRequest;
use App\Models\SubDivision\SubDivisionDocument;
use App\Models\SubDivision\SubDivisionDocumentCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubDivisionDocumentController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('subDivision_document_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id)) {
            abort(401);
        }

        $subDivisionDocuments = SubDivisionDocument::with('subDivisionDocumentCategory')->where('sub_division_id', auth()->user()->sub_division_id)->latest()->get();
        return view('admin.subDivision.documents.index', compact('subDivisionDocuments'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('subDivision_document_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id)) {
            abort(401);
        }
        $subDivisionDocumentCategories = SubDivisionDocumentCategory::where('sub_division_id', auth()->user()->sub_division_id)->latest()->get();
        return view('admin.subDivision.documents.create', compact('subDivisionDocumentCategories'));
    }

    public function store(StoreSubDivisionDocumentRequest $request)
    {
        abort_if(
            Gate::denies('subDivision_document_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id)) {
            abort(401);
        }

        \DB::transaction(function () use ($request) {
            $subDivisionDocument = SubDivisionDocument::create($request->validated() + [
                    'sub_division_id' => auth()->user()->sub_division_id,
                ]);
            $this->addAdditionalFile($request, $subDivisionDocument);
        });
        toast('Sub Division Document  Stored Successfully', 'success');
        return redirect(route('admin.subDivisionDocument.index'));
    }

    public function show(SubDivisionDocument $subDivisionDocument)
    {
        abort_if(
            Gate::denies('subDivision_document_show'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionDocument->sub_division_id) {
            abort(401);
        }
        $subDivisionDocument->load('files');
        return view('admin.subDivision.documents.show', compact('subDivisionDocument'));
    }

    public function edit(SubDivisionDocument $subDivisionDocument)
    {
        abort_if(
            Gate::denies('subDivision_document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionDocument->sub_division_id) {
            abort(401);
        }
        $subDivisionDocumentCategories = SubDivisionDocumentCategory::where('sub_division_id', auth()->user()->sub_division_id)->latest()->get();
        return view('admin.subDivision.documents.edit', compact('subDivisionDocumentCategories', 'subDivisionDocument'));
    }

    public function update(UpdateSubDivisionDocumentRequest $request, SubDivisionDocument $subDivisionDocument)
    {
        abort_if(
            Gate::denies('subDivision_document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionDocument->sub_division_id) {
            abort(401);
        }
        DB::transaction(function () use ($request, $subDivisionDocument) {
            $subDivisionDocument->update($request->validated());
            $this->addAdditionalFile($request, $subDivisionDocument);
        });

        toast('Sub Division Document Updated Successfully', 'success');
        return redirect(route('admin.subDivisionDocument.index'));
    }

    public function destroy(SubDivisionDocument $subDivisionDocument)
    {
        abort_if(
            Gate::denies('subDivision_document_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionDocument->sub_division_id) {
            abort(401);
        }

        foreach ($subDivisionDocument->files as $file) {
            $this->deleteFile($file->url);
        }
        $subDivisionDocument->delete();
        toast('Sub Division Document Deleted Successfully', 'success');
        return redirect(route('admin.subDivisionDocument.index'));
    }

    public function addAdditionalFile($request, $subDivisionDocument)
    {
        abort_if(
            Gate::denies('subDivision_document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if (empty(auth()->user()->sub_division_id) && auth()->user()->sub_division_id != $subDivisionDocument->sub_division_id) {
            abort(401);
        }
        foreach ($request->file('files') as $file) {
            $file_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $subDivisionDocument->files()->create([
                'url' => $file->store($subDivisionDocument->title . '/' . $subDivisionDocument->title . '/sub_division'
                    , 'public'),
                'original_name' => $file_name,
                'extension' => $extension,
            ]);
        }
    }

    public function markAsNew(SubDivisionDocument $subDivisionDocument)
    {
        abort_if(
            Gate::denies('subDivision_document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $subDivisionDocument->update([
            'mark_as_new' => !$subDivisionDocument->mark_as_new
        ]);
        toast('Sub Division MarkAsNew Updated', 'success');
        return back();
    }

    public function updateStatus(SubDivisionDocument $subDivisionDocument)
    {
        abort_if(
            Gate::denies('subDivision_document_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $subDivisionDocument->update([
            'status' => !$subDivisionDocument->status
        ]);
        toast('Sub Division Status Updated', 'success');
        return back();
    }

}
