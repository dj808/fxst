<?php

use App\Zhenggg\Facades\Front;
use Illuminate\Routing\Router;

Front::registerHelpersRoutes();

Route::group([
    'prefix'        => config('front.prefix'),
    'namespace'     => Front::controllerNamespace(),
    'middleware'    => ['web', 'front'],
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->resource('/permissions', 'PermissionController');
    $router->resource('/department', 'DepartController');
    $router->resource('/menber', 'MenberController');
});