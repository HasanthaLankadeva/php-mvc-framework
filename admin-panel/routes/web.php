<?php


$router->get('/', 'HomeController@login');
$router->post('/', 'HomeController@loginPost');

$router->group([
    'prefix' => 'admin',
    'middleware' => [AuthMiddleware::class]
], function($router){

    // /admin/dashboard
    $router->get('/dashboard', 'AdminController@dashboard');

});

$router->group([
    'prefix' => 'posts',
    'middleware' => [AuthMiddleware::class]
], function($router){

    // /posts
    $router->get('/', 'PostsController@index');

    // /posts/module/15
    $router->group(['prefix'=>'module'], function($router){

        $router->get('/{id}', 'PostsController@module');

    });

});

$router->group([
    'prefix' => 'modules',
    'middleware' => [AuthMiddleware::class]
], function($router){

    // modules
    $router->get('/', 'ModulesController@index');

    // /posts/module/15
    $router->group(['prefix'=>'tables'], function($router){

        $router->get('/{id}', 'ModulesController@tables');

    });

});

/*
$router->get('/admin/dashboard', 'AdminController@dashboard', [
    AuthMiddleware::class
]);



//$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->get('/post', 'PostController@index');
$router->get('/post/module/{id}', 'PostController@module');
//$router->get('/post', 'PostController@module');
//$router->get('/post', 'PostController@module');*/

