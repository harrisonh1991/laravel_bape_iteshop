<?php
namespace App\Customize\Convert;

use \Exception;
use App\Exceptions\LogException;
use App\Exceptions\FileNoFoundException;
use App\Exceptions\FileOpenFailException;

class CSVConvert{ 

    protected $logHandler, $file, $path;

    public function __construct(&$logHandler){
        $this->logHandler = &$logHandler;
    }

    public function GoogleExportToJson(&$path){
        $ctx = '';
        $ttl = '';
        $res = array();
        $this->path = $path;
        $file = &$this->file;
        $logHandler = &$this->logHandler;

        $this->checkGoogleExportExist();
        if(!feof($file))
            $ttl = fgetcsv($file);
        while(!feof($file))
            $res[] = $this->twoArrayToKeyValJson($ttl,fgetcsv($file)); 
        fclose($file);
        return json_encode($res);
    }

    protected function checkGoogleExportExist(){
        $path = $this->path;
        $file = &$this->file;
        $logHandler = &$this->logHandler;

        try{
            $file = fopen($this->path, "rb");
        }catch(Exception $e){
            throw new FileNoFoundException($this->logHandler,'',array('Google Export Url'));
        }
    }
    
    protected function twoArrayToKeyValJson($key,$val){
        $res = array();
        for($i=0;$i<sizeof($key);$i++)
            $res[$key[$i]] = $val[$i];
        return $res;
    }
}