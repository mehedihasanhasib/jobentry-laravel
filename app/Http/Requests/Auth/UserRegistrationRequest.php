<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Models\Front\PersonalInformation;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'email' => ['required', 'string', 'lowercase', 'email:dns', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' =>  ['required'],
            'dob' =>  ['required', 'date'],
            'phone' =>  ['required', 'numeric', 'digits:11', 'unique:' . PersonalInformation::class],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function  messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name should be a string',
            'name.max' => 'Name should not exceed 255 characters',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already taken',
            'password.confirmed' => 'Password and confirm password do not match',
            'password_confirmation.required' => "Confirm Password is required",
            'dob.required' => 'Date of Birth is required',
            'phone.required' => 'Phone Number is required',
            'phone.digits' => 'Phone Number should be 11 digits',
            'phone.unique' => 'The phone number has already been taken.',
            'dob.date' => 'Invalid Date of Birth',
            'profile_picture.image' => 'Invalid Image',
            'profile_picture.mimes' => 'Image should be in jpg, jpeg, png format',
            'profile_picture.max' => 'Image size should not exceed 2MB',
        ];
    }
}
