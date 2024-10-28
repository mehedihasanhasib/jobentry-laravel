<?php

namespace App\Rules\Recruiters\Jobs;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class JobDetailsRequired implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cleaned = trim(strip_tags($value));
        if ($cleaned === '' || $value === '<p><br></p>') {
            $fail('The responsibilities field is required.');
        }
    }
}
