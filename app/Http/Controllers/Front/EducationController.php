<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Front\EducationInformation;
use App\Http\Requests\EducationUpdateRequest;
use App\Traits\ReturnResponse;

class EducationController extends Controller
{
    use ReturnResponse;
    public $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }

    public function index()
    {
        $educations = EducationInformation::where('user_id', $this->user_id)->get();
        return $this->profileSuccessResponse(
            collection: $educations,
            module: 'Education',
            view_component: 'components.front.profile.informations',
            callBackRoute: route('user.profile.education'),
            submitRoute: route('user.profile.education.update'),
            deleteRoute: route('user.profile.education.delete')
        );
    }

    public function update(EducationUpdateRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $this->user_id;
        try {
            EducationInformation::where('user_id', $this->user_id)->updateOrCreate(['id' => $request->education_id], $validatedData);
            return $this->successResponse(route: null, message: "Education information updated successfully");
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => $th->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            EducationInformation::where('id', $request->id)->where('user_id', $this->user_id)->delete();
            return $this->successResponse(route: null, message: "Education information deleted successfully");
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => $th->getMessage()
            ]);
        }
    }
}
