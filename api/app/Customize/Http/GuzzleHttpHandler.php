<?php
namespace App\Customize\Http;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use \DateTime;

class GuzzleHttpHandler{
    protected 
        $url, $client, 
        $log, $log_name;
    public $res;

    /**
     * name in log file;
     * Connect and download the file with guzzlehttp, include exception and log function
     * @param $service_name
     * @param $url
     */
    public function __construct($log_name, $url){
        $this->url = &$url;
        $this->log_name = &$log_name;

        $this->initLog();
        $this->initClient();
    }

    protected function getError($ctx){
        return array(
            "status"=>"error",
            "desc"=>$ctx
        );
    }

    protected function initClient(){
        $client = &$this->client;
        $client = new Client();
        try{
            $this->res = $client->get($this->url);
        }catch(RequestException $e){
            $this->log->error('Url Error');
            exit();
        }
    }

    protected function initLog(){
        $date = new DateTime();
        $log = &$this->log;
        $log = new Logger($this->log_name);
        $log->pushHandler(new StreamHandler('Log/Sys/'.$date->format('Y_m_d').'.log', Logger::WARNING));
    }

}