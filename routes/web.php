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

// API 테스트
$app->group(['prefix' => 'api'], function () use ($app) {
    // v1
    $app->group(['prefix' => 'v1'], function () use ($app) {
        //네이버 연동
        $app->get('/', [
            'as' => 'api.v1.index', 'uses' => 'SocialController@index'
        ]);
        $app->get('naver_login', [
            'as' => 'api.v1.naver_login', 'uses' => 'SocialController@naver_login'
        ]);
        $app->get('naver_callback', [
            'as' => 'api.v1.naver_callback', 'uses' => 'SocialController@callback_naver'
        ]);

        $app->get('didimdol_loan_rate', [
            'as' => 'api.v1.didimdol_loan_rate', 'uses' => 'APIController@didimdolLoanRate'
        ]);
    });
});

$app->group(['prefix' => 'member', 'middleware' => 'auth'], function () use ($app) {
    // 초기 멤버 셋팅
    $app->get('init_member', [
        'as' => 'member.init_member', 'uses' => 'MemberController@initMember'
    ]);

    // 비밀번호 변경 화면
    $app->get('change_password', [
        'as' => 'member.change_password', 'uses' => 'MemberController@changePassword'
    ]);

    // 비밀번호 변경 처리
    $app->post('change_password_ok', [
        'as' => 'member.change_password_ok', 'uses' => 'MemberController@changePasswordOK'
    ]);

    // 회원정보 변경 화면
    $app->get('modify_info', [
        'as' => 'member.modify_info', 'uses' => 'MemberController@modifyMemberInfo'
    ]);

    // 회원정보 변경 처리
    $app->post('modify_info_ok', [
        'as' => 'member.modify_info_ok', 'uses' => 'MemberController@modifyMemberInfoOk'
    ]);
});

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

/**
 * 메모 등록
 */
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

    // 삭제된 항목 불러오기
    $app->get('deleted_list', [
        'as' => 'task.deleted_list', 'uses' => 'TaskController@deletedList', function () {
    }]);

    // 통계
    $app->get('statistics', [
        'as' => 'task.statistics', 'uses' => 'TaskController@statistics', function () {
    }]);
});

/**
 * 메모 등록
 */
$app->group(['prefix' => 'memo', 'middleware' => 'auth'], function () use ($app) {
    $app->get('view', [
        'as' => 'memo.view', 'uses' => 'MemoController@view'
    ]);

    $app->get('register', [
        'as' => 'memo.register', 'uses' => 'MemoController@register'
    ]);

    $app->post('register_ok', [
        'as' => 'memo.register_ok', 'uses' => 'MemoController@registerOK'
    ]);
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

/**
 * 테스트 아이디 등록
 */
$app->get('initMember/{user_id:[A-Za-z0-9]+}', [
    'as' => 'initMember', 'uses' => 'MemberController@initMember', function ($user_id) {
}]);

$app->get('initMemberPwd/{user_id:[A-Za-z0-9]+}', [
    'as' => 'initMemberPwd', 'uses' => 'MemberController@forceChangePassword', function ($user_id) {
}]);

/*
 * Here is test code area
 */
//$app->get('/key', function() {
//    return str_random(32);
//});