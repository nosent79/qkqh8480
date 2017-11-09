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
    protected $dates = ['del_date', 'reg_date', 'upd_date'];
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
            $query = $this->select('tasks.*', 't.ordering')
                ->join('task_sort as t', function ($join) {
                    $join->on('tasks.task_state', '=', 't.code')
                        ->where('t.type', 'task_state');
                })
                ->orderby('t.ordering');

            $column = $params->get('orderby');
            $sort = "asc";

            if (app('session')->get('admin_flag') === 'N') {
                $query->where('reg_id', app('session')->get('user_id'));
            }

            // 타입
            if ($params->has('task_type')) {
                $where = 'task_type';
                $value = $params->get('task_type');

                if (empty($value)) {
                    $query->where($where, 'like', '%');
                } else {
                    $query->where($where, $value);
                }
            }

            // 상태
            if ($params->has('task_state')) {
                $where = 'task_state';
                $value = $params->get('task_state');

                if (empty($value)) {
                    $query->where($where, 'like', '%');
                } else {
                    $query->where($where, $value);
                }

                $sort = "desc";
            } else {
                $query->whereIn('task_state', ['w'] );
            }

            // 업체명
            if ($params->has('corp_name')) {
                $where = 'corp_name';
                $value = $params->get('corp_name');

                    $query->where($where, 'like', $value.'%');
            }

            if (is_array($column)) {
                // 등록일
                if (array_key_exists('reg_date', $column)) {
                    $orderby = 'reg_date';
                    $type = $column['reg_date'];

                    $query->orderBy($orderby, $type);
                }

                // 마감일
                if (array_key_exists('deadline_date', $column)) {
                    $orderby = 'deadline_date';
                    $type = $column['deadline_date'];

                    $query->orderBy($orderby, $type);
                }
            } else {
                $orderby = 'deadline_date';

                $query->orderBy($orderby, $sort);
            }

            return $query->paginate(10);
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
        return $this->where('task_state', 'd')->where('del_id', app('session')->get('user_id'))->get()->pluck('attributes');
    }

    /**
     * 통계
     */
    public function getTaskStatistics($params)
    {
        $query = $this
                    ->where('deposit_date', '<=', $params->get('e_date'))
                    ->where('deposit_date', '>=', $params->get('s_date'));

        if ($params->get('task_state') !== 'all') {
            $query->where('task_state', $params->get('task_state'));
        }

        if (app('session')->get('admin_flag') === 'N') {
            $query->where('reg_id', app('session')->get('user_id'));
        }

        $query->orderby('reg_date', 'desc');

        return $query;
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
                'price'             => $params->get('price'),
                'deposit_date'      => $params->get('deposit_date'),
                'corp_name'         => $params->get('corp_name'),
                'comment'           => $params->get('comment'),
                'deadline_date'     => $params->get('deadline_date'),
                'reg_date'          => \Carbon\Carbon::now(),
                'reg_id'            => app('session')->get('user_id'),
            ];

            return $this->insertGetId($rgInsert);
        } catch (\Exception $e) {

            return false;
        }
    }
}