<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailNotificationJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * store
     *
     * Send data to queue email
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $email      = $request->email;
        $subject    = $request->subject;
        $body       = $request->body;
        $data       = [];

        dispatch(new SendEmailNotificationJob($email, $subject, $body, $data))->onQueue('emails');

        $code = Response::HTTP_OK;
        $message = 'success';

        $data = [
            'code'      => $code,
            'status'    => Response::$statusTexts[$code],
            'data'      => [],
            'message'   => $message,
            'errors'    => []
        ];

        return response()->json($data, $code);
    }
}
