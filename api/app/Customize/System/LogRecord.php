<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use \DateTime;

class LogRecord{
    protected $log, $log_name, $date_start;
    public function __construct($log_name){
        $this->date_start = new DateTime();
        $this->init();
    }

    public function end(){
        $this->date_end = new DateTime();
    }

    public function init(){
        $log = &$this->log;
        $log = new Logger($this->log_name);
        $log->pushHandler(new StreamHandler('Log/Sys/'.$this->date_start->format('Y_m_d').'.log', Logger::WARNING));
    }
}