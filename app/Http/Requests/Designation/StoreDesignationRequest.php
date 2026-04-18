<?php

namespace App\Http\Requests\Designation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDesignationRequest extends FormRequest
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
                'title' => ['required', Rule::unique('designations', 'title')->withoutTrashed()],
                'title_en' => ['required', Rule::unique('designations', 'title_en')->withoutTrashed()],
            ];
        }
        else
        {
            return [
                'title' => ['required', Rule::unique('designations', 'title')->withoutTrashed()],
            ];
        }

    }
}
