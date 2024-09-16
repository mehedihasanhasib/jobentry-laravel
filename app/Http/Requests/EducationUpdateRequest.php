<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EducationUpdateRequest extends FormRequest
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
            'degree' => ['required', 'string', 'max:255'],
            'exam' => ['required', 'string', 'max:255'],
            'institute' => ['required', 'string', 'max:255'],
            'passing_year' => ['required', 'numeric', 'digits:4'],
            'group' => ['required', 'string', 'max:255'],
            'cgpa' => ['required', 'numeric', 'between:0,5'],
            'scale' => ['required', 'numeric', 'between:0,5']
        ];
    }

    public function messages(): array
    {
        return [
            'degree.required' => 'Degree is required',
            'degree.string' => 'Degree must be a string',
            'degree.max' => 'Degree should not be greater than 255 characters',

            'exam.required' => 'Exam is required',
            'exam.max' => 'Exam should not be more than 255 characters',

            'institute.required' => 'Institute is required',
            'institute.max' => 'Institute should not be more than 255 characters',

            'passing_year.required' => 'Passing year is required',
            'passing_year.numeric' => 'Passing year should be numeric',
            'passing_year.digits' => 'Passing year should be a 4-digit number',

            'group.required' => 'Group is required',
            'group.max' => 'Group should not be more than 255 characters',

            'cgpa.required' => 'CGPA is required',
            'cgpa.numeric' => 'CGPA should be a numeric value',
            'cgpa.between' => 'CGPA should be between 0 and 5',

            'scale.required' => 'Scale is required',
            'scale.numeric' => 'Scale should be a numeric value',
            'scale.between' => 'Scale should be between 0 and 5'
        ];
    }
}
