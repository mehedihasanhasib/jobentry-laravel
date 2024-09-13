<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Front\EducationInformation;
use App\Http\Requests\EducationUpdateRequest;

class EducationController extends Controller
{
    public $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }
    
    public function index()
    {
        $educations = EducationInformation::where('user_id', 1)->get();
        return response()->json([
            'view' => view('components.front.profile.informations', [
                'informations' => $educations, // all information
                'module' => 'Education', // to identify which module
                'callBackRoute' =>  route('user.profile.education'), // route for redirect if click close button or after submitting form
                'submitRoute' => route('user.profile.education.update'), // route form submitting informations form
                'deleteRoute' => route('user.profile.education.delete') // route for deleting informations
            ])->render(),
            'rows' => $educations->count() // important for showing edit and text view if multiple educations or training and others
        ]);
    }

    public function update(EducationUpdateRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $this->user_id;
        try {
            EducationInformation::where('user_id', $this->user_id)->updateOrCreate(['id' => $request->education_id], $validatedData);
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => $th->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {
        // dd($request->all());
        try {
            EducationInformation::where('id', $request->id)->where('user_id', $this->user_id)->delete();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => $th->getMessage()
            ]);
        }
    }
}
