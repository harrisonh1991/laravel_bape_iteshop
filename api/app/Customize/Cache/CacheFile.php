<?php

namespace App\Customize\Cache;

use GuzzleHttp\Client;
use App\Customize\Cache\CacheTimer;
use Illuminate\Support\Facades\Storage;

class CacheFile{
    protected
        $file_path,
        $record_path,
        $record_content,
        $cache_timer,
        $isPass = false;

        /**
         * Init your file you want to read
         * file path which store the data you want to return
         * record path which store last modify date you could do the cachce
         *
         * @param  string  $file_path
         * @param  string  $record_path
         */
        public function __construct($file_path,$record_path){
            $this->file_path = $file_path;
            $this->record_path = $record_path;
            $this->cache_timer = new CacheTimer();
        }

        public function getPass(){
            if(Storage::exists($this->record_path)){
                $this->readRecord();
            }else{
                $this->isPass = true;
                $this->updateRecord();
            }
            return $this->isPass;
        }

        protected function readRecord(){
            $this->record_content = json_decode(Storage::get($this->record_path));

            $isPass = &$this->isPass;

            $isPass = ($this->isComplete())?
                (($this->cache_timer->isPass($this->record_content->lastUpdate))?true:false):true;
            
            if($isPass){
                $this->updateRecord();
                //$this->getRemoteCSV();
            }
        }
    
        protected function isComplete(){
            return (is_object($this->record_content))?((array_key_exists('lastUpdate',$this->record_content))?true:false):false;
        }
    
        protected function updateRecord(){
            $update_date =  $this->cache_timer->getDateNow();
            $record = array(
                "lastUpdate" => $update_date
            );
            Storage::put($this->record_path, json_encode($record));
        }        

        protected function getRemoteCSV(){
            if($this->isPass){
                
            }
        }
}
