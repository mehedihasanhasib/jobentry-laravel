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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:dns', 'max:255', 'unique:' . Recruiter::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' =>  ['required'],
            'phone' =>  ['required', 'numeric', 'digits:11', 'unique:' . Recruiter::class],
            'company_name' => ['required', 'string', 'max:255'],
            'website' => ['nullable',  'string', 'max:255', 'url', 'unique:' . Recruiter::class],
            'address' => ['required', 'string', 'max:255'],
            'company_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_logo.image' => 'Invalid Image',
            'company_logo.mimes' => 'Image should be in jpg, jpeg, png format',
            'company_logo.max' => 'Image size should not exceed 2MB',
            'phone.unique' => 'The phone number has already been taken.',
            'phone.required' => 'Phone Number is required',
            'phone.digits' => 'Phone Number should be 11 digits',
        ];
    }
}
