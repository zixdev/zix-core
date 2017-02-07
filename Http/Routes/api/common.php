<?php

Route::group([], function ($router) {
    $router->get('web/pages/{slug}', 'Pages\PageController@show');
    $router->post('web/contact-us', 'Contact\ContactController@store');
});