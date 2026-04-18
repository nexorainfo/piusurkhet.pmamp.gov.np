<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateSubDivisionDocumentCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return \Gate::allows('subDivision_document_category_edit');
    }

     public function rules(): array
    {
        if(config('default.dual_language'))
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
