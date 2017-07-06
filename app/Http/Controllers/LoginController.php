<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오전 10:40
 */

namespace App\Http\Controllers;


use App\Exceptions\CustomException;
use App\Http\Model\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    private $request;
    protected $member;

    public function __construct(Request $request, Member $member)
    {
        $this->request = $request;
        $this->member = $member;
    }

    /**
     * 로그인 폼 화면
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        if ($this->request->session()->get('user_id')) {

            return redirect()->route('task.index');
        }

        return view('auth.login');
    }

    /**
     * 로그인 처리
     *
     * @return \Illuminate\View\View
     */
    public function loginOK()
    {
        try {
            $datas = $this->request->all();

            $rstMember = $this->member->getMember($datas);

            if ($rstMember === false) {
                throw new CustomException('회원정보가 일치하지 않습니다.', '1', route('auth.login'));
            }

            /*
             * 세션 등록하기
             */
            $this->request->session()->put('user_id', $rstMember['attributes']['user_id']);
            $this->request->session()->put('user_name', $rstMember['attributes']['user_name']);
            $this->request->session()->put('user_email', $rstMember['attributes']['user_email']);

            return redirect()->route('task.index');
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__. $e);
        }
    }

    public function logout()
    {
        try {
            if ($this->request->session()->has('user_id')) {
                $this->request->session()->flush();
            }
        } catch (\Exception $e) {
            Log::error(__METHOD__, $e);
        }
    }
}