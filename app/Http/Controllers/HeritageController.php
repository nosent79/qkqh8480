<?php
/**
 * Created by PhpStorm.
 * User: jerry
 * Date: 2018. 4. 13.
 * Time: PM 5:34
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeritageController
{
    private $request;
    private $heritage;

    public function __construct(Request $request, Heritage $heritage)
    {
        $this->request = $request;
        $this->heritage = $heritage;
    }

    public function getAgeCrltsList()
    {
        /*
         * 조회 파라미터
         */
        $nowPageNo = $this->request->get('nowPageNo', '10');
        $pageMg = $this->request->get('pageMg', '1');
        $ageCd = $this->request->get('ageCd', 'ETC');
        $wsdl = "http://openapi.cha.go.kr/openapi/soap/crlts/AgeCrltsService?wsdl";
        $uri = "http://openapi.cha.go.kr/openapi/soap/crlts/AgeCrltsService";
        $ser = "http://service.agecrlts.crlts.cha/";
        $func = "getAgeCrltsList";

        if (empty($ageCd)) {
            echo "정상적인 접근이 아닙니다.";

            exit;
        }

        $params = compact(
            'nowPageNo', 'pageMg', 'ageCd',
            'wsdl', 'uri', 'ser', 'func'
        );

        $this->heritage->setParam($params);
        $data = $this->heritage->decode();



        $crlts = [];
        foreach ($data['items']['item'] as $k => $v) {
//            $datas['crltsNo'] = $v['crltsNo'];
//            $datas['ctrdCd'] = $v['ctrdCd'];
//            $datas['itemCd'] = $v['itemCd'];
//
//            $result = getAgeCrltsDtls($datas);
//
//            if (!empty($result)) {
//                $v['crltsDc'] = $result['crltsDc'];
//                $v['imageUrl'] = $result['imageUrl'];
//                $v['signguNm'] = $result['signguNm'];
//            }
//
            array_push($crlts, $v);
        }


        dd($crlts);
//        $totalCnt = "";
//
//        $PagePerBlock = 10;
//
//        $pageNum = ceil($totalCnt / $numOfRows);  // 총 페이지
//        $blockNum = ceil($pageNum / $PagePerBlock); // 총 블록
//        $nowBlock = ceil($pageNo / $PagePerBlock);
//
//        $s_page = ($nowBlock * $PagePerBlock) - ($PagePerBlock - 1);
//
//        if ($s_page <= 1) {
//            $s_page = 1;
//        }
//        $e_page = $nowBlock*$PagePerBlock;
//        if ($pageNum <= $e_page) {
//            $e_page = $pageNum;
//        }
//
//        $pageInfo = compact('pageNo', 'PagePerBlock','PagePerblock', 'pageNum', 'blockNum', 'nowBlock', 's_page', 'e_page');
//        $pageParams = http_build_query(compact('arrange', 'contentTypeId'));
//
        return view('api.tour.index', [
//            'data'  => $data,
//            'params' => $info['searchFestival'],
//            'tour'  => $this->heritage->getService(),
//            'pages' => $pageInfo,
//            'pageParams' => $pageParams
        ]);
    }

    public function getAgeCrltsDtls()
    {
        try {
            $request  = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:head="http://apache.org/headers" xmlns:ser="http://service.agecrlts.crlts.cha/">';
            $request .= '    <soapenv:Header>';
            $request .= '        <head:ComMsgHeader>';
            $request .= '            <ServiceKey>'.SERVICE_KEY.'</ServiceKey>';
            $request .= '        </head:ComMsgHeader>';
            $request .= '    </soapenv:Header>';
            $request .= '    <soapenv:Body>';
            $request .= '        <ser:getAgeCrltsDtls>';
            $request .= '            <!--Optional:-->';
            $request .= '            <arg0>';
            $request .= '                <itemCd>'.$datas['itemCd'].'</itemCd>';
            $request .= '                <crltsNo>'.$datas['crltsNo'].'</crltsNo>';
            $request .= '                <ctrdCd>'.$datas['ctrdCd'].'</ctrdCd>';
            $request .= '            </arg0>';
            $request .= '        </ser:getAgeCrltsDtls>';
            $request .= '    </soapenv:Body>';
            $request .= '</soapenv:Envelope>';

            $soap_client = new SoapClient('http://openapi.cha.go.kr/openapi/soap/crlts/AgeCrltsService?wsdl', array('trace' => 1, 'exceptions' => 1));
            $response = $soap_client->__doRequest($request, 'http://openapi.cha.go.kr/openapi/soap/crlts/AgeCrltsService', '', SOAP_1_2);

            $clean_xml = '<?xml version="1.0" encoding="utf-8"?>' . $response;
            $clean_xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $clean_xml);

            $soap = simplexml_load_string($clean_xml);
            $data = $soap->soapBody->ns2getAgeCrltsDtlsResponse->return;
            $json = json_encode($data);
            $responseArray = json_decode($json, true);

            return $responseArray;
        } catch(\Exception $e) {

        }
    }
}