<?php

return <<<'FILE'
#!{PATH2PHP}
<?php

define('DOCROOT', '{docroot}');
define('ROOTPATH', '{rootpath}');
define('APPPATH', '{apppath}');
define('SYSPATH', '{syspath}');
define('WRITABLE', '{writable}');
define('CONFIG', APPPATH . 'config/');

require_once SYSPATH . 'vendor/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/library.php';
require_once CONFIG . 'bootstrap.php';

$container = (new \Sys\ContainerFactory('cli'))
    ->create(new \DI\ContainerBuilder());

$app = $container->get('\Sys\Console\App');
$app->run();
FILE;
