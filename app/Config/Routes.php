<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('auth', function($routes) {
    $routes->get('register', 'AuthController::registerPage');
    $routes->get('login', 'AuthController::loginPage');

    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');

    $routes->post('logout', 'AuthController::logout');
});

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('profile', 'ProfileController::index');
});
