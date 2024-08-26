<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function personal_information(Request $request): View
    {
        // return view('profile.edit', [
        //     'user' => $request->user(),
        // ]);
        // $personalData = [
        //     'firstName' => 'Mehedi Hasan',
        //     'lastName' => 'Hasib',
        //     'fatherName' => 'Abul Kalam Azad',
        //     'motherName' => 'Masuda Begum',
        //     'email' => 'hasib@gmail.com',
        //     'dob' => '1998-12-05',
        //     'phone' => '01712345678',
        //     'gender' => 'male'
        // ];

        $user = User::with('personalInfo')->find(1);
        return view('front.pages.profile.personal', compact('user'));
    }

    public function education_information(Request $request): View
    {
        return view('front.pages.profile.personal_information');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
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
