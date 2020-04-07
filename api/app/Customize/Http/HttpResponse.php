<?php
namespace App\Customize\Http;

class HttpResponse{
    
    public function error($res){
        $out = json_encode(array(
            'status'=>'error',
            'response'=>$res
        ));
        echo $out;
    }

    public function success($res){
        $out = json_encode(array(
            'status'=>'success',
            'response'=>$res
        ));
        echo $out;
    }
}