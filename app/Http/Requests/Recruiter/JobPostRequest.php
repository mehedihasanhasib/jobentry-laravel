<?php

namespace App\Http\Requests\Recruiter;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Recruiters\Jobs\JobDetailsRequired;

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
            'salary' => ['required', 'numeric', 'min:1', 'max:2147483647'],
            'vacancy' => ['requ ired', 'numeric', 'min:1', 'max:2147483647'],
            'work_experience' => ['required', 'numeric', 'min:1', 'max:2147483647'],
            'deadline' => ['required', 'date'],
            'location' => ['required', 'exists:locations,id'],
            'work_status' => ['required', Rule::in(['Full Time', 'Part Time'])],
            'category' => ['required', 'exists:categories,id'],
            'working_hours' => ['required', 'array'],
            'working_hours.*' => ['required', 'date_format:H:i'],
            'education_requirement' => ['required', 'array'],
            'education_requirement.*' => ['required', 'string', 'max:255'],
            'experience_requirement' => ['array'],
            'experience_requirement.*' => ['nullable', 'string', 'max:255'],
            'additional_requirement' => ['array'],
            'additional_requirement.*' => ['nullable', 'string', 'max:255'],
            'details' => [new JobDetailsRequired, 'string', 'max:1000'],
            'other_benefits' => ['string', 'max:1000'],
        ];
    }

    public function  messages(): array
    {
        return [
            'working_hours.*.required' => 'Working Hours \'Start\' and \'End\' is required',
            'working_hours.*.date_format' => 'Invalid Working Hours format.',

            'education_requirement.*.required' =>  'All education requirement filed is required',
            'education_requirement.*.string' => 'Education requirement must be string',
            'education_requirement.*.max' => 'Education requirement must be less than 255 character',

            'experience_requirement.*.string' => 'Work experience must be string',
            'experience_requirement.*.max' => 'Work experience must be less than 255 character',

            'additional_requirement.*.string' => 'Additional requiement must be string',
            'additional_requirement.*.max' => 'Additional requiement must be less than 255 character',

            'details.string' => 'Responsibilities & Job details must be string',
            'details.max' => 'Responsibilities & Job details must be less than 500 character',
        ];
    }
}
