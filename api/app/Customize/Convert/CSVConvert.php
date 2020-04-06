<?php
namespace App\Customize\Convert;

use App\Exceptions\LogException;

class CSVConvert{ 

    protected $logger;

    public function __construct(&$logger){
        $this->logger = &$logger;
    }

    public function FileToJson(&$path){
        $ctx = '';
        $ttl = '';
        $file;
        $res = array();
        $logger = &$this->logger;
        
        if (!file_exists($path))
            throw new LogException($logger,'File not found.');
    
        if (!$fp = fopen($path, "rb"))
            throw new LogException($logger,'File open failed.');

        $file = fopen($path, "r");
        if(!feof($file))
            $ttl = fgetcsv($file);
        while(!feof($file))
            $res[] = $this->twoArrayToKeyValJson($ttl,fgetcsv($file)); 
        fclose($file);

        return json_encode($res);
    }

    public function VarToJson(&$ctx){
        
    }
    
    protected function twoArrayToKeyValJson($key,$val){
        $res = array();
        for($i=0;$i<sizeof($key);$i++)
            $res[$key[$i]] = $val[$i];
        return $res;
    }
}