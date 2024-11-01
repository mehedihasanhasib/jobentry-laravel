<?php

namespace App\Http\Controllers\Recruiter;

use DateTime;
use App\Models\Category;
use App\Models\Location;
use App\Traits\ReturnResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Recruiter\JobPostRequest;
use Illuminate\Support\Facades\Validator;

class RecruiterJobsController extends Controller
{
    use ReturnResponse;
    public function index()
    {
        return view('recruiter.jobs.index');
    }

    public function create()
    {
        $categories = Category::select(['id', 'category_name'])->get();
        $locations = Location::select(['id', 'location_name_en'])->get();
        return view('recruiter.jobs.create', compact('categories', 'locations'));
    }

    public function store(JobPostRequest $request)
    {
        if (!$request->has('working_hours')) {
            return $this->validationError(field_name: 'working_hours', error: 'The working hours field is required.');
        }

        $working_hours = $request->working_hours;
        $working_hours_start = $working_hours['start'];
        $working_hours_end = $working_hours['end'];

        if (is_null($working_hours_start) || is_null($working_hours_end)) {
            return $this->validationError(field_name: 'working_hours', error: '\'Start\' and \'End\' both are required');
        }

        $validation = Validator::make($working_hours,[
            'start' => ['date_format:H:i'],
            'end' => ['date_format:H:i', 'after:start']
        ]);

        if ($validation->fails()) {
            return $this->validationError(field_name: 'working_hours', error: 'Validation Error');
        }

        $validated = $request->validated();

        $validated['working_hours'] = $working_hours;

        dd($validated);
    }
}
