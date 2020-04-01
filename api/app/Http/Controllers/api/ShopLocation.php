<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Customize\Convert\CSVConvert;

class ShopLocation extends Controller
{
    protected
        $file_path = 'https://docs.google.com/spreadsheets/d/1yaKaGMzs-cBdGvqfc2FrbL4KZj2rfTZT82J1vxD0g6w/export?format=csv',
        $txt_path = 'location/shop/data.txt';

    public function update(){
        $client = new Client();
        $csv = new CSVConvert();
        $res = $client->getStatusCode();
        $json_shoplocation = $csv->toJson($this->file_path);
        Storage::put($this->txt_path, $json_shoplocation);
    }

    public function get(){
        return Storage::get($this->txt_path);
    }

}