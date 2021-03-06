<?php

class SoapCl{
    public function __construct(){
        
    }

    public function invertStr($string){
        $client = new SoapClient(TEXT_CASING_SERVICE."?WSDL");
        $result = $client->InvertStringCase(
            array("sAString" => $string)
        );
        return $result->InvertStringCaseResult;
    }

    public function getCurrencies(){
        $client = new SoapClient(COUNTRY_INFO_SERVICE."?WSDL");
        $result = $client->ListOfCurrenciesByCode();
        return json_encode($result->ListOfCurrenciesByCodeResult);
    }
}
