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

$router->group(['middleware' => 'jwt.auth'], function () use ($router) {
    $router->get('users','UserController@index');
    $router->get('user/{id}','UserController@show');
});
$router->post('/auth/login','AuthController@auth');

$router->get('/key', function () {
    return str_random(32);
});
