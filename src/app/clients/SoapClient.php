<?php

class SoapCaller
{
    private $url;
    private $client;

    public function __construct()
    {
        $this->url = SOAP_API;
    }

    public function call($url, $method, $params)
    {
        $this->client = new SoapClient($this->url . $url,
        array('trace' => 1, 'stream_context' => stream_context_create(
            array('http' => array('header' =>
            'Api-key: ' . SOAP_KEY)))));
        try {
            return $this->client->__soapCall($method, $params);
        } catch (SoapFault $fault) {
            echo "SOAP Fault: {$fault->faultcode} - {$fault->faultstring}";
            return false;
        }
    }
}
