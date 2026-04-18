<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('role_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['title' => "array", 'permissions' => "string[]", 'permissions.*' => "array"])] public function rules(): array
    {
        return [
            'title' => ['required', Rule::unique('roles', 'title')->withoutTrashed()],
            'permissions' => ['required', 'array'],
            'permissions.*' => [Rule::exists('permissions', 'id')]
        ];
    }
}
