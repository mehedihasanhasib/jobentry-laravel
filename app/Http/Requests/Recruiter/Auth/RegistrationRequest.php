<?php

namespace App\Http\Requests\Recruiter\Auth;

use App\Models\Recruiter;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:dns', 'max:255', 'unique:' . Recruiter::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' =>  ['required'],
            'phone' =>  ['required', 'numeric', 'digits:11'],
            'company_name' => ['required', 'string', 'max:255'],
            'website' => ['nullable',  'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'company_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'Name is required',
    //         'name.string' => 'Name should be a string',
    //         'name.max' => 'Name should not exceed 255 characters',

    //         'email.required' => 'Email is required',
    //         'email.unique' => 'Email is already taken',

    //         'password.confirmed' => 'Password and confirm password do not match',
    //         'password_confirmation.required' => "Confirm Password is required",

    //         'phone.required' => 'Phone Number is required',
    //         'phone.digits' => 'Phone Number should be 11 digits',

    //         'company_logo.image' => 'Invalid Image',
    //         'company_logo.mimes' => 'Image should be in jpg, jpeg, png format',
    //         'company_logo.max' => 'Image size should not exceed 2MB',

    //         'company_name.required' => 'Company Name is required',
    //         'company_name.string' => 'Company Name should be a string',
    //         'company_name.max' => 'Company Name should not exceed 255 characters',
    //     ];
    // }
}
