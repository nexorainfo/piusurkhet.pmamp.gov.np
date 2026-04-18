<?php

namespace App\Http\Requests\DocumentCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDocumentCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        if (config('default.dual_language'))
        {
            return [
                'title' => ['required'],
                'title_en' => ['required'],
                'position'=>['nullable'],
                'slug' => ['required', 'alpha_dash', Rule::unique('document_categories', 'slug')->withoutTrashed()],
            ];
        }
        else
        {
            return [
                'title' => ['required'],
                'position'=>['nullable'],
                'slug' => ['required', 'alpha_dash', Rule::unique('document_categories', 'slug')->withoutTrashed()],
            ];
        }

    }
}
