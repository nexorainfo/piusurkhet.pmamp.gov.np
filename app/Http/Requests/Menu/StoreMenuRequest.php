<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreMenuRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Gate::allows('menu_create');
    }

    public function rules(): array
    {
        if(config('default.dual_language'))
        {
            return [
                'menu_id' => ['nullable', Rule::exists('menus', 'id')->withoutTrashed()],
                'title' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'position' => ['nullable', 'integer'],
                'menu_type' => ['nullable', Rule::in(config('menuTypes'))],
                'model_id' => ['required_with:menu_type', 'integer'],
                'slug' => ['required', 'alpha_dash', Rule::unique('menus', 'slug')->withoutTrashed()],
                'status' => ['nullable', 'boolean'],
            ];
        }
        else
        {
            return [
                'menu_id' => ['nullable', Rule::exists('menus', 'id')->withoutTrashed()],
                'title' => ['required', 'string', 'max:255'],
                'position' => ['nullable', 'integer'],
                'menu_type' => ['nullable', Rule::in(config('menuTypes'))],
                'model_id' => ['required_with:menu_type', 'integer'],
                'slug' => ['required', 'alpha_dash', Rule::unique('menus', 'slug')->withoutTrashed()],
                'status' => ['nullable', 'boolean'],
            ];
        }

    }
}
