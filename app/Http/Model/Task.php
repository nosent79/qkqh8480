<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오후 4:42
 */
namespace App\Http\Model;

use App\Exceptions\CustomException;
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

    /**
     * 삭제 제외한 태스크 가져오기
     *
     * @param $params
     * @return mixed
     */
    public function getTaskExceptDeleted($params)
    {
        try {
            $column = $params->get('orderby');
            $orderby = 'deadline_date';
            $type = 'asc';

            $query = $this->where('task_state', '<>', 'd');

            // 상태
            if ($params->has('task_state')) {
                $where = 'task_state';
                $value = $params->get('task_state');

                $query->where($where, $value);
            }

            if (is_array($column)) {
                // 등록일
                if (array_key_exists('reg_date', $column)) {
                    $orderby = 'reg_date';
                    $type = $column['reg_date'];
                }
                $query->orderBy($orderby, $type);

                // 마감일
                if (array_key_exists('deadline_date', $column)) {
                    $orderby = 'deadline_date';
                    $type = $column['deadline_date'];
                }
                $query->orderBy($orderby, $type);
            }

            return $query->paginate(5);
        } catch (\Exception $e) {

            return false;
        }
    }

    /**
     * 삭제된 태스크 가져오기
     *
     * @return mixed
     */
    public function getTaskDeleted()
    {
        return $this->where('task_state', 'd')->get()->pluck('attributes');
    }

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
                'title'             => $params->get('title'),
                'task_type'         => $params->get('task_type'),
                'task_state'        => $params->get('task_state'),
                'priority'          => $params->get('priority'),
                'price'             => $params->get('price'),
                'deposit_date'      => $params->get('deposit_date'),
                'corp_name'         => $params->get('corp_name'),
                'comment'           => $params->get('comment'),
                'deadline_date'     => $params->get('deadline_date'),
                'reg_date'          => \Carbon\Carbon::now(),
            ];

            return $this->insertGetId($rgInsert);
        } catch (\Exception $e) {

            return false;
        }
    }
}