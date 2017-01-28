<?php

Route::group(['namespace' => '\User', 'middleware' => ['api']], function ($router) {

    $router->get('roles', [
        'uses' => 'ManageUserRoleController@index',
        'before' => 'can:view_roles'
    ]);

    $router->get('roles/{id}', [
        'uses' => 'ManageUserRoleController@show',
        'before' => 'can:view_roles'
    ]);

    $router->get('roles/{id}/edit', [
        'uses' => 'ManageUserRoleController@edit',
        'before' => 'can:update_roles'
    ]);

    $router->post('roles', [
        'uses' => 'ManageUserRoleController@store',
        'before' => 'can:create_roles'
    ]);

    $router->put('roles/{id}', [
        'uses' => 'ManageUserRoleController@update',
        'before' => 'can:update_roles'
    ]);

    $router->delete('roles/{id}', [
        'uses' => 'ManageUserRoleController@destroy',
        'before' => 'can:delete_roles'
    ]);

    $router->get('roles/all/permissions', [
        'uses' => 'ManageUserRoleController@permissions',
        'before' => 'can:create_roles'
    ]);

    $router->post('roles/{id}/permissions', [
        'uses' => 'ManageUserRoleController@updatePermissions',
        'before' => 'can:update_roles'
    ]);

});