<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-11
 * Time: 오후 1:59
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\NaverAPI;

class SocialController extends Controller
{
    private $request;
    private $naver;

    public function __construct(Request $request, NaverAPI $naver)
    {
        $this->request = $request;
        $this->naver = $naver;
    }

    /**
     * 초기화면
     */
    public function index()
    {
        return "Here is SocialController index";
    }

    // 네이버 로그인 접근토큰 요청 예제
    public function naver_login()
    {
        $params = collect($this->request->all());
        $naver_api = $this->naver->getApiUrl();

        return view('auth.social.naver_login', [
            'params'    => $params,
            'url'       => $naver_api,
        ]);
    }

    // 네이버 로그인 콜백 예제
    public function callback_naver()
    {
        $params = collect($this->request->all());
        $code = $params->get('code');
        $state = $params->get('state');

        $naver_api = $this->naver->getApiUrl();

        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo "status_code:".$status_code."<br />";
        curl_close ($ch);

        if ($status_code == 200) {
            return $response;
        } else {
            return "Error 내용:".$response;
        }
    }
}