<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(config('default.dual_language'))
        {
            return [
                'title' => ['required', Rule::unique('departments', 'title')->withoutTrashed()->ignore($this->department)],
                'title_en' => ['required', Rule::unique('departments', 'title_en')->withoutTrashed()->ignore($this->department)],
            ];
        }
        else
        {
            return [
                'title' => ['required', Rule::unique('departments', 'title')->withoutTrashed()->ignore($this->department)],
            ];
        }

    }
}
