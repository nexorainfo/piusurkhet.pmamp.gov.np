<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SliderController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        abort_if(
            Gate::denies('slider_access'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        $sliders = Slider::latest()->get();

        return view('admin.slider.index', compact('sliders'));
    }


    public function store(StoreSliderRequest $request)
    {
        abort_if(
            Gate::denies('slider_create'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        Slider::create($request->validated());

        toast('Slider Added Successfully', 'success');

        return back();
    }

    public function edit(Slider $slider)
    {
        abort_if(
            Gate::denies('slider_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        return view('admin.slider.edit', compact('slider'));
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        abort_if(
            Gate::denies('slider_edit'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if ($request->hasFile('photo')) {
            if ($slider->photo) {
                $this->deleteFile($slider->getRawOriginal('photo'));
            }
        }

        $slider->update($request->validated());

        toast('Slider Updated Successfully', 'success');

        return redirect(route('admin.slider.index'));
    }

    public function destroy(Slider $slider)
    {
        abort_if(
            Gate::denies('slider_delete'),
            ResponseAlias::HTTP_FORBIDDEN,
            '403 Forbidden | you are not allowed to access this resource'
        );

        if ($slider->photo) {
            $this->deleteFile($slider->getRawOriginal('photo'));
        }

        $slider->delete();

        toast('Slider Deleted Successfully', 'success');

        return redirect(route('admin.slider.index'));
    }
}
