<?php

namespace App\Http\Requests\Subordinate;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubordinateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>['required','string','max:200'],
            'title_en'=>['required','string','max:200'],
            'logo'=>['nullable','image'],
            'url'=>['required','url'],
            'phone'=>['nullable','integer','min:10'],
            'email'=>['nullable','email'],
        ];
    }
}
