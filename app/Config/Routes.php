<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/create', 'RegisterController::create');
$routes->get('/login', 'RegisterController::login');
$routes->post('/createlogin', 'RegisterController::createlogin');
$routes->get('/welcome', 'RegisterController::welcome');
$routes->get('/logout', 'RegisterController::logout');
