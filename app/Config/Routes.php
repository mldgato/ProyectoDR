<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/* $routes->get('products/index','ProductController::index'); */

$routes->get('register', 'UserController::register');
$routes->post('store','UserController::store');
