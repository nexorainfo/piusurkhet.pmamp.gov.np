<?php

namespace App\Http\Requests\PhotoGallery;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePhotoGalleryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        if(config('default.dual_language'))
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'slug'=>['alpha_dash','required',Rule::unique('photo_galleries','slug')->withoutTrashed()->ignore($this->photoGallery)],
                'images' => ['nullable', 'array'],
                'images.*' => ['image', 'mimes:jpg,jpeg,png']

            ];
        }
        else
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'slug'=>['alpha_dash','required',Rule::unique('photo_galleries','slug')->withoutTrashed()->ignore($this->photoGallery)],
                'images' => ['nullable', 'array'],
                'images.*' => ['image', 'mimes:jpg,jpeg,png']

            ];
        }

    }
}
