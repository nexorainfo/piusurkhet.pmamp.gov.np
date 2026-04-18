<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SampleCollection\StoreSampleCollectionRequest;
use App\Http\Requests\SampleCollection\UpdateSampleCollectionRequest;
use App\Models\SampleCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SampleCollectionController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('sample_collection_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $sampleCollections = SampleCollection::latest()->get();

        return view('admin.sampleCollection.index', compact('sampleCollections'));
    }



    public function show(SampleCollection $sampleCollection)
    {
        abort_if(
            Gate::denies('sample_collection_show'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        return view('admin.sampleCollection.show', compact('sampleCollection'));
    }

    public function update(UpdateSampleCollectionRequest $request, SampleCollection $sampleCollection)
    {
        $sampleCollection->update($request->validated());

        toast('Sample collection Updated Successfully', 'success');

        return back();
    }

    public function destroy(SampleCollection $sampleCollection)
    {
        abort_if(
            Gate::denies('sample_collection_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $sampleCollection->delete();

        toast('Sample collection Deleted Successfully', 'success');

        return back();
    }


    public function showOnIndex(SampleCollection $sampleCollection): RedirectResponse
    {

        $sampleCollection->update([
            'show_on_index' => !$sampleCollection->show_on_index
        ]);

        toast('Status Updated Successfully', 'success');
        return back();
    }
}
