<?php

namespace App\Http\Requests\Recruiter;

use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'string', 'max:255'],
            'vacancy' => ['required', 'min:1'],
            'details' => ['required', function ($attribute, $value, $fail) {
                $cleaned = trim(strip_tags($value));
                
                if ($cleaned === '' || $value === '<p><br></p>') {
                    $fail('The responsibilities field is required.');
                }
            }]
        ];
    }
}
