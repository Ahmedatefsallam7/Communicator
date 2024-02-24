<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;


trait GeneralTrait
{
    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function successResponse($message, $data = null)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function errorResponse($message, $errors = null, $status_code = 422)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => [$errors]
        ], $status_code);
    }

    public function forbiddenAccessResponse($message, $errors = null, $status_code = 403)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => [$errors]
        ], $status_code);
    }

    public function notFoundResponse($message = null, $status = null)
    {
        return response()->json([
            'status' => $status ?? false,
            'message' => $message ?? __('main.missing_data'),
            'data' => null
        ], 404);
    }

    public function unsetNullValues(array $data)
    {
        return array_filter($data, fn ($val) => $val !== null || $val !== false || $val !== '');
    }

    function sendMail($user, $mail): void
    {
        Mail::to($user)->send($mail);
    }
}
