<?php

namespace App\Http\Requests\Smugglig;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSmugglingRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Gate::allows('smuggling_edit');
    }

    public function rules(): array
    {
        if(config('default.dual_language'))
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'description' => ['nullable'],
                'description_en' => ['nullable'],
                'files' => ['nullable', 'array'],
                'files.*' => ['image']
            ];
        }
        else
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['nullable'],
                'files' => ['nullable', 'array'],
                'files.*' => ['image']
            ];
        }

    }
}
