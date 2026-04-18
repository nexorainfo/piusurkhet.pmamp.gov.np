<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class StoreSubDivisionDocumentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return \Gate::allows('subDivision_document_create');
    }

    public function rules(): array
    {
        if(config('default.dual_language'))
        {
            return [
                'title' => ['required'],
                'title_en' => ['required'],
                'sub_division_document_category_id' => ['required', Rule::exists('sub_division_document_categories', 'id')->withoutTrashed()],
                'publisher' => ['nullable'],
                'publisher_en' => ['nullable'],
                'date' => ['required','date'],
                'description' => ['nullable'],
                'description_en' => ['nullable'],
                'status' => ['nullable', 'boolean'],
                'mark_as_new' => ['nullable', 'boolean'],
                'files' => ['required', 'array'],
                'files.*' => ['file']
            ];
        }
        else
        {
            return [
                'title' => ['required'],
                'sub_division_document_category_id' => ['required', Rule::exists('sub_division_document_categories', 'id')->withoutTrashed()],
                'publisher' => ['nullable'],
                'date' => ['required','date'],
                'description' => ['nullable'],
                'status' => ['nullable', 'boolean'],
                'mark_as_new' => ['nullable', 'boolean'],
                'files' => ['required', 'array'],
                'files.*' => ['file']
            ];
        }

    }
}
