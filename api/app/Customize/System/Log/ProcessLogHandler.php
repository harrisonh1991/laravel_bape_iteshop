<?php
namespace App\Customize\System\Log;

use \DateTime;
use App\Customize\System\Log\LogHandler;
/**
 * Record Some special system message only
 * Record datetime of start, end and execute.
 */
class ProcessLogHandler extends LogHandler{
    protected $date_end;

    public function __construct($log_name){
        parent::__construct($log_name);
        $this->info('Start',array());
    }

    public function __destruct(){
        $this->date_end = new DateTime();
        $diff = $this->date_start->diff($this->date_end); 
        $process = $diff->format("%hh %im %s.%fs");
        $this->info('End',array('process:'.$process));
    }

}