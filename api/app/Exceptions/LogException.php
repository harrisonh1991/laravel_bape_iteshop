<?php

namespace App\Exceptions;

use Exception;

class LogException extends Exception
{
    protected $logger, $message, $detail;

    /**
     * logger : Monolog - logger
     * message : title
     * detail : variable  
     * 
     * @param logger
     * @param message
     * @param detail
     * 
     */

    public function __construct(&$logger, $message, $detail = array(), $code = 0, Exception $previous = null){
        $this->message = $message;
        $this->detail = $detail;
        $this->logger = &$logger;
        parent::__construct($message, $code, $previous);
    }

    public function report()
    {
        $this->logger->error($this->message,$this->detail);
        exit();
    }

}
