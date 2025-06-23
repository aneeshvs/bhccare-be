<?php

namespace App\Http\Controllers\Traits;

use illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait TResponseAndError
{
    /**
     * success response method.
     *
     * @param $result
     * @param null $message
     * @retuen response
     */

    public function sendResponse($result, $message = NULL): Response
    {
        $response = [
            'success' => TRUE,
            'message' => $message,
            'data'    => $result,
        ];
        if ($message === NULL) {
            unset($response['message']);
        }
        return response($response,200);
    }

    public function sendError($error, array $errorMessages =[], int $code =404): Response|JsonResponse
    {
        $response = [
            'success' => FALSE,
            'message' => $error,
        ];

        if (!empty($errorMessage)) {
            $response['errors'] = $errorMessages;
        }

        return response($response, $code);
    }

    public function sendNotImplementedYet($error , array $errorMessages = []): Response|JsonResponse
    {
        $response = [
            'success' => FALSE,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response($response, 501);
    }

}
