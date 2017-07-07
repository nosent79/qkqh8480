<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오후 4:42
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    protected $dates = ['deadline_date', 'del_date', 'reg_date', 'upd_date'];
    protected $fillable = [
                                'title', 'task_type', 'task_state', 'priority',
                                'price', 'deposit_date', 'corp_name', 'comment', 'deadline_date'
                            ];
    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

//    public function getTask()
//    {
//        return $this->get();
//    }

    /**
     * 태스크 등록
     * 
     * @param $params
     * @return bool
     */
    public function setTask($params)
    {
        try {
            $rgInsert = [
                'title'             => $params['title'],
                'task_type'         => $params['task_type'],
                'task_state'        => $params['task_state'],
                'priority'          => $params['priority'],
                'price'             => $params['price'],
                'deposit_date'      => $params['deposit_date'],
                'corp_name'         => $params['corp_name'],
                'comment'           => $params['comment'],
                'deadline_date'     => $params['deadline_date'],
            ];

            return $this->insertGetId($rgInsert);
        } catch (\Exception $e) {

            return false;
        }
    }
}