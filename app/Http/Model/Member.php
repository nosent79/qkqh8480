<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오후 5:05
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;
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

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * 회원정보 가져오기
     * 
     * @param $params
     * @return mixed
     */
    public function getMember($params)
    {
        try {
            $rstMember = $this
                ->select('user_id', 'user_pwd', 'user_name', 'user_email')
                ->where('user_id', 'jerry')
                ->first();

            if (! Hash::check($params['user_pwd'], $rstMember['user_pwd'])) {

                return false;
            }

            return $rstMember;
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
            $password = app('hash')->make($params['user_pwd']);

            return $this
                        ->where('user_id', $params['user_id'])
                        ->update(['user_pwd' => $password]);

        } catch (\Exception $e) {
            log::error(__METHOD__, $e);
        }
    }
}