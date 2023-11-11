<?php

class SoapCaller{
    private $url;
    private $client;

    public function __construct(){
        $this->url = SOAP_API;
    }

    public function call($method, $params){
        $this->client = new SoapClient($this->url);
        return $this->client->__soapCall($method, $params);
    }


}