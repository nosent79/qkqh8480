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
     * 업무 등록 폼
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return 'register';
//        return view('task.register', [
//
//        ]);
    }

    public function registerOK()
    {

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