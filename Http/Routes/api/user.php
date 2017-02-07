<?php

Route::group(['namespace' => '\User', 'middleware' => ['api']], function ($router) {

    $router->get('user', 'UserController@user');
    $router->post('user', 'UserController@updateUser');

    $router->get('user/info', 'UserController@info');
    $router->post('user/info', 'UserController@updateInfo');

    $router->post('user/upload-avatar', 'UserController@updateAvatar');
    $router->post('user/select-avatar', 'UserController@selectAvatar');

    $router->get('user/images', 'UserController@images');

    $router->post('user/change-password', 'UserController@updatePassword');
});