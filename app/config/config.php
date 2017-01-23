<?php 

// TODO : utiliser plutot des define et virer la partie GLOBAL
// TODO : utiliser plutot une info setEnv à mettre est dans le htaccess ?
// Mode
$config['production'] = false;

// Session rotation interval
$config['rotation_interval'] = 20;    

$config['base_url'] = '/nano/'; // Base URL including trailing slash (e.g. http://localhost/)

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
$config['db_host'] = 'localhost'; // Database host (e.g. localhost)
$config['db_port'] = '3306'; // Database port
$config['db_name'] = 'test'; // Database name
$config['db_user'] = 'root'; // Database username
$config['db_pass'] = 'toor'; // Database password

define("HTTP_OK", 200);
define("HTTP_CREATED", 201);
define("HTTP_NO_CONTENT", 204);
define("HTTP_MOVED_PERMANENTLY", 301);
define("HTTP_FOUND", 302);
define("HTTP_BAD_REQUEST", 400);
define("HTTP_UNAUTHORIZED", 401);
define("HTTP_FORBIDDEN", 403);
define("HTTP_NOT_FOUND", 404);
define("HTTP_INTERNAL_SERVER_ERROR", 500);

?>