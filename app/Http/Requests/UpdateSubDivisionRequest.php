<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubDivisionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if(config('default.dual_language'))
        {
            return [
                'title' => ['required'],
                'title_en' => ['required'],
                'slug' => ['required', 'alpha_dash', Rule::unique('sub_divisions', 'slug')->withoutTrashed()->ignore($this->subDivision)],
                'email' => ['required', 'email'],
                'phone' => ['required'],
                'introduction' => ['nullable'],
                'introduction_en' => ['nullable'],
                'map' => ['nullable', 'url'],
                'facebook' => ['nullable', 'url'],
            ];
        }
        else
        {
            return [
                'title' => ['required'],
                'slug' => ['required', 'alpha_dash', Rule::unique('sub_divisions', 'slug')->withoutTrashed()->ignore($this->subDivision)],
                'email' => ['required', 'email'],
                'phone' => ['required'],
                'introduction' => ['nullable'],
                'map' => ['nullable', 'url'],
                'facebook' => ['nullable', 'url'],
            ];
        }

    }
}
