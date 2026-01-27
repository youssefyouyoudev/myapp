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
        try {
            \App\Models\Log::create([
                'user_id' => $userId,
                'action' => $action,
                'model' => $model,
                'model_id' => $modelId,
                'details' => is_array($details) ? json_encode($details) : $details,
            ]);
        } catch (\Throwable $e) {
            \Log::error('logUserAction failed', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id_type' => gettype($userId),
                'user_id_value' => $userId,
                'action_type' => gettype($action),
                'action_value' => $action,
                'model_type' => gettype($model),
                'model_value' => $model,
                'model_id_type' => gettype($modelId),
                'model_id_value' => $modelId,
                'details_type' => gettype($details),
                'details_value' => $details,
            ]);
        }
    }
}
