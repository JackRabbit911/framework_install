<?php

return <<<'FILE'
#!{PATH2PHP}
<?php

define('DOCROOT', '{docroot}');
define('APPPATH', './');
define('SYSPATH', '{syspath}');

require_once SYSPATH . 'vendor/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/library.php';
require_once APPPATH . 'app/config/bootstrap.php';

$container = (new \Sys\ContainerFactory('cli'))
    ->create(new \DI\ContainerBuilder());

$app = $container->get('\Sys\Console\App');
$app->run();
FILE;
