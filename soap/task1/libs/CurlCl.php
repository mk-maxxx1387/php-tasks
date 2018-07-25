<?php

class CurlCl{
    public function __construct(){}

    public function invertStr($string){
        $url = TEXT_CASING_SERVICE."/InvertStringCase";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
        $response = curl_exec($ch);
        var_dump($responce);
        return $response;

    }

    public function getCurrencies(){
        $url = ."/ListOfCurrenciesByCode";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        $response = curl_exec($ch);
        $xml = new SimpleXMLElement($response);
        return $xml->tCurrency;
    }
}
