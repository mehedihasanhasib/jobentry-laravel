<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Front\TrainingInformation;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $educations = TrainingInformation::where('user_id', 1)->get();
        return response()->json([
            'view' => view('components.front.profile.informations', ['informations' => $educations, 'module' => 'Training'])->render(),
            'rows' => $educations->count()
        ]);
    }
}
