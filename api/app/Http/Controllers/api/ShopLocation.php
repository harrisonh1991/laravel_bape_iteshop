<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Exceptions\LogException;
use Illuminate\Support\Facades\Storage;
use App\Customize\Convert\CSVConvert;
use App\Customize\System\Log\LogHandler;
use App\Exceptions\FileNoFoundException;
use App\Customize\Http\HttpResponse;
use App\Customize\System\Log\ProcessLogHandler;

class ShopLocation extends Controller
{
    protected
        $file_path = 'https://docs.google.com/spreadsheets/d/1yaKaGMzs-cBdGvqfc2FrbL4KZj2rfTZT82J1vxD0g6w/export?format=csv',
        $txt_path = 'location/shop/data.txt',
        $log_name = 'ShopLocation',
        $res,
        $csv,
        $logHandler;

    public function __construct(){
        $logHandler = &$this->logHandler;
        $logHandler = new LogHandler($this->log_name);
    }

    public function update(){
        $SyslogHandler = new ProcessLogHandler($this->log_name." Update");
        $csv = &$this->csv;
        $csv = new CSVConvert($this->logHandler);
        $json_shoplocation = $csv->GoogleExportToJson($this->file_path);
        Storage::put($this->txt_path, $json_shoplocation);
        unset($SyslogHandler);
    }

    public function get(){
        $http_res = new HttpResponse();
        if(Storage::exists($this->txt_path)){
            $http_res->success(Storage::get($this->txt_path));
        }else{
            throw new FileNoFoundException($this->logHandler,'',array('shop location data txt'));
        }
    }
}