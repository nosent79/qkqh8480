<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-11
 * Time: 오후 2:06
 */
namespace app\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $table = 'memos';
    protected $primaryKey = 'seq';
    protected $fillable = ['memo'];
    public $timestamps = false;

    /**
     * 메모 가져오기
     *
     * @return mixed
     */
    public function getMemo()
    {
        return $this->orderbyDesc('seq')->first();
    }

    /**
     * 메모 저장하기
     *
     * @param $params
     * @return bool
     */
    public function setMemo($params)
    {
        try {
            $rgInsert = [
                'memo'      => $params->get('memo'),
                'reg_date'  => \Carbon\Carbon::now(),
                'reg_id'    => $params->get('reg_id'),
                'reg_nm'    => $params->get('reg_nm'),
            ];

            return $this->insertGetId($rgInsert);
        } catch (\Exception $e) {

            return false;
        }
    }
}