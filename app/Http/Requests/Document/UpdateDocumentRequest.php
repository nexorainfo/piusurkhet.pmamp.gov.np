<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDocumentRequest extends FormRequest
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
                'title' => ['required', 'string'],
                'title_en' => ['required', 'string'],
                'slug' => ['required', 'alpha_dash', Rule::unique('documents', 'slug')->withoutTrashed()->ignore($this->document)],
                'publisher' => ['nullable', 'string'],
                'publisher_en' => ['nullable', 'string'],
                'published_date' => ['required'],
                'description' => ['nullable'],
                'description_en' => ['nullable'],
                'status' => ['nullable', 'boolean'],
                'popUp' => ['nullable', 'boolean'],
                'mark_as_new' => ['nullable', 'boolean'],
                'document_category_id' => ['nullable', Rule::exists('document_categories', 'id')->withoutTrashed()],
                'files' => ['nullable', 'array'],
                'files.*' => ['file']
            ];
        }
        else
        {
            return [
                'title' => ['required', 'string'],
                'slug' => ['required', 'alpha_dash', Rule::unique('documents', 'slug')->withoutTrashed()->ignore($this->document)],
                'publisher' => ['nullable', 'string'],
                'published_date' => ['required'],
                'description' => ['nullable'],
                'status' => ['nullable', 'boolean'],
                'popUp' => ['nullable', 'boolean'],
                'mark_as_new' => ['nullable', 'boolean'],
                'document_category_id' => ['nullable', Rule::exists('document_categories', 'id')->withoutTrashed()],
                'files' => ['nullable', 'array'],
                'files.*' => ['file']
            ];
        }

    }
}
