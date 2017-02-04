<?php


Route::group(['namespace' => '\Logs', 'middleware' => 'api'], function ($router) {
    $router->get('logs', 'LogsController@index');
});