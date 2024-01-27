<?php

include 'folder/autoload.php';


// include 'folder/draw.php';

$root = basename(getcwd());

$paths = [
    // "$root/site",
    "$root/site/app/",
    // "$root/site/htdocs",
    "$root/site/htdocs/www/",
    // "$root/site/vendor",
    "$root/site/vendor/az/",
    "$root/site/console",
    "$root/docker-compose.yml",
    // "$root/app/"
];

$flat = [
    'hruhru',
    // 'docroot',
    // 'docroot/public',
    // 'docroot/public/uploads',
    'docroot/public/uploads/img',
    'docroot/public/assets',
    'docroot/public/index.php',
    'docroot/vendor',
    'docroot/vendor/public',
    'docroot/vendor/public/uploads',
    'docroot/vendor/public/uploads/img',
    'docroot/vendor/public/assets',
    'docroot/vendor/public/index.php',
    // 'docroot/public/hruhru',
    'kuku',
];

$php_version = PHP_VERSION;
var_dump($php_version);
echo date_default_timezone_get() . PHP_EOL;
echo getenv('TZ') . PHP_EOL;

echo (new DrawFileSystem)($paths);
