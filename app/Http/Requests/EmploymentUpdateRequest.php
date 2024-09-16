<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmploymentUpdateRequest extends FormRequest
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
            'company_name' => ['required', 'string', 'max:255'],
            'company_location' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'responsibilities' => ['required', 'string', 'max:300'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_name.required' => 'Company name is required',
            'company_name.string' => 'Company name must be a string',
            'company_name.max' => 'Company name must not be greater than 255 characters',
            'company_location.required' => 'Company location is required',
            'company_location.string' => 'Company location must be a string',
            'company_location.max' => 'Company location must not be greater than 255 characters',
            'designation.required' => 'Designation is required',
            'designation.string' => 'Designation must be a string',
            'designation.max' => 'Designation must not be greater than 255 characters',
            'responsibilities.required' => 'Responsibilities is required',
            'responsibilities.string' => 'Responsibilities must be a string',
            'responsibilities.max' => 'Responsibilities must not be greater than 255 characters',
            'from.required' => 'From date is required',
            'from.date' => 'From date must be a date',
            'to.required' => 'To date is required',
            'to.date' => 'To date must be a date',
        ];
    }
}
