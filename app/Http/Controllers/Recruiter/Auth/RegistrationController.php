<?php

namespace App\Http\Controllers\Recruiter\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('recruiter.auth.register');
    }
}
