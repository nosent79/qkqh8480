<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$app->get('/', ['as' => '/', function () use ($app) {
     return redirect()->route('auth.login');
}]);

$app->group(['prefix' => 'auth'], function () use ($app) {
    $app->get('login', [
        'as' => 'auth.login', 'uses' => 'LoginController@login'
    ]);
    $app->post('login_ok', [
        'as' => 'auth.login_ok', 'uses' => 'LoginController@loginOK'
    ]);

    $app->get('logout', [
        'as' => 'auth.logout', 'uses' => 'LoginController@logout'
    ]);
});

$app->group(['prefix' => 'task', 'middleware' => 'auth'], function () use ($app) {
    // 업무 리스트
    $app->get('index', [
        'as' => 'task.index', 'uses' => 'TaskController@index'
    ]);

    // 업무 리스트
    $app->get('view/{task_id:[0-9]+}', [
        'as' => 'task.view', 'uses' => 'TaskController@view', function ($task_id) {
    }]);

    // 업무 등록 화면
    $app->get('register', [
        'as' => 'task.register', 'uses' => 'TaskController@register'
    ]);

    // 업무 등록 처리
    $app->post('register_ok', [
        'as' => 'task.register_ok', 'uses' => 'TaskController@registerOK'
    ]);

    // 업무 수정 화면
    $app->get('modify/{task_id:[0-9]+}', [
        'as' => 'task.modify', 'uses' => 'TaskController@modify', function ($task_id) {
    }]);

    // 업무 수정 처리
    $app->post('modify_ok', [
        'as' => 'task.modify_ok', 'uses' => 'TaskController@modifyOK'
    ]);

    // 업무 삭제
    $app->get('delete/{task_id:[0-9]+}', [
        'as' => 'task.delete', 'uses' => 'TaskController@delete', function ($task_id) {
    }]);
});

/*
 * lumen 과 laravel5.x exception handler 비교
    // lumen
    if ($e instanceof NotFoundHttpException) {

        return response(view('errors.404'), 404);
    }

    // laravel
    if ($e instanceof NotFoundHttpException) {

        return response()->view('errors.404', [], 404);
    }

    $app->group(['prefix' => 'errors'], function () use ($app) {
        $app->get('404', ['as' => 'errors.404', function () {
            //
            return view('errors.404');
        }]);
    });
 */


/*
 * Here is test code area
 */
//$app->get('/key', function() {
//    return str_random(32);
//});