<?php

function getCurrenciesCURL(){
        $url
= "/ListOfCurrenciesByCode";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "");
    $response = curl_exec($ch);
    $xml = new SimpleXMLElement($response);
    return $xml->tCurrency;
}

function invertStrCURL($string){
    $xml = '<?xml version="1.0" encoding="utf-8"?>
            <soap12:Envelope xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
                <soap12:Body>
                    <InvertStringCase xmlns="http://www.dataaccess.com/webservicesserver/">
                        <sAString>$string</sAString>
                    </InvertStringCase>
                </soap12:Body>
            </soap12:Envelope>';
    $url = TEXT_CASING_SERVICE.;
    $headers = array(
        'POST /webservicesserver/TextCasing.wso HTTP/1.1 ',
        'HOST: www.dataaccess.com',
        'Content-Type: application/soap+xml; charset="utf-8"',
        'Content-Length: '.strlen($xml),
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
    $response = curl_exec($ch);
    return $response;
}

//$result = invertStrCURL();
$result = getCurrenciesCURL();
foreach($result as $obj){
    var_dump($obj->sISOCode);
}


/* SOAP
$currencies = getCurrenciesSoap();

foreach($currencies as $curr){
    foreach($curr as $param){
        print_r("ISO Code: ".$param->sISOCode."<br>");
        print_r("Name: ".$param->sName."<br>");
    }
}
*/
