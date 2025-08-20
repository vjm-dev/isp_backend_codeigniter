<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('v1', function($routes) {
    // Auth
    $routes->post('auth/login', 'Auth::login');
    
    // User
    $routes->get('users/(:segment)/data', 'User::getUserData/$1');
    
    // Data usage
    $routes->post('users/(:segment)/usage', 'DataUsage::updateUsage/$1');
    
    // Plans
    $routes->get('plans', 'Plan::getPlans');
});