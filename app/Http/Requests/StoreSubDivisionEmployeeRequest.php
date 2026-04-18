<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubDivisionEmployeeRequest extends FormRequest
{

    public function authorize()
    {
        return \Gate::allows('subDivision_employee_create');
    }

    public function rules()
    {
        if(config('default.dual_language'))
        {
            return [
                'name' => ['required'],
                'name_en' => ['required'],
                'photo' => ['nullable', 'image'],
                'department' => ['nullable'],
                'department_en' => ['nullable'],
                'designation' => ['required'],
                'designation_en' => ['required'],
                'level' => ['nullable'],
                'leve_en' => ['nullable'],
                'phone' => ['nullable'],
                'email' => ['nullable'],
                'address' => ['nullable'],
                'address_en' => ['nullable'],
                'position' => ['nullable', 'integer'],
                'is_chief' => ['required', 'boolean'],
            ];
        }
        else
        {
            return [
                'name' => ['required'],
                'photo' => ['nullable', 'image'],
                'department' => ['nullable'],
                'designation' => ['required'],
                'level' => ['nullable'],
                'phone' => ['nullable'],
                'email' => ['nullable'],
                'address' => ['nullable'],
                'position' => ['nullable', 'integer'],
                'is_chief' => ['required', 'boolean'],
            ];
        }

    }
}
