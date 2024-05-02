<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoteRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check length
        if (strlen($value) < 10 || strlen($value) > 5000) {
            return false;
        }

        // Check if the note starts with a capital letter
        if (!preg_match('/^[A-Z]/', $value)) {
            return false;
        }

        // Check if the note contains at least one number
        if (!preg_match('/\d/', $value)) {
            return false;
        }

        // Check if the note contains at least one special character
        if (!preg_match('/[^a-zA-Z\d]/', $value)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be at least 10 characters and at most 5000 characters, start with a capital letter, contain at least one number, and contain at least one special character.';
    }
}
