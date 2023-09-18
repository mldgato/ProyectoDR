<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('iniciar', 'Home::iniciar');
$routes->get('admin/', 'Home::dashboard');

$routes->get('register', 'UserController::register');
$routes->post('store','UserController::store');
