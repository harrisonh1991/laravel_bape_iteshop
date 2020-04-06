<?php
namespace App\Customize\System;

use App\Customize\LogHandler;
/**
 * Record Some special system message only
 * Record datetime of start, end and execute.
 */
class SystemLogHandler extends LogHandler{
    protected $date_end;

    public function __construct($log_name){
        parent::__construct($log_name);
    }

    public function __destruct(){
        $this->date_end = new DateTime();
    }

}