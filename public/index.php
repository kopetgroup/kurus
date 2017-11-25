<?php
// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
  return false;
}

require __DIR__ . '/../vendor/autoload.php';
session_start();

// Instantiate the app
$cfg = require __DIR__ . '/../app/config/settings.php';
$app = new \Slim\App($cfg);

// Set up dependencies
require __DIR__ . '/../app/config/dependencies.php';

// Register middleware
require __DIR__ . '/../app/config/middleware.php';

// Register routes
require __DIR__ . '/../app/config/routes.php';

// Run!
$app->run();
