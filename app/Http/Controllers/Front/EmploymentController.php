<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmploymentUpdateRequest;
use App\Models\Front\EmploymentInformation;
use Illuminate\Support\Facades\Auth;

class EmploymentController extends Controller
{
    public $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }

    public function index()
    {
        $employments = EmploymentInformation::where('user_id', $this->user_id)->get();
        return response()->json([
            'view' => view('components.front.profile.informations', [
                'informations' => $employments,
                'module' => 'Employment',
                'callBackRoute' => route('user.profile.employment'),
                'submitRoute' => route('user.profile.employment.update'),
                'deleteRoute' => route('user.profile.employment.delete')
            ])->render(),
            'rows' =>  $employments->count()
        ]);
    }

    public function update(EmploymentUpdateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $this->user_id;
        try {
            EmploymentInformation::where('user_id', $this->user_id)->updateOrCreate(['id' => $request->training_id], $data);
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
        try {
            EmploymentUpdateRequest::where('id', $request->id)->where('user_id', $this->user_id)->delete();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => $th->getMessage()
            ]);
        }
    }
}
