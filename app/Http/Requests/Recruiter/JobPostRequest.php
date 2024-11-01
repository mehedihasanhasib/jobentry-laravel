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
            'salary' => ['required', 'numeric','min:1', 'max:2147483647'],
            'vacancy' => ['required', 'numeric','min:1', 'max:2147483647'],
            'work_experience' => ['required', 'numeric','min:1', 'max:2147483647'],
            'deadline' => ['required', 'date'],
            'location' => ['required', 'exists:locations,id'],
            'work_status' => ['required', Rule::in([base64_encode('Full Time'), base64_encode('Part Time')])],
            'category' => ['required', 'exists:categories,id'],
            'details' => [new JobDetailsRequired]
        ];
    }

    public function  messages(): array
    {
        return [
            'working_hours' =>  'Working hours must be in the format of start and end time',
        ];
    }
}
