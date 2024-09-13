<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function update(Request $request)
    {
        dd($request->all());
    }

    public function delete(Request $request)
    {
        dd($request->all());
    }
}
