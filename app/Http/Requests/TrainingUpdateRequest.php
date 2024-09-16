<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingUpdateRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'string'],
            'institute' => ['required', 'max:255', 'string'],
            'duration' => ['required', 'max:255', 'string'],
            'start_date' =>  ['required', 'date'],
            'topic' => ['required', 'max:255', 'string'],
            'location' => ['required', 'max:255', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.max' => 'Title must not be greater than 255 characters',

            'institute.required' => 'Institute is required',
            'institute.max' => 'Institute must not be greater than 255 characters',

            'duration.required' => 'Duration is required',
            'duration.max' => 'Duration must not be greater than 255 characters',

            'start_date.required' => 'Start date is required',
            'start_date.date' => 'Invalid date',

            'topic.required' => 'Topic is required',
            'topic.max' => 'Topic must not be greater than 255 characters',

            'location.required' => 'Location is required',
            'location.max' => 'Location must not be greater than 255 characters',
        ];
    }
}
