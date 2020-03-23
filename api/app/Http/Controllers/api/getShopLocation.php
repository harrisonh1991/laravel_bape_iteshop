<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use GuzzleHttp\Client;

class getShopLocation extends Controller
{

    protected $client;
    protected $refreshTime = '6000';
    /**
     * Display the specified resource.
     */
     
    public function get()
    {

        /*
            $this -> client = new Client();
            $res = $this -> client->request('GET', 'https://docs.google.com/spreadsheets/d/1yaKaGMzs-cBdGvqfc2FrbL4KZj2rfTZT82J1vxD0g6w/export?format=csv');
        */
    }

    protected function updateConfigFile(){

    }

    protected function checkConfigFile(){
        
    }

    protected function getRecord(){

    }

    protected function getResource(){

    }

    protected function readCSVHeaderFromGoogle(){

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
