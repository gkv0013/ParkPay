<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

session_start();
/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add(' ', ['controller' => 'Home', 'action' => 'index']);
//$router->add('Login', ['controller' => 'Login', 'action' => 'Login']);
//$router->add('Signup', ['controller' => 'Signup', 'action' => 'Signup']);
//$router->add('Settings', ['controller' => 'Settings', 'action' => 'Settings']);
//$router->add('Vehicle', ['controller' => 'Vehicle', 'action' => 'Vehicle']);
//$router->add('Booking', ['controller' => 'Booking', 'action' => 'booking']);
//$router->add('Profile', ['controller' => 'Profile', 'action' => 'Profile']);
//$router->add('Parking', ['controller' => 'Parking', 'action' => 'Parking']);

$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
