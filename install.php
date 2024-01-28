<?php

// $w = "\x1b[31mWARNING!\x1b ";
$warning = "\x1b[33mWARNING!\x1b[0m";

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

// var_dump(get_loaded_extensions());
// exit;

$check = new CheckRequirements;

if (!$check()) {
    echo "$warning {$check->getMessage()}". PHP_EOL;
    exit;
}
// $php_version = PHP_VERSION;
// var_dump((new CheckRequirements)());
echo date_default_timezone_get() . PHP_EOL;
// echo getenv('TZ') . PHP_EOL;

echo (new DrawFileSystem)($paths);
