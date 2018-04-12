<?php
/**
 * Created by PhpStorm.
 * User: jerry
 * Date: 2018. 4. 2.
 * Time: PM 2:45
 */
namespace App\Http\Controllers;

define('SERVICE_KEY', '8AdLm3md0wYYbilHBxoF1A8vs2aXr1qYAJmIUOTEcnGgJ9JCVUClt076JvREeNDTT1jCCRqn4iguUXjVKbHE9Q%3D%3D');
define('BASE_URL', 'http://api.visitkorea.or.kr/openapi/service/rest');
define('LANG_PATH', '/KorService/');

class Tour {
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

//    public function setParam(...$info)
//    {
//        foreach ($info as $v) {
//            array_push($this->param, $v);
//        }
//    }
    public function getParam()
    {
        return $this->param;
    }

    public function setParam($info)
    {
        $this->param = $info;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl(...$service)
    {
        $this->url = [];
        $this->service = $service;

        foreach ($service as $v) {
            array_push($this->url, BASE_URL . LANG_PATH . $v);
        }
    }

    public function getService()
    {
        return $this->service;
    }

    public function setContentId($contentId)
    {
        $this->contentId = $contentId;
    }

    public function getContentId()
    {
        return $this->contentId;
    }

    public function comCUrl($url)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            $responseJSON = curl_exec($ch);

            if (curl_error($ch)) {
                throw new \Exception();
            }
            curl_close($ch);

//            $this->data = $responseJSON;
            array_push($this->data, $responseJSON);

            return true;
        } catch (\Exception $e) {
            $this->error = $e;

            return false;
        }
    }

    public function fetchData()
    {
        if (count($this->service) > 1) {
            foreach ($this->service as $k => $v) {
                $param = http_build_query($this->param[$v]);
                $queryParams = $this->url[$k];
                $queryParams .= '?' . urlencode('ServiceKey') . '=' . SERVICE_KEY;
                $queryParams .= '&' . $param;

                if (!$this->comCUrl($queryParams)) {
                    return false;
                }
            }
            return true;
        }

        $service = implode("", $this->service);
        $param = http_build_query($this->param[$service]);
        $queryParams = implode("", $this->url);
        $queryParams .= '?' . urlencode('ServiceKey') . '=' . SERVICE_KEY;
        $queryParams .= '&' . $param;

        return $this->comCUrl($queryParams);
    }

    public function decode()
    {
        try {
            $resBody = [];
            if (!isset($this->data)) {
                throw new \Exception("Not exists data");
            }

            if (count($this->service) > 1) {
                foreach ($this->data as $k => $v) {
                    $response = json_decode($this->data[$k], true)['response'];
                    $resHeader = $response['header'];

                    $resBody[$this->service[$k]] = $response['body'];

                    if ($resHeader['resultCode'] !== "0000") {
                        // error 처리
                        throw new \Exception("Failure communication");
                    }

                }

                return $resBody;
            }

            $response = json_decode(implode("", $this->data), true)['response'];
            $resHeader = $response['header'];
            $resBody[$this->service[0]] = $response['body'];

            // 결과코드 체크
            if ($resHeader['resultCode'] !== "0000") {
                // error 처리
                throw new \Exception("Failure communication");
            }

        } catch (\Exception $e) {
            $this->error = $e;
            return false;
        }

        return $resBody;
    }

    public function fetchContentId()
    {
        $json = file_get_contents("tour_list.json");
        $data = json_decode($json, true);

        var_dump($data) or die();
    }

    public function createFile($opt = 'json')
    {
        var_dump($this->contentId) or die();
        file_put_contents("tour_list".".". $opt, $this->contentId);
    }
}