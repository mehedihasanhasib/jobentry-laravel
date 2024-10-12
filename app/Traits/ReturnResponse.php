<?php

namespace App\Traits;

trait ReturnResponse
{
    public function successResponse(string $route = null, string $message = null)
    {
        return response()->json([
            'success' => true,
            'url' => $route,
            'message' => $message
        ]);
    }

    public function profileSuccessResponse($collection, string $module, string $view_component, string $callBackRoute, string $submitRoute, string $deleteRoute)
    {
        return response()->json([
            'view' => view($view_component, [
                'informations' => $collection, // all information
                'module' => $module, // to identify which module
                'callBackRoute' =>  $callBackRoute, // route for redirect if click close button or after submitting form
                'submitRoute' => $submitRoute, // route form submitting informations form
                'deleteRoute' => $deleteRoute // route for deleting informations
            ])->render(),
            'rows' => $collection->count() // important for showing edit and text view if multiple educations or training and others
        ]);
    }
}
