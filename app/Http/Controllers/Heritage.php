<?php
/**
 * Created by PhpStorm.
 * User: jerry
 * Date: 2018. 4. 2.
 * Time: PM 2:45
 */
namespace App\Http\Controllers;

define('SERVICE_KEY', urldecode("8AdLm3md0wYYbilHBxoF1A8vs2aXr1qYAJmIUOTEcnGgJ9JCVUClt076JvREeNDTT1jCCRqn4iguUXjVKbHE9Q%3D%3D"));

class Heritage {
    protected $resultCode;
    protected $resultMsg;
    public $data;
    private $url;
    private $param;
    public $error;
    public $info;
    private $service;

    protected $contentId;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->resultCode = '';
        $this->resultMsg = '';
        $this->data = [];
        $this->url = [];
        $this->param = [];
        $this->contentId = [];
        $this->service = [];
    }

    public function getParam()
    {
        return $this->param;
    }

    public function setParam($info)
    {
        $this->param = $info;
    }

    public function makeSoap()
    {
        $request  = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:head="http://apache.org/headers" xmlns:ser="'.$this->param['ser'].'">';
        $request .= '    <soapenv:Header>';
        $request .= '        <head:ComMsgHeader>';
        $request .= '            <ServiceKey>'.SERVICE_KEY.'</ServiceKey>';
        $request .= '        </head:ComMsgHeader>';
        $request .= '    </soapenv:Header>';
        $request .= '    <soapenv:Body>';
        $request .= '        <ser:'.$this->param['func'].'>';
        $request .= '            <!--Optional:-->';
        $request .= '            <arg0>';
        $request .= '                <nowPageNo>'.$this->param['nowPageNo'].'</nowPageNo>';
        $request .= '                <pageMg>'.$this->param['pageMg'].'</pageMg>';
        $request .= '                <ageCd>'.$this->param['ageCd'].'</ageCd>';
        $request .= '            </arg0>';
        $request .= '        </ser:'.$this->param['func'].'>';
        $request .= '    </soapenv:Body>';
        $request .= '</soapenv:Envelope>';

        return $request;
    }

    public function comSoap()
    {
        $request = $this->makeSoap();

        $soap_client = new \SoapClient($this->param['wsdl'], array('trace' => 1, 'exceptions' => 1));
        $response = $soap_client->__doRequest($request, $this->param['uri'], '', SOAP_1_2);

        return $response;

    }

    public function decode()
    {
        $response = $this->comSoap();

        $clean_xml = '<?xml version="1.0" encoding="utf-8"?>' . $response;
        $clean_xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $clean_xml);

        $soap = simplexml_load_string($clean_xml);
        $data = $soap->soapBody->ns2getAgeCrltsListResponse->return;
        $json = json_encode($data);
        $responseArray = json_decode($json, true);

        return $responseArray;
    }
}