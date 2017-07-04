<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오전 10:40
 */

namespace app\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 로그인 폼 화면
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        $this->request->session()->put('id', 'jerry');

        $params = collect($this->request->all());

        return view('auth.login',
            [
                'params' => $params
            ]
        );
    }

    /**
     * 로그인 처리
     *
     * @return \Illuminate\View\View
     */
    public function loginOK()
    {
        try {
            $params = collect($this->request->all());

            return redirect()->route('');
        } catch (\Exception $e) {

        }
    }

    public function logout()
    {
        try {
            if ($this->request->session()->has('user_id')) {
                $this->request->session()->flush();
            }
        } catch (\Exception $e) {
            Log::error(__METHOD__);
        }
    }
}