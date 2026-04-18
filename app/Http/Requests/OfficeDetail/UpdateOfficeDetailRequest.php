<?php

namespace App\Http\Requests\OfficeDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateOfficeDetailRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Gate::allows('office_detail_edit');
    }

    public function rules(): array
    {
        if(config('default.dual_language'))
        {
            return [
                'title' => ['required', 'string'],
                'slug' => ['required', 'alpha_dash', Rule::unique('office_details', 'slug')->withoutTrashed()->ignore($this->officeDetail)],
                'description' => ['required'],
                'description_en' => ['required'],
                'type' => ['nullable', Rule::in(config('types')), Rule::unique('office_details', 'type')->withoutTrashed()->ignore($this->officeDetail)],
                'position' => ['nullable', 'integer']
            ];
        }else
        {
            return [
                'title' => ['required', 'string'],
                'slug' => ['required', 'alpha_dash', Rule::unique('office_details', 'slug')->withoutTrashed()->ignore($this->officeDetail)],
                'description' => ['required'],
                'type' => ['nullable', Rule::in(config('types')), Rule::unique('office_details', 'type')->withoutTrashed()->ignore($this->officeDetail)],
                'position' => ['nullable', 'integer']
            ];
        }

    }
}
