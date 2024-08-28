<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function personal_information($id)
    {
        $userData = User::with('personalInfo')->find($id);
        $personal_info = $userData->personalInfo;

        $is_set_user = isset($userData) && isset($personal_info) ? true : false;
        if ($is_set_user) {
            $user = [
                'name' => $userData->name,
                'email' => $userData->email,
                'fatherName' => $personal_info->father_name,
                'motherName' => $personal_info->mother_name,
                'phone' => $personal_info->phone,
                'dob' => $personal_info->dob,
                'gender' => $personal_info->gender,
            ];
            return $user;
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
