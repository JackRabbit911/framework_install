<?php

return <<<'FILE'
<?php

$GLOBALS['_start'] = hrtime(true);
$GLOBALS['_ram'] = memory_get_usage();

define('DOCROOT', __DIR__ . '/');
define('SYSPATH', '{syspath}');
define('APPPATH', '{apppath}');

if (!empty(getenv('TZ'))) {
    date_default_timezone_set(getenv('TZ'));
}   

require_once SYSPATH . 'vendor/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/library.php';
require_once APPPATH . 'app/config/bootstrap.php';

$container = (new Sys\ContainerFactory())->create(new DI\ContainerBuilder());
$app = $container->get(Sys\App::class);
$app->run();
FILE;
