<?php

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
];

function santize_paths($paths)
{

    function cmp($a, $b)
    {
        if (str_ends_with($a, '/') && !str_ends_with($b, '/')) {
            return -1;
        } elseif (!str_ends_with($a, '/') && str_ends_with($b, '/')) {
            return 1;
        } else {
            return 0;
        }
    }

    usort($paths, 'cmp');

    foreach ($paths as $path) {
        $str = '';
        $arr = explode('/', $path);
        foreach ($arr as $item) {
            $str .= $item . '/';
            $full[] = rtrim($str, '/');
        }
    }

    return array_unique($full);
}

$full = santize_paths($paths);

var_dump($full); exit;

// echo ' ' . basename(getcwd()) . PHP_EOL
// . "   ├ site.zone" . PHP_EOL
// . "   │   ├ app" . PHP_EOL
// . "   │   ├ htdocs" . PHP_EOL
// . "   │   │   └ www" . PHP_EOL
// . "   │   │       ├ .htaccess" . PHP_EOL
// . "   │   │       └ index.php" . PHP_EOL
// . "   │   ├ vendor" . PHP_EOL
// . "   │   ├ .env" . PHP_EOL
// . "   │   ├ .git" . PHP_EOL
// . "   │   ├ .gitignore" . PHP_EOL
// . "   │   ├ composer.json" . PHP_EOL
// . "   │   └ console" . PHP_EOL
// . "   ├ default.conf" . PHP_EOL
// . "   ├ Dockerfile" . PHP_EOL
// . "   └ docker-compose.yml" . PHP_EOL;
