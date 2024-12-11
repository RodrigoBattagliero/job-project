<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Controller
{
    public static function rollback($e, $message ="Something went wrong!.") {
        //DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e, $message ="Something went wrong!.") {
        //Log::info($e);
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
