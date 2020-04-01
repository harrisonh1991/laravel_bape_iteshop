<?php
namespace App\Customize\Cache;

use \DateTime;

class CacheTimer{

    public function __construct(){
        $this->initDateNow();
    }

    protected $config = array(
        "date_format" => "Y-m-d H:i:s",
        "refreshDay" => 0
    ),
    $date_now;

    public function isPass($date){
        $date_record = new DateTime($date);
        $interval = $date_record->diff($this->date_now);
        return ($interval->d >= $this->config["refreshDay"])? true:false;
    }
    
    protected function initDateNow(){
        $date_now = &$this->date_now;
        if(is_null($date_now)||empty($date_now)){
            $date_now = new DateTime();
        }
    }

    public function getDateNow(){
        return $this->date_now->format($this->config["date_format"]);
    }
}