<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegistrationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use App\Models\Front\PersonalInformation;
use App\Traits\ReturnResponse;

class RegisteredUserController extends Controller
{
    use ReturnResponse;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.user_registration');
    }

    public function store(UserRegistrationRequest $request)
    {
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('users_profile_picture', 'public');
        }
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            PersonalInformation::create([
                'user_id' => $user->id,
                'image' => $path ?? null,
                'dob' => $request->dob,
                'phone' => $request->phone,
            ]);

            event(new Registered($user));

            Auth::login($user);
            DB::commit();
            return $this->successResponse(route: route('profile'), message: 'Registration successfull');
        } catch (\Throwable $th) {
            DB::rollBack();
            if (isset($path)) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            return $this->errorResponse(message: $th->getMessage());
        }
    }
}
