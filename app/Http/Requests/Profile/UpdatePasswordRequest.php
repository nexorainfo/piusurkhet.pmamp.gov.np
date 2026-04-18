<?php

namespace App\Http\Requests\Profile;

use App\Rules\CheckCurrentPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => ['required',new CheckCurrentPassword()],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()]
        ];
    }
}
