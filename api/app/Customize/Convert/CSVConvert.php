<?php
namespace App\Customize\Convert;

use App\Exceptions\LogException;

class CSVConvert{ 

    protected $logHandler, $file, $path;

    public function __construct(&$logHandler){
        $this->logHandler = &$logHandler;
    }

    public function FileToJson(&$path){
        $ctx = '';
        $ttl = '';
        $res = array();
        $this->path = $path;
        $file = &$this->file;
        $logHandler = &$this->logHandler;

        $this->checkFileExist();
        if(!feof($file))
            $ttl = fgetcsv($file);
        while(!feof($file))
            $res[] = $this->twoArrayToKeyValJson($ttl,fgetcsv($file)); 
        fclose($file);
        return json_encode($res);
    }

    protected function checkFileExist(){
        $path = $this->path;
        $file = &$this->file;
        if (!file_exists($path)&&!($file = fopen($path, "rb")))
            throw new LogException($logHandler,'File not found.');
    
        if (!$file)
            throw new LogException($logHandler,'File open failed.');
    }
    
    protected function twoArrayToKeyValJson($key,$val){
        $res = array();
        for($i=0;$i<sizeof($key);$i++)
            $res[$key[$i]] = $val[$i];
        return $res;
    }
}