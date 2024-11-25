<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CurrentPassword implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if there is an authenticated user in the 'personnel' guard
        if (Auth::guard('personnel')->check()) {
            // Compare the provided password with the authenticated user's password
            return Hash::check($value, Auth::guard('personnel')->user()->password);
        }

        // If there is no authenticated user, validation fails
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is incorrect.';
    }
}
