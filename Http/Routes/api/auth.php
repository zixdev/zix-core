<?php

Route::group(['namespace' => '\Auth'], function ($router) {

    $router->post('register', 'RegisterController@register');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout');
    $router->post('forgot-password', 'ForgotPasswordController@reset');
    $router->post('reset-password', 'ResetPasswordController@reset');
    $router->post('user/account/activate', 'RegisterController@activateAccount');

    /*
     * Social Login Routes
     */
    $router->group(['middleware' => 'web'], function ($router) {
        $router->get('auth/social/login-with/{type}', 'SocialController@redirectToProvider');
        $router->get('auth/social/callback/{type}', 'SocialController@handleProviderCallback');
    });


});
