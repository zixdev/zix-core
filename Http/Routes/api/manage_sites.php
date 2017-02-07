<?php

Route::group(['namespace' => '\Site', 'middleware' => ['api']], function ($router) {
    $router->get('sites', [
        'uses' => 'SiteController@index',
        'before' => 'can:view_sites'
    ]);

    $router->get('sites/{id}', [
        'uses' => 'SiteController@show',
        'before' => 'can:view_sites'
    ]);

    $router->post('sites', [
        'uses' => 'SiteController@store',
        'before' => 'can:create_sites'
    ]);

    $router->put('sites/{id}', [
        'uses' => 'SiteController@update',
        'before' => 'can:update_sites'
    ]);

    $router->delete('sites/{id}', [
        'uses' => 'SiteController@destroy',
        'before' => 'can:delete_sites'
    ]);

    $router->get('sites/{id}/themes', [
        'uses' => 'SiteUiController@index',
        'before' => 'can:view_site_themes'
    ]);

    $router->post('sites/{id}/themes', [
        'uses' => 'SiteUiController@store',
        'before' => 'can:create_site_themes'
    ]);

    $router->get('sites/{id}/config', [
        'uses' => 'SiteConfigController@index',
        'before' => 'can:view_site_configs'
    ]);

    $router->post('sites/{id}/config', [
        'uses' => 'SiteConfigController@store',
        'before' => 'can:create_site_configs'
    ]);

});