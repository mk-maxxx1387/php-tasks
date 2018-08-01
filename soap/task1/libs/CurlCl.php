<?php

class CurlCl{
    public function __construct(){}

    public function invertStr($string){
        $url = TEXT_CASING_SERVICE."/InvertStringCase";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "sAString=$string");
        $response = curl_exec($ch);
        return $response;

    }

    public function getCurrencies(){
        $url = COUNTRY_INFO_SERVICE."/ListOfCurrenciesByCode";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        $response = curl_exec($ch);
        return json_encode(simplexml_load_string($response));
    }
}
