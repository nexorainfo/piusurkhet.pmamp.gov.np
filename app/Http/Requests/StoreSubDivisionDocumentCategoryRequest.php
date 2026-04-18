<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubDivisionDocumentCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return \Gate::allows('subDivision_document_category_create');
    }

    public function rules()
    {
        if (config('default.dual_language'))
        {
            return [
                'title' => ['required'],
                'title_en' => ['required'],
            ];
        }
        else
        {
            return [
                'title' => ['required'],
            ];
        }

    }
}
