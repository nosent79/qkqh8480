<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-07
 * Time: 오후 3:02
 */
namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Model\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class MemberController extends Controller
{
    private $request;
    protected $member;

    public function __construct(Request $request, Member $member)
    {
        $this->request = $request;
        $this->member = $member;
    }

    /**
     * 비밀번호 변경 테스트
     */
    public function forceChangePassword()
    {
        $params = collect(['user_id'=>'jerry', 'user_pwd'=>'wlsnrl']);
        $result = $this->member->setMemberPassword($params);

        echo ($result > 0) ? "성공" : "실패";
    }

    /**
     * 패스워드 변경 화면
     */
    public function changePassword()
    {

        return view('member.change_password');
    }

    /**
     * 패스워드 변경 처리
     */
    public function changePasswordOK()
    {
        try {
            $params = collect($this->request->all());
            $params->put('user_id', app('session')->get('user_id'));

            $validator = Validator::make($this->request->all(), [
                'old_pwd'       => 'required',
                'new_pwd'       => 'required',
                'new_pwd_re'    => 'required|same:new_pwd'
            ]);

            if ($validator->fails()) {
                fnMoveUrl('부정확한 정보가 입력되었습니다.', 1, route('member.change_password'));
            }

            // 기존 비밀번호 체크
            $rstMember = $this->member->comparePassword($params);
            if ($rstMember === false) {
                throw new CustomException('기존 비밀번호가 정확하지 않습니다.', '1', route('member.change_password'));
            }

            $result = $this->member->changePassword($params);
            if (empty($result)) {
                throw new CustomException('비밀번호 변경에 실패했습니다.', '1', route('member.change_password'));
            }

            fnMoveUrl('정상적으로 처리되었습니다.', 1, route('member.change_password'));
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__ . $e);
        }
    }

    /**
     * 회원정보 변경 화면
     */
    public function modifyMemberInfo()
    {

        return view('member.modify_info');
    }

    /**
     * 회원정보 변경 화면
     */
    public function modifyMemberInfoOK()
    {
        try {
            $params = collect($this->request->all());
            $params->put('user_id', app('session')->get('user_id'));

            $validator = Validator::make($this->request->all(), [
                'old_pwd'       => 'required',
                'user_name'     => 'required',
                'user_email'    => 'required|email'
            ]);

            if ($validator->fails()) {
                fnMoveUrl('부정확한 정보가 입력되었습니다.', 1, route('member.modify_info'));
            }

            // 기존 비밀번호 체크
            $rstMember = $this->member->comparePassword($params);
            if ($rstMember === false) {
                throw new CustomException('비밀번호가 정확하지 않습니다.', '1', route('member.modify_info'));
            }

            $rstMember = $this->member->modifyMemberInfo($params);
            if ($rstMember === false) {
                throw new CustomException('회원정보 수정 시 오류가 발생했습니다.', '1', route('member.modify_info'));
            }

            fnMoveUrl('정상적으로 처리되었습니다.', 1, route('member.modify_info'));
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__ . $e);
        }
    }

    /**
     * 초기 데이터 등록
     */
    public function initMember($user_id)
    {
        $user_info = collect($this->member->where('user_id', $user_id)->get()->pluck('attributes'));
        if ($user_info->count() > 0) {
            fnMoveUrl('이미 등록되어있습니다', 1, route('/'));
        }

        $params = collect([
                            'user_id'       => $user_id,
                            'user_name'     => '사용자',
                            'user_pwd'      => $user_id,
                            'user_email'    => ''
        ]);
        $result = $this->member->setMember($params);

        echo ($result > 0) ? "성공" : "실패";
    }
}