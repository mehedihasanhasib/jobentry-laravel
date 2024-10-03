<?php

namespace App\Http\Controllers\Recruiter\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Recruiter\Auth\LoginRequest;

class LoginController extends Controller
{
    public function create()
    {
        return view('recruiter.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('recruiter.dashboard', absolute: false));
    }

    public function logout(Request $request)
    {
        Auth::guard('recruiter')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
