<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmploymentUpdateRequest;
use App\Models\Front\EmploymentInformation;
use App\Traits\ReturnResponse;
use Illuminate\Support\Facades\Auth;

class EmploymentController extends Controller
{
    use ReturnResponse;
    public $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }

    public function index()
    {
        $employments = EmploymentInformation::where('user_id', $this->user_id)->get();
        return $this->profileSuccessResponse(
            collection: $employments,
            module: 'Employment',
            callBackRoute: route('user.profile.employment'),
            submitRoute: route('user.profile.employment.update'),
            deleteRoute: route('user.profile.employment.delete'),
            view_component: 'components.front.profile.informations'
        );
    }

    public function update(EmploymentUpdateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $this->user_id;
        try {
            EmploymentInformation::where('user_id', $this->user_id)->updateOrCreate(['id' => $request->employment_id], $data);
            return $this->successResponse(route: null,  message: 'Employment information updated successfully');
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
            EmploymentInformation::where('id', $request->id)->where('user_id', $this->user_id)->delete();
            return $this->successResponse(route: null,   message: 'Employment information deleted successfully');
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => $th->getMessage()
            ]);
        }
    }
}
