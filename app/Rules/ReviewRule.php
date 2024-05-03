<?php

namespace App\Rules;

use App\Models\Review;
use Illuminate\Contracts\Validation\Rule;

class ReviewRule implements Rule
{
    private $attribute;

    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;

        if ($attribute == 'message') {
            // No profanity
            $profanities = ['badword1', 'badword2'];
            foreach ($profanities as $profanity) {
                if (stripos($value, $profanity) !== false) {
                    return false;
                }
            }
        } elseif ($attribute == 'phone_no') {
            // Valid phone number
            if (!preg_match('/^(\+\d{1,3}[- ]?)?\d{10}$/', $value)) {
                return false;
            }
        } elseif ($attribute == 'email') {
            // Unique email
            if (Review::where('email', $value)->exists()) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        if ($this->attribute == 'message') {
            return 'Your message contains profanity.';
        } elseif ($this->attribute == 'phone_no') {
            return 'Your phone number is not valid.';
        } elseif ($this->attribute == 'email') {
            return 'This email has already been used.';
        }

        return 'The validation failed.';
    }
}
