<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VideoGallery\StoreVideoGalleryRequest;
use App\Http\Requests\VideoGallery\UpdateVideoGalleryRequest;
use App\Models\VideoGallery;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class VideoGalleryController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('photoGallery_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $videoGalleries = VideoGallery::get();
        return view('admin.videoGallery.index', compact('videoGalleries'));
    }

    public function store(StoreVideoGalleryRequest $request)
    {
        abort_if(
            Gate::denies('photoGallery_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        VideoGallery::create($request->validated());

        toast('VideoGallery Added Successfully', 'success');

        return back();

    }

    public function edit(VideoGallery $videoGallery)
    {
        abort_if(
            Gate::denies('photoGallery_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.videoGallery.edit', compact('videoGallery'));
    }

    public function update(UpdateVideoGalleryRequest $request, VideoGallery $videoGallery)
    {
        abort_if(
            Gate::denies('photoGallery_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );
        $videoGallery->update($request->validated());

        toast('VideoGallery Updated Successfully', 'success');

        return redirect(route('admin.videoGallery.index'));

    }

    public function destroy(VideoGallery $videoGallery)
    {
        abort_if(
            Gate::denies('photoGallery_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $videoGallery->delete();
        return back();
    }
}
