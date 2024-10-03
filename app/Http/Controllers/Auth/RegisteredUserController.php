<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use App\Models\Front\PersonalInformation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.user_registration');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:dns', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' =>  ['required'],
            'dob' =>  ['required', 'date'],
            'phone' =>  ['required', 'numeric', 'digits:11'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'name.required' => 'Name is required',
            'name.string' => 'Name should be a string',
            'name.max' => 'Name should not exceed 255 characters',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already taken',
            'password.confirmed' => 'Password and confirm password do not match',
            'password_confirmation.required' => "Confirm Password is required",
            'dob.required' => 'Date of Birth is required',
            'phone.required' => 'Phone Number is required',
            'phone.digits' => 'Phone Number should be 11 digits',
            'dob.date' => 'Invalid Date of Birth',
            'profile_picture.image' => 'Invalid Image',
            'profile_picture.mimes' => 'Image should be in jpg, jpeg, png format',
            'profile_picture.max' => 'Image size should not exceed 2MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
            ], 422);
        }

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
            // return redirect(route('dashboard', absolute: false));
            return response()->json([
                'success' => true,
                'url' => route('profile'),
                'message' => 'Registration successfull'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            if ($path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            Log::error($th->getMessage());
            return response()->json([
                'success' => false,
                'errors' => $th->getMessage()
            ]);
        }
    }
}
