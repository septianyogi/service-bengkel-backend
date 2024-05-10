<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{

    use AuthorizesRequests, ValidatesRequests, DispatchesJobs;
    
    public function responseOk($data = null, $message= null, $code=200)
    {
        $response = [
            'code' => $code,
            'message' => $message,
            'errors' => null,
            'data' => $data
        ];

        return response()->json($response, $code);
    }

    public function responseError($message = 'Bad Request', $code=400, $data=null, $error =[])
    {
        $response = [
            'code' => $code,
            'message' => $message,
            'errors' => $error,
            'data' => $data
        ];

        return response()->json($response, $code);
    }
}
