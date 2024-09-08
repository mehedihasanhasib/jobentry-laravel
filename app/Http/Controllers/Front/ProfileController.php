<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Front\EducationInformation;

class ProfileController extends Controller
{
    public function index()
    {
        return view('front.pages.profile.index');
    }

    public function personal_information(Request $request)
    {
        $table = 'personal_informations';
        $column = 'gender';

        $genders = $this->getEnumValues($table, $column);
        $user = User::with('personalInfo')->find(Auth::user()->id);

        return response()->json([
            'view' => view('components.front.profile.personal', ['user' => $user, 'genders' => $genders])->render(),
            'rows' =>  $user->count()
        ]);
    }

    public function personal_information_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'. Auth::user()->id],
            'phone' => ['required', 'max:11'],
            'dob' => ['nullable', 'date'],
            // 'gender' => ['required', 'in_enum:personal_informations.gender'],
            'father_name' => ['nullable','max:255']
        ],[
            'dob' => 'Date of birth should be a valid date'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
    }

    public function education_information(Request $request)
    {
        $educations = EducationInformation::where('user_id', 1)->get();
        // return view('front.pages.profile.education', [
        //     'educations' => $educations,
        // ]);
        return response()->json([
            'view' => view('components.front.profile.education', ['educations' => $educations])->render(),
            'rows' =>  $educations->count()
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update()
    {
        //
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
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

    function getEnumValues($table, $column)
    {
        // Get the column's details using a direct query string
        $type = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'")[0]->Type;

        // Extract the ENUM values using a regular expression
        preg_match('/^enum\((.*)\)$/', $type, $matches);

        // Convert the result into an array of values
        $enumValues = array_map(function ($value) {
            return trim($value, "'");
        }, explode(',', $matches[1]));

        return $enumValues;
    }
}
