<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Pastikan APP_KEY selalu tersedia
if (empty($_ENV['APP_KEY']) || empty(getenv('APP_KEY'))) {
    putenv('APP_KEY=base64:6lXyPb7pt9x81hpqMs6koXCNf0DfjDHEu5Kr+g4WO+8=');
    $_ENV['APP_KEY'] = 'base64:6lXyPb7pt9x81hpqMs6koXCNf0DfjDHEu5Kr+g4WO+8=';
    $_SERVER['APP_KEY'] = 'base64:6lXyPb7pt9x81hpqMs6koXCNf0DfjDHEu5Kr+g4WO+8=';
}

// Setup temporary writable storage directories on Vercel
$storageDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (! is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Maintenance mode check...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->useStoragePath('/tmp/storage');

$app->handleRequest(Request::capture());
