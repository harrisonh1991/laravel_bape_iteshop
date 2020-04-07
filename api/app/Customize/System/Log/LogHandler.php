<?php
namespace App\Customize\System\Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use \DateTime;

/**
 * Record Some special system message only
 */
class LogHandler{
    protected $log_name, $date_start;
    public $logger;
    
    public function __construct($log_name){
        $this->log_name = $log_name;
        $this->date_start = new DateTime();
    }

    public function error($msg,$detail){
        $logger = &$this->logger;
        $logger = new Logger($this->log_name);
        $logger->pushHandler(new StreamHandler('Log/error_'.$this->date_start->format('Y_m').'.log', Logger::DEBUG));
        $logger->error($msg,$detail);
    }

    public function info($msg,$detail){
        $logger = &$this->logger;
        $logger = new Logger($this->log_name);
        $logger->pushHandler(new StreamHandler('Log/info_'.$this->date_start->format('Y_m').'.log', Logger::DEBUG));
        $logger->info($msg,$detail);
    }

}