<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\EducationInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function personal_information(Request $request)
    {
        $user = User::with('personalInfo')->find(Auth::user()->id);
        
        return view('front.pages.profile.personal', [
            'user' => $user,
        ]);
    }

    public function education_information(Request $request)
    {
        $educations = EducationInformation::where('user_id', 1)->get();
        return view('front.pages.profile.education', [
            'educations' => $educations,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update()
    {
        //
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
