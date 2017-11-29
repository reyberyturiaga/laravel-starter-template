<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute field must contain at least one uppercase letter, one lowercase letter and one number.';
    }
}
