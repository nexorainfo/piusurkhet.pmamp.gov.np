<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if(config('default.dual_language')){
        return [
           'title'=>['required','string'],
            'title_en'=>['required','string'],
            'url'=>['required','url']
        ];
        }
        else
        {
            return [
                'title'=>['required','string'],
                'url'=>['required','url']
            ];
        }
    }
}
