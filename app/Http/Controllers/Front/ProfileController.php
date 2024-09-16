<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\EducationUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Front\EducationInformation;
use App\Models\Front\PersonalInformation;

class ProfileController extends Controller
{
    public $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }
    public function index()
    {
        return view('front.pages.profile.index');
    }

    public function personal_information()
    {
        $genders = $this->getEnumValues();
        $user = User::with('personalInfo')->find($this->user_id);

        return response()->json([
            'view' => view('components.front.profile.personal', [
                'user' => $user,
                'genders' => $genders
            ])->render(),
            'rows' => $user->count()
        ]);
    }

    public function personal_information_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::user()->id],
            'phone' => ['required', 'numeric', 'digits:11'],
            'dob' => ['required', 'date'],
            'father_name' => ['nullable', 'max:255'],
            'mother_name' => ['nullable', 'max:255']
        ], [
            'dob' => 'Date of birth should be a valid date',
            'phone.digits' => 'Phone number should be 11 digits',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }

        try {
            PersonalInformation::where('user_id', $this->user_id)->update($request->except(['name', 'email', '_token']));
            User::where('id', $this->user_id)->update($request->only(['name', 'email']));
            return response()->json(['success' => true, 'message' => 'Personal information updated successfully']);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => $th->getMessage()
            ]);
        }
    }

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

    function getEnumValues()
    {
        $table = 'personal_informations';
        $column = 'gender';
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
