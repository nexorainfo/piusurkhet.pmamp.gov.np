<?php

namespace App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateFaqRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Gate::allows('faq_edit');
    }

    public function rules(): array
    {
        if(config('default.dual_language'))
        {
            return [
                'question' => ['required', 'string'],
                'answer' => ['required', 'string'],
                'question_en' => ['required', 'string'],
                'answer_en' => ['required', 'string'],
            ];
        }
        else
        {
            return [
                'question' => ['required', 'string'],
                'answer' => ['required', 'string'],
            ];
        }

    }
}
