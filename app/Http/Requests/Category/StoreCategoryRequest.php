<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if(config('default.dual_language'))
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'alpha_dash', Rule::unique('document_categories', 'slug')->withoutTrashed()],
                'position' => ['nullable', 'integer']
            ];
        }
        else
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'alpha_dash', Rule::unique('document_categories', 'slug')->withoutTrashed()],
                'position' => ['nullable', 'integer']
            ];
        }

    }
}
