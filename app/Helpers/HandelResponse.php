<?php


namespace App\Helpers;


trait HandelResponse
{
    public function handleResponse( $message = null, $status = null){
        $array = [
            'message'=>$message,
            'status'=>$status,
        ];
        return response($array,$status);
    }
    public function handleResponseData($data= null, $message = null, $status = null){
        $array = [
            'data'=>$data,
            'message'=>$message,
            'status'=>$status,
        ];
        return response($array,$status);
    }
}
