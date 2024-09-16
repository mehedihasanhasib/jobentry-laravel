<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Front\TrainingInformation;

class TrainingController extends Controller
{
    public $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }
    public function index()
    {
        $educations = TrainingInformation::where('user_id', $this->user_id)->get();
        return response()->json([
            'view' => view('components.front.profile.informations', [
                'informations' => $educations,
                'module' => 'Training',
                'callBackRoute' =>  route('user.profile.training'),
                'submitRoute' => route('user.profile.training.update'),
                'deleteRoute' => route('user.profile.training.delete')
            ])->render(),
            'rows' => $educations->count()
        ]);
    }

    public function update(TrainingUpdateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $this->user_id;
        try {
            TrainingInformation::where('user_id', $this->user_id)->updateOrCreate(['id' => $request->training_id], $data);
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
            TrainingInformation::where('id', $request->id)->where('user_id', $this->user_id)->delete();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => $th->getMessage()
            ]);
        }
    }
}
