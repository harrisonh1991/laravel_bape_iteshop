<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\Customize\Convert\CSVConvert;

use App\Customize\Http\GuzzleHttpHandler;

class ShopLocation extends Controller
{
    protected
        $file_path = 'https://docs.google.com/spreadsheets/d/1yaKaGMzs-cBdGvqfc2FrbL4KZj2rfTZT82J1vxD0g6w1/export?format=csv',
        $txt_path = 'location/shop/data.txt',
        $log_name = 'ShopLocation',
        $gizzle,
        $csv;

    public function __construct(){
        $this->gizzle = new GuzzleHttpHandler($this->log_name,$this->file_path);
    }

    public function update(){
        $gizzle = &$this->gizzle;
        $csv = &$this->csv;
        $csv = new CSVConvert();
        $json_shoplocation = $csv->toJson($gizzle->res->getBody());
        Storage::put($this->txt_path, $json_shoplocation);
    }

    public function get(){
        return Storage::get($this->txt_path);
    }
}