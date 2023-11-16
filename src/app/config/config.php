<?php 

define('DIRECTORY', __DIR__);
define('HOST', $_ENV['POSTGRES_HOST']);
define('DB', $_ENV['POSTGRES_DB']);
define('USER', $_ENV['POSTGRES_USER']);
define('PASS', $_ENV['POSTGRES_PASSWORD']);
define('PORT', $_ENV['POSTGRES_PORT']);

define('SOAP_API', $_ENV['PHP_SOAP_URL']);
define('SOAP_KEY', $_ENV['SOAP_KEY']);
define('MAX_SIZE_PROFILE', 800 * 1024);
define('MAX_SIZE_POSTER', 1 * 1024 * 1024 );
define('MAX_SIZE_VIDEO', 5 * 1024 * 1024 );
define('MAX_SIZE_HEADER', 1 * 1024 * 1024 );