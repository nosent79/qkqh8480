<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오후 4:38
 */

namespace app\Http\Controllers;


use Illuminate\Http\Request;

class TaskController
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 업무 초기화면 (리스트)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $params = $this->request->all();

        return view('task.index', [
            'params' => $params,
        ]);
    }

    /**
     * 업무 상세보기
     *
     * @return \Illuminate\View\View
     */
    public function view()
    {
        $params = $this->request->all();

        return view('task.view', [
            'params' => $params,
        ]);
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

    public function registerOK()
    {
        try {
            $datas = $this->request->all();
dd($datas);
            return redirect()->route('task.view');
        } catch (\Exception $e) {
            log::error(__METHOD__, $e);
        }
    }

    public function modify()
    {

    }

    public function modifyOK()
    {

    }

    public function delete()
    {

    }
}