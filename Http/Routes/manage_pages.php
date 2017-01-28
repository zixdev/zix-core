<?php

Route::group(['namespace' => '\Pages', 'middleware' => 'api'], function ($router) {


    $router->get('pages', [
        'uses' => 'ManagePageController@index',
        'before' => 'can:view_pages'
    ]);

    $router->get('pages/{id}', [
        'uses' => 'ManagePageController@show',
        'before' => 'can:view_pages'
    ]);

    $router->post('pages', [
        'uses' => 'ManagePageController@store',
        'before' => 'can:create_pages'
    ]);

    $router->put('pages/{id}', [
        'uses' => 'ManagePageController@update',
        'before' => 'can:update_pages'
    ]);

    $router->delete('pages/{id}', [
        'uses' => 'ManagePageController@destroy',
        'before' => 'can:delete_pages'
    ]);
});
