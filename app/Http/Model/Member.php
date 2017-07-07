<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오후 5:05
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash as Hash;
use Illuminate\Support\Facades\Log as Log;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $dates = [];
    protected $fillable = [
                                'user_id', 'user_name', 'user_pwd', 'user_email'
                            ];

    /**
     * 회원정보 가져오기
     * 
     * @param $params
     * @return mixed
     */
    public function getMember($params)
    {
        try {
            $rstMember = collect($this
                ->select('user_id', 'user_pwd', 'user_name', 'user_email')
                ->where('user_id', $params->get('user_id'))
                ->first());

            if (! Hash::check($params->get('user_pwd'), $rstMember->get('user_pwd'))) {

                return false;
            }

            return $rstMember;
        } catch (\Exception $e) {

            return false;
        }
    }

    /**
     * 비밀번호 체크하기
     *
     * @param $params
     * @return mixed
     */
    public function comparePassword($params)
    {
        try {
            $rstMember = collect($this
                ->select('user_pwd')
                ->where('user_id', $params->get('user_id'))
                ->first());

            if (! Hash::check($params->get('old_pwd'), $rstMember->get('user_pwd'))) {

                return false;
            }

            return true;
        } catch (\Exception $e) {

            return false;
        }
    }

    /**
     * 회원 비밀번호 설정 (변경)
     *
     * @param $params
     * @return mixed
     */
    public function setMemberPassword($params)
    {
        try {
            $password = app('hash')->make($params->get('user_pwd'));

            return $this
                        ->where('user_id', $params->get('user_id'))
                        ->update(['user_pwd' => $password]);

        } catch (\Exception $e) {
            log::error(__METHOD__, $e);
        }
    }

    /**
     * 비밀번호 변경
     *
     * @param $params
     * @return mixed
     */
    public function changePassword($params)
    {
        try {
            $new_pwd = app('hash')->make($params->get('user_pwd'));

            return $this
                ->where('user_id', app('session')->get('user_id'))
                ->update(['user_pwd' => $new_pwd]);
        } catch (\Exception $e) {
            log::error(__METHOD__, $e);

            return false;
        }
    }

    public function setMember($params)
    {
        try {
            $new_pwd = app('hash')->make($params->get('user_pwd'));

            $rgInsert = [
                'user_id' => $params->get('user_id'),
                'user_name' => $params->get('user_name'),
                'user_email' => $params->get('user_email'),
                'user_pwd' => $new_pwd,
            ];

            return $this->insert($rgInsert);
        } catch (\Exception $e) {
            log::error(__METHOD__, $e);

            return false;
        }
    }
}