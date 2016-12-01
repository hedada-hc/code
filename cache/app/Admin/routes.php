<?php

$router = app('admin.router');

$router->get('/', 'HomeController@index');
$router->get('/test', 'HomeController@test');
$router->get('/redis', 'CateController@index');
$router->resource('/content',CateController::class);

