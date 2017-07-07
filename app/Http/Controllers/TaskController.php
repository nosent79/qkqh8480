<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오후 4:38
 */

namespace App\Http\Controllers;


use App\Exceptions\CustomException;
use App\Http\Model\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController
{
    private $request;
    private $task;

    public function __construct(Request $request, Task $task)
    {
        $this->request = $request;
        $this->task = $task;
    }

    /**
     * 업무 초기화면 (리스트)
     *
     * @return task.index
     */
    public function index()
    {
        $params = $this->request->all();
        $tasks = $this->task->get();
        return view('task.index', [
            'params' => $params,
            'tasks' => $tasks,
        ]);
    }

    /**
     * 업무 상세보기
     *
     * @return task.view
     */
    public function view($task_id)
    {
        try {
            if (empty($task_id)) {
                throw new CustomException('비정상적인 접근입니다.', 1, route('task.index'));
            }

//            삭제된 데이터를 보여줄 것인가 대한 논의 필요
//            $rstTask = collect($this->task::where('task_id', $task_id)->where('task_state', '<>', 'd')->first());
            $rstTask = collect($this->task::where('task_id', $task_id)->first());
            if ($rstTask->isEmpty()) {
                throw new CustomException('데이터가 없습니다.', 1, route('task.index'));
            }

            return view('task.view', [
                'params' => $rstTask,
            ]);
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__ . $e);
        }
    }

    /**
     * 업무 등록 폼
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        $params = $this->request->all();

        return view('task.register', [
            'params' => $params,
        ]);
    }

    /**
     * 업무 등록 처리
     */
    public function registerOK()
    {
        try {
            $params = $this->request->all();

            $rstTask = $this->task->setTask($params);
            if ($rstTask === false) {
                throw new CustomException('태스크 등록이 실패했습니다.', '1', route('task.index'));
            }

            fnMoveUrl('정상적으로 처리되었습니다.', 1, route('task.view', ['task_id' => $rstTask]));
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__. $e);

            fnMoveUrl('오류가 발생했습니다.', 1, route('task.index'));
        }
    }

    /**
     * 태스크 수정 화면
     *
     * @param $task_id
     * @return task.modify
     */
    public function modify($task_id)
    {
        try {
            if (empty($task_id)) {
                throw new CustomException('비정상적인 접근입니다.', 1, route('task.index'));
            }

            $rstTask = collect($this->task::where('task_id', $task_id)->first());

            return view('task.modify', [
                'params' => $rstTask,
            ]);
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__ . $e);
        }
    }

    /**
     * 태스크 수정 처리
     */
    public function modifyOK()
    {
        try {
            $params = collect($this->request->all());

            $rgUpdate = [
                'title'             => $params->get('title'),
                'task_type'         => $params->get('task_type'),
                'task_state'        => $params->get('task_state'),
                'priority'          => $params->get('priority'),
                'price'             => $params->get('price'),
                'deposit_date'      => $params->get('deposit_date'),
                'corp_name'         => $params->get('corp_name'),
                'comment'           => $params->get('comment'),
                'deadline_date'     => $params->get('deadline_date'),
            ];

            $result = $this->task::where('task_id', $params->get('task_id'))->update($rgUpdate);
            if ($result < 1) {
                throw new CustomException('오류가 발생했습니다.', 1, route('task.index'));
            }

            fnMoveUrl('정상적으로 처리되었습니다.', 1, route('task.view', ['task_id' => $params->get('task_id')]));
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__ . $e);
        }
    }

    /**
     * 태스크 삭제
     *
     * @param $task_id
     */
    public function delete($task_id)
    {
        try {
            if (empty($task_id)) {
                throw new CustomException('비정상적인 접근입니다.', 1, route('task.index'));
            }

            $rgUpdate = [
                'task_state' => 'd',
            ];
            $result = $this->task::where('task_id', $task_id)->update($rgUpdate);
            if ($result < 1) {
                throw new CustomException('오류가 발생했습니다.', 1, route('task.index'));
            }

            fnMoveUrl('정상적으로 처리되었습니다.', 1, route('task.index'));
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__ . $e);
        }
    }
}