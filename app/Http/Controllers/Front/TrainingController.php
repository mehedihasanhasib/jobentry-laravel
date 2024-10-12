<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Front\TrainingInformation;
use App\Traits\ReturnResponse;

class TrainingController extends Controller
{
    use ReturnResponse;
    public $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }
    public function index()
    {
        $trainings = TrainingInformation::where('user_id', $this->user_id)->get();

        return $this->profileSuccessResponse(
            collection: $trainings,
            view_component: 'components.front.profile.informations',
            module: 'Training',
            callBackRoute: route('user.profile.training'),
            submitRoute: route('user.profile.training.update'),
            deleteRoute: route('user.profile.training.delete')
        );
    }

    public function update(TrainingUpdateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $this->user_id;
        try {
            TrainingInformation::where('user_id', $this->user_id)->updateOrCreate(['id' => $request->training_id], $data);
            return $this->successResponse(route: null,  message: 'Training information updated successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse(message: $th->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            TrainingInformation::where('id', $request->id)->where('user_id', $this->user_id)->delete();
            return $this->successResponse(route: null,  message: 'Training information deleted successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse(message: $th->getMessage());
        }
    }
}
