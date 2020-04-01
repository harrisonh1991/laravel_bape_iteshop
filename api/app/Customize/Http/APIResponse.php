<?php
namespace App\Customize\Http;

class APIResponse{
    protected $url, $client,$service_name;
    public $res;

    /**
     * Connect and download the file with guzzlehttp, include exception and log function
     * 
     * @param $url
     */
    
    public function __construct($service_name, $url){
        $this->client = new Client();
        $this->service_name = $service_name;
        $this->url = $url;
    }

    public function isRequestValid(){
        if($this->res->getStatusCode()==200)
            return true;
        return false;
    }
}