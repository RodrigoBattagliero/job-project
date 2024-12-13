<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Controller
{
    public static function throw($e, $message ="Something went wrong!.") {
        throw new HttpResponseException(response()->json(["message"=> $message], 500));
    }

    public static function sendResponse($result , $message ,$code=200) {
        $response=[
            'success' => true,
            'data'    => $result
        ];
        if(!empty($message)){
            $response['message'] =$message;
        }
        return response()->json($response, $code);
    }
}
