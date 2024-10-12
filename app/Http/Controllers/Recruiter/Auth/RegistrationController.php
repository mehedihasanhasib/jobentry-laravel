<?php

namespace App\Http\Controllers\Recruiter\Auth;

use App\Models\Recruiter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Recruiter\Auth\RegistrationRequest;
use App\Traits\ReturnResponse;

class RegistrationController extends Controller
{
    use ReturnResponse;
    public function create()
    {
        return view('recruiter.auth.register');
    }

    public function store(RegistrationRequest $request)
    {
        $validated_data =  $request->validated();
        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $path = $file->store('company_logo', 'public');
        }
        try {
            DB::beginTransaction();
            $recruiter = Recruiter::create([
                'name' => $validated_data['name'],
                'email' =>  $validated_data['email'],
                'password' => Hash::make($validated_data['password']),
                'company_name' => $validated_data['company_name'],
                'company_logo' => $path ?? null,
                'phone' => $validated_data['phone'],
                'website' =>  $validated_data['website'],
                'address' => $validated_data['address'],
            ]);

            event(new Registered($recruiter));

            Auth::guard('recruiter')->login($recruiter);
            DB::commit();

            $this->successResponse(route: route('recruiter.dashboard'), message: 'Registration successfull');
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
