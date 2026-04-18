<?php

namespace App\Http\Requests\ExEmployee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateExEmployeeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Gate::allows('ex_employee_edit');
    }

    public function rules(): array
    {
        $ruleArray = [
            'name' => ['required'],
            'photo' => ['nullable', 'image'],
            'department' => ['nullable'],
            'designation' => ['required'],
            'level' => ['nullable'],
            'phone' => ['nullable'],
            'email' => ['nullable'],
            'address' => ['nullable'],
            'joining_date' => ['required'],
            'leaving_date' => ['required'],
            'is_chief' => ['required', 'boolean']
        ];
        if (config('default.dual_language')) {
            $ruleArray = array_merge($ruleArray, [
                'name_en' => ['required'],
                'department_en' => ['nullable'],
                'designation_en' => ['required'],
                'level_en' => ['nullable'],
                'address_en' => ['nullable'],
            ]);

        }
        return $ruleArray;
    }
}
