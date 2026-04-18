<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if(config('default.dual_language'))
        {
            return [
                'title' => ['nullable'],
                'title_en' => ['nullable'],
                'photo' => ['required', 'image', 'mimes:png,jpg,jpeg']
            ];
        }
        else
        {
            return [
                'title' => ['nullable'],
                'photo' => ['required', 'image', 'mimes:png,jpg,jpeg']
            ];
        }

    }
}
