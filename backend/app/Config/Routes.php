<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->options('(:any)', function () {
    return response()->setStatusCode(200);
});


$routes->group('api/v1', function($routes) {

    // Auth públicas
    $routes->post('auth/register', 'Api\V1\AuthController::register');
    $routes->post('auth/login', 'Api\V1\AuthController::login');
    $routes->post('auth/logout', 'Api\V1\AuthController::logout');
    $routes->get('auth/me', 'Api\V1\AuthController::me', ['filter' => 'auth']);

    // Rutas protegidas
    $routes->group('', ['filter' => 'auth'], function($routes) {
        $routes->resource('projects', [
            'controller' => 'Api\V1\ProjectController'
        ]);
    });

});
