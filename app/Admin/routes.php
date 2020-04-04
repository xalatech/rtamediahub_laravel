<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('app-users', UserController::class);
    $router->resource('app-categories', CategoryController::class);
    $router->resource('app-posts', PostController::class);
    $router->resource('app-roles', RoleController::class);
    $router->resource('app-permissions', PermissionController::class);
});
