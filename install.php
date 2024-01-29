<?php

// $w = "\x1b[31mWARNING!\x1b ";
$warning = "\x1b[33mWARNING!\x1b[0m";

include 'folder/autoload.php';


// include 'folder/draw.php';

$root = basename(getcwd());

$paths = [
    // "$root/site",
    "$root/site.zone/app/",
    // "$root/site/htdocs",
    "$root/site.zone/htdocs/www/",
    // "$root/site/vendor",
    "$root/site.zone/vendor/az/",
    "$root/site.zone/console",
    "$root/docker-compose.yml",
    // "$root/app/"
];

$flat = [
    'hruhru',
    'docroot',
    'docroot/public',
    'docroot/public/uploads',
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
    // 'kuku',
];

// $foo = 'bar';
// $$foo = 'baz';
// echo $bar, $foo, ${'foo'}, ${'bar'};
// exit;

// var_dump(get_loaded_extensions());
// exit;
system('clear');
new CheckRequirements;
$project_name = (new SetProjectName)();
$timezone = (new SetTimeZone)();
$structure = (new Structure($project_name))();

var_dump($structure);

// $php_version = PHP_VERSION;
// var_dump((new CheckRequirements)());
// echo date_default_timezone_get() . PHP_EOL;
// echo getenv('TZ') . PHP_EOL;

// echo (new DrawFileSystem)($paths, $project_name);

// echo $timezone. ' ' . $project_name . PHP_EOL;
