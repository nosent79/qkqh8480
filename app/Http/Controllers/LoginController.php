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
     * @return \Illuminate\View\View 'auth.login'
     */
    public function login()
    {
        if ($this->request->session()->has('user_id')) {

            return redirect()->route('task.index');
        }

        return view('auth.login');
    }

    /**
     * 로그인 처리
     *
     * @return \Illuminate\Http\RedirectResponse 'task.index'
     */
    public function loginOK()
    {
        try {
            $params = collect($this->request->all());
            $rstMember = $this->member->getMember($params);
            if ($rstMember === false) {
                throw new CustomException('회원정보가 일치하지 않습니다.', '1', route('auth.login'));
            }

            /*
             * 세션 등록하기
             */
            $this->request->session()->put('user_id', $rstMember->get('user_id'));
            $this->request->session()->put('user_name', $rstMember->get('user_name'));
            $this->request->session()->put('user_email', $rstMember->get('user_email'));

            return redirect()->route('task.index');
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__. $e);

            fnMoveUrl('오류가 발생했습니다.', 1, route('auth.login'));
        }
    }

    /**
     * 로그아웃 처리
     */
    public function logout()
    {
        try {
            if ($this->request->session()->has('user_id')) {
                $this->request->session()->flush();
            }

            fnMoveUrl('로그아웃 되었습니다.', 1, route('auth.login'));
        } catch (\Exception $e) {
            Log::error(__METHOD__, $e);
        }
    }
}