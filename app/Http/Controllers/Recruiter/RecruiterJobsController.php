<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruiter\JobPostRequest;
use Illuminate\Http\Request;

class RecruiterJobsController extends Controller
{
    public function index()
    {
        return view('recruiter.jobs.index');
    }

    public function create()
    {
        return view('recruiter.jobs.create');
    }

    public function store(JobPostRequest $request)
    {
        dd($request->all());
    }
}
