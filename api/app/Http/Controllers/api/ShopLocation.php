<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\Customize\Convert\CSVConvert;
use App\Customize\System\LogHandler;

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
        $csv = &$this->csv;
        $csv = new CSVConvert($this->logHandler);
        $json_shoplocation = $csv->FileToJson($this->file_path);
        Storage::put($this->txt_path, $json_shoplocation);
    }

    public function get(){
        return Storage::get($this->txt_path);
    }
}