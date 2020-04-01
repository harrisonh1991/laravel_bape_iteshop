<?php
namespace App\Customize\Convert;

class CSVConvert{ 
    public function toJson(&$ctx){
        $ctx = '';
        $ttl = '';
        $res = array();

        $file = fopen($ctx,"rb");
        if(!feof($file))
            $ttl = fgetcsv($file);
        while(!feof($file))
            $res[] = $this->twoArrayToKeyValJson($ttl,fgetcsv($file));        
        fclose($file);
        return json_encode($res);
    }
    
    protected function twoArrayToKeyValJson($key,$val){
        $res = array();
        for($i=0;$i<sizeof($key);$i++)
            $res[$key[$i]] = $val[$i];
        return $res;
    }
}