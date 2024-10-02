<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show($id)
    {
        try {
            $userData = User::with(['personalInfo', 'educationInfo', 'trainingInfo', 'employmentInfo'])->findOrFail($id);
            $personal_info = $userData->personalInfo;

            $is_set_user = isset($userData) && isset($personal_info) ? true : false;
            if ($is_set_user) {
                return response()->json([
                    'status' => true,
                    'data' => $userData
                ]);
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }
        } catch (\Throwable $th) {
            return  response()->json(['message' => $th->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        dd($request->all(), $id);
    }
}
