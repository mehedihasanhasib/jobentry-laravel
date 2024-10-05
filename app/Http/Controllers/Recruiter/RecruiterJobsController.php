<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
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
}
