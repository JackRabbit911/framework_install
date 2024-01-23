<?php

echo ' ' . basename(getcwd()) . PHP_EOL
. "   ├ site.zone" . PHP_EOL
. "   │   ├ app" . PHP_EOL
. "   │   ├ htdocs" . PHP_EOL
. "   │   │   └ www" . PHP_EOL
. "   │   │       ├ .htaccess" . PHP_EOL
. "   │   │       └ index.php" . PHP_EOL
. "   │   ├ vendor" . PHP_EOL
. "   │   ├ .env" . PHP_EOL
. "   │   ├ .git" . PHP_EOL
. "   │   ├ .gitignore" . PHP_EOL
. "   │   ├ composer.json" . PHP_EOL
. "   │   └ console" . PHP_EOL
. "   ├ default.conf" . PHP_EOL
. "   ├ Dockerfile" . PHP_EOL
. "   └ docker-compose.yml" . PHP_EOL;
