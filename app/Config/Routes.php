<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('iniciar', 'Home::iniciar');
$routes->post('logout', 'Home::logout');
/* $routes->get('admin/', 'Home::dashboard', ['filter' => 'authGuard']); */

$routes->get('register', 'UserController::register');
$routes->post('store','UserController::store');

$routes->group('admin', ['filter' => 'authGuard'], function ($routes) {
    // Rutas protegidas que solo deben ser accesibles para usuarios autenticados.
    $routes->get('/', 'Home::dashboard');
    // Agrega más rutas aquí si es necesario.
});