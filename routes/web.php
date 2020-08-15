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

$router->get('/', function ()  {
    return view('app');
});

$router->post('/login', 'AuthController@login');
$router->post('/register','AuthController@register');


$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->group(['prefix' => 'api'], function($router){
        $router->get('stats', 'StatController@showAllStats');
        $router->post('stats', 'StatController@create');
        $router->delete('stats/{id}', 'StatController@delete');
        $router->get('username', 'AuthController@showUserName');
    });
    $router->get('/logout', 'AuthController@logout');
    
});

$router->post('/email', 'ContactController@email');
$router->post('/verifytoken', 'ContactController@verifytoken');

// Below codes: I tried to setup the standard Laravel password reset, but in the end did not use it in my project
// $router->post('/password/reset-request', 'RequestPasswordController@sendResetLinkEmail');
// $router->post('/password/reset', [ 'as' => 'password.reset', 'uses' => 'ResetPasswordController@reset' ]);
