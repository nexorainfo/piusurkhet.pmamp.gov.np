<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CheckCurrentPassword implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()->password);
    }

    public function message()
    {
        return 'The :attribute not matched with old password.';
    }
}
