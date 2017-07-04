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

$app->get('/', function () use ($app) {
    return url();
//    return $app->version();
});

$app->get('/login', [
    'as' => 'login', 'uses' => 'LoginController@login'
]);

$app->group(['prefix' => 'auth'], function () use ($app) {
    $app->get('login', [
        'as' => 'auth.login', 'uses' => 'LoginController@login'
    ]);

    $app->get('login_ok', [
        'as' => 'auth.login_ok', 'uses' => 'LoginController@loginOK'
    ]);

    $app->get('logout', [
        'as' => 'auth.logout', 'uses' => 'LoginController@logout'
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


/*
 * Here is test code area
 */
//$app->get('/key', function() {
//    return str_random(32);
//});