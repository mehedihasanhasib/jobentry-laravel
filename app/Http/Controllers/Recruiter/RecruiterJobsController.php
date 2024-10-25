<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruiter\JobPostRequest;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;

class RecruiterJobsController extends Controller
{
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
        dd($request->all());
    }
}
