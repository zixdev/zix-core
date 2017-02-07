<?php

Route::group(['namespace' => '\Contact', 'middleware' => 'api'], function ($router) {

    $router->get('forms/contact', [
        'uses' => 'ManageContactController@index',
        'before' => 'can:view_forms'
    ]);

    $router->get('forms/contact/{id}', [
        'uses' => 'ManageContactController@show',
        'before' => 'can:view_forms'
    ]);


    $router->post('forms/contact/{id}', [
        'uses' => 'ManageContactController@store',
        'before' => 'can:update_forms'
    ]);

    $router->delete('forms/contact/{id}', [
        'uses' => 'ManageContactController@destroy',
        'before' => 'can:delete_forms'
    ]);

});