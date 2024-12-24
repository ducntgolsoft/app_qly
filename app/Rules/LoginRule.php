<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LoginRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regexEmail = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
        $regexPhone = '/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/';
        if (!preg_match($regexEmail, $value) && !preg_match($regexPhone, $value)) {
            $fail("Email/Số điện thoại không đúng định dạng");
        }
    }
}
