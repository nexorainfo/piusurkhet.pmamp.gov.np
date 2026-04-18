<?php

namespace App\Http\Requests\VideoGallery;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoGalleryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'url' => ['required', 'url']
        ];
    }
}
