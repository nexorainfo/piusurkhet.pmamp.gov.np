<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoGallery\StorePhotoGalleryRequest;
use App\Http\Requests\PhotoGallery\UpdatePhotoGalleryRequest;
use App\Models\Photo;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PhotoGalleryController extends BaseController
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

        $photoGalleries = PhotoGallery::get();
        return view('admin.photoGallery.index',compact('photoGalleries'));
    }


    public function store(StorePhotoGalleryRequest $request)
    {
        abort_if(
            Gate::denies('photoGallery_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        DB::transaction(function () use ($request) {
            $photoGallery = PhotoGallery::create($request->validated());

            $this->uploadPhotos($request, $photoGallery);
        });

        toast('PhotoGallery Added Successfully', 'success');

        return back();

    }


    public function show(PhotoGallery $photoGallery)
    {
        abort_if(
            Gate::denies('photoGallery_show'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $photoGallery->load('photos');
        return view('admin.photoGallery.show',compact('photoGallery'));
    }


    public function edit(PhotoGallery $photoGallery)
    {
        abort_if(
            Gate::denies('photoGallery_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.photoGallery.edit',compact('photoGallery'));
    }


    public function update(UpdatePhotoGalleryRequest $request, PhotoGallery $photoGallery)
    {
        abort_if(
            Gate::denies('photoGallery_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        DB::transaction(function () use ($request, $photoGallery) {
            $photoGallery->update($request->validated());
            $this->uploadPhotos($request, $photoGallery);
        });
        toast('PhotoGallery Updated Successfully', 'success');
        return redirect(route('admin.photoGallery.index'));
    }

    public function destroy(PhotoGallery $photoGallery)
    {
        abort_if(
            Gate::denies('photoGallery_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

       foreach ($photoGallery->photos as $photo)
       {
           $this->deleteFile($photo->images);
       }
       $photoGallery->photos()->delete();
       $photoGallery->delete();
       toast('PhotoGallery Deleted Successfully', 'success');
       return back();
    }

    public function uploadPhotos($request, $photoGallery)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $photo) {
                $photoGallery->photos()->create([
                    'images' => $photo->store('photo_galleries/' . Str::slug($photoGallery->title, "_"), 'public'),
                ]);
            }
        }
    }

    public function deletePhoto(Photo $photo)
    {

        $this->deleteFile($photo->images);

        toast('Photo Deleted Successfully', 'success');

        $photo->delete();

        return back();
    }

}
