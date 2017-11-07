<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-11
 * Time: 오후 1:59
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 초기화면
     */
    public function didimdolLoanRate()
    {
        header("Content-Type: text/html; charset=UTF-8");
        $agent = 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0; Trident/5.0)'; // 헤더항목 설정
        $ch = curl_init();
        $url = 'http://api.hf.go.kr:8090/service/rest/didimdolrat/getDidimdolLoanRat'; /*URL*/
        $queryParams = '?' . urlencode('ServiceKey') . '=8AdLm3md0wYYbilHBxoF1A8vs2aXr1qYAJmIUOTEcnGgJ9JCVUClt076JvREeNDTT1jCCRqn4iguUXjVKbHE9Q%3D%3D'; /*Service Key*/
//$queryParams .= '&' . urlencode('파라미터영문명') . '=' . urlencode('파라미터기본값'); /*파라미터설명*/
        curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_USERAGENT, $agent); // 헤더항목 추가
        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
    }
}