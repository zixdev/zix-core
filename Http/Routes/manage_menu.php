<?php

Route::group(['namespace' => '\Menu', 'middleware' => 'api'], function ($router) {


    $router->get('menu', [
        'uses' => 'ManageMenuController@index',
        'before' => 'can:view_menu'
    ]);

    $router->get('menu/{id}', [
        'uses' => 'ManageMenuController@show',
        'before' => 'can:view_menu'
    ]);

    $router->post('menu', [
        'uses' => 'ManageMenuController@store',
        'before' => 'can:create_menu'
    ]);

    $router->put('menu/{id}', [
        'uses' => 'ManageMenuController@update',
        'before' => 'can:update_menu'
    ]);

    $router->post('menu/{id}', [
        'uses' => 'ManageMenuController@updateLinksOrder',
        'before' => 'can:update_menu'
    ]);

    $router->post('menu/{id}/links', [
        'uses' => 'ManageMenuController@addLink',
        'before' => 'can:update_menu'
    ]);

    $router->delete('menu/{id}', [
        'uses' => 'ManageMenuController@destroy',
        'before' => 'can:delete_menu'
    ]);
});
