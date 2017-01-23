<?php 

define("BASE_URL", "/nano/"); // Base URL including trailing slash (e.g. http://localhost/)

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define("DB_HOST", "localhost"); // Database host (e.g. localhost)
define("DB_PORT", "3306"); // Database port
define("DB_NAME", "test"); // Database name
define("DB_USER", "root"); // Database username
define("DB_PASS", "toor"); // Database password

/**
 * Constants for HTTP response
 */
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