<?php

namespace App\Http\Requests\SpermDistribution;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSpermDistributionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'pedigree_caste_id' => ['nullable', Rule::exists('pedigree_castes', 'id')->withoutTrashed()],
            'tag' => ['required', 'string'],
            'address' => ['required', 'string'],
            'duration' => ['required', 'string'],
        ];
    }
}
