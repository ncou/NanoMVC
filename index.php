<?php
/*
 * Nano v0.1.0
 */
// Base paths
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'app/');

require(APP_DIR .'config/config.php');

require(ROOT_DIR .'core/autoload.php');
Autoload::loadClasses(array(
  ROOT_DIR .'core/',
  ROOT_DIR .'core/mvc/',
  ROOT_DIR .'core/db/',
  APP_DIR . 'controllers/',
  APP_DIR . 'helpers/',
  APP_DIR . 'models/',
  APP_DIR . 'plugins/',
  //add your paths here
));

// store global var
global $config;

// Define base URL 
define('BASE_URL', $config['base_url']);


// Start a session
session_start(); 

// Set variable for tracking the number of requests per session id
if(!isset($_SESSION['regen'])) {
    $_SESSION['regen'] = 0;
}

// Rotate session id every N requests to protect from session fixation
if(++$_SESSION['regen'] > $config['rotation_interval']) {
    $_SESSION['regen'] = 0;
    session_regenerate_id(true);
}     

// PHP settings for dev or production mode 
if(!$config['production']) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
	error_reporting(NULL);
    ini_set('display_errors', '0');
}


// Load the routes to dispatch the request
require(APP_DIR .'config/routes.php');

loadRoutes();

?>
