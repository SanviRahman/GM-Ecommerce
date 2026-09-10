<?php

/**
 * Laravel local/public front controller.
 *
 * The production cPanel deployment uses the project-root index.php. This
 * file exists so `php artisan serve` (which serves from /public) can boot
 * the same application without looking for vendor/ inside /public.
 */

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
