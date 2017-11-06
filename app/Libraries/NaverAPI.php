<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-11-06
 * Time: 오후 6:10
 */

namespace App\Libraries;

class NaverAPI
{
    private $client_id;
    private $client_secret;
    private $callback_url;
    private $api_url;
    private $state;

    public function __construct($return_url = '')
    {
        $this->client_id = env('NAVER_CLIENT_ID');
        $this->client_secret = env('NAVER_CLIENT_SECRET');
        $this->callback_url = urlencode(route('api.v1.naver_callback'));
        $this->state = $this->generate_state($return_url);
        $this->api_url = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$this->client_id."&redirect_uri=".$this->callback_url."&state=".$this->state;
    }

    private function generate_state($return_url)
    {
        $mt = microtime();
        $rand = mt_rand();

        return md5($mt . $rand) . "|" . $return_url;
    }

    public function getApiUrl()
    {
        return $this->api_url;
    }
}