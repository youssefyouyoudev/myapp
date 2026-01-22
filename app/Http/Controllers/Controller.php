<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
        /**
     * Log a user action in the app.
     */
    protected function logUserAction($action, $model, $modelId = null, $details = null, $userId = null)
    {
        \App\Models\Log::create([
            'user_id' =>$userId,
            'action' => $action,
            'model' => $model,
            'model_id' => $modelId,
            'details' => is_array($details) ? json_encode($details) : $details,
        ]);
    }
}
