<?php

/**
 * Local development router for this cPanel-style Laravel project.
 *
 * `php artisan serve` uses /public as its document root, but this project
 * also keeps legacy public CSS/JS/images at the project root. Serve those
 * static assets safely while routing application requests through
 * /public/index.php.
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');

// Files already inside /public are handled directly by PHP's built-in server.
$publicFile = __DIR__ . '/public' . $uri;
if ($uri !== '/' && is_file($publicFile)) {
    return false;
}

// Legacy static assets stored at the project root on the cPanel deployment.
$allowedDirectories = ['assets', 'css', 'js', 'images', 'fonts', 'libs'];
$mimeTypes = [
    'css' => 'text/css; charset=UTF-8',
    'js' => 'application/javascript; charset=UTF-8',
    'map' => 'application/json; charset=UTF-8',
    'json' => 'application/json; charset=UTF-8',
    'png' => 'image/png',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'gif' => 'image/gif',
    'webp' => 'image/webp',
    'svg' => 'image/svg+xml',
    'ico' => 'image/x-icon',
    'woff' => 'font/woff',
    'woff2' => 'font/woff2',
    'ttf' => 'font/ttf',
    'eot' => 'application/vnd.ms-fontobject',
    'otf' => 'font/otf',
    'mp4' => 'video/mp4',
    'webm' => 'video/webm',
    'ogg' => 'audio/ogg',
    'mp3' => 'audio/mpeg',
    'wav' => 'audio/wav',
    'pdf' => 'application/pdf',
    'txt' => 'text/plain; charset=UTF-8',
    'xml' => 'application/xml; charset=UTF-8',
];

$relativePath = ltrim($uri, '/');
$firstSegment = strtolower(strtok($relativePath, '/') ?: '');
$rootFile = __DIR__ . '/' . $relativePath;
$extension = strtolower(pathinfo($rootFile, PATHINFO_EXTENSION));

if (
    $uri !== '/'
    && in_array($firstSegment, $allowedDirectories, true)
    && isset($mimeTypes[$extension])
    && is_file($rootFile)
) {
    header('Content-Type: ' . $mimeTypes[$extension]);
    header('Content-Length: ' . filesize($rootFile));
    readfile($rootFile);
    return true;
}

// Root-level public files used by the live site.
if ($relativePath === 'robots.txt' && is_file($rootFile)) {
    header('Content-Type: text/plain; charset=UTF-8');
    readfile($rootFile);
    return true;
}

if ($relativePath === 'favicon.ico' && is_file($rootFile)) {
    header('Content-Type: image/x-icon');
    readfile($rootFile);
    return true;
}

require_once __DIR__ . '/public/index.php';
