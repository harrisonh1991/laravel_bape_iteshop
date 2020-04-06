<?php
namespace App\Customize\Http;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Customize\System\LogHandler;

use \DateTime;

class GuzzleHttpHandler{
    protected 
        $url, 
        $logHandler, $log, $log_name,
        $res;

    public $client;

    /**
     * name in log file;
     * Connect and download the file with guzzlehttp, include exception and log function
     * @param $service_name
     * @param $url
     */
    public function __construct(&$log, $url,$header){
        $this->url = $url;
        $this->log = &$log;

        $this->initClient($header);
    }

    protected function getError($ctx){
        return array(
            "status"=>"error",
            "desc"=>$ctx
        );
    }

    protected function initClient($header){
        $client = &$this->client;
        $client = new Client($header);
        try{
            $this->res = $client->get($this->url);
        }catch(RequestException $e){
            $this->log->error('Url Error');
            exit();
        }
    }

    public function getResponse(){
        return $this->res;
    }

}