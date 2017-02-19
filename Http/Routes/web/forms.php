<?php
Route::group(['namespace' => '\Contact', 'middleware' => ['web']], function ($router) {

    $router->post('forms/contact-us', 'ContactController@store');
});