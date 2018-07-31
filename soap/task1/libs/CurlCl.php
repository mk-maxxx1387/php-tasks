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
        /*$xml = new SimpleXMLElement($response);
        $result = array();
        foreach($xml->tCurrency as $obj){
            $result[$obj->sISOCode] = $obj->sName;
            echo($result[$obj->sISOCode]);
        }
        //return $xml->tCurrency;
        */
        return simplexml_load_string($response);
    }
}
