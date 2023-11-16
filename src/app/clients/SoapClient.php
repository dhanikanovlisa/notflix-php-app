<?php

class SoapCaller{
    private $url;
    private $client;

    public function __construct(){
        $this->url = SOAP_API;
    }

    public function call($url, $method, $params){
        $this->client = new SoapClient($this->url . $url);
        $this->createHeader();
        try {
            return $this->client->__soapCall($method, $params);
        } catch (SoapFault $fault) {
            echo "SOAP Fault: {$fault->faultcode} - {$fault->faultstring}";
            return false;
        }
    }

    public function createHeader(){
        $headerParams = array(
            'Api-key' => SOAP_KEY,
        );
        print_r($headerParams);
        $header = new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'Api-key', $headerParams);
        
        $this->client->__setSoapHeaders($header);
    }
    
}