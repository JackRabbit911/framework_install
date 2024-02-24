<?php

return <<<'FILE'
<?php

$GLOBALS['_start'] = hrtime(true);
$GLOBALS['_ram'] = memory_get_usage();

define('DOCROOT', __DIR__ . '/');
define('ROOTPATH', '{rootpath}');
define('SYSPATH', '{syspath}');
define('APPPATH', '{apppath}');
define('WRITABLE', '{writable}');

if (!empty(getenv('TZ'))) {
    date_default_timezone_set(getenv('TZ'));
}   

require_once SYSPATH . 'vendor/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/autoload.php';
require_once SYSPATH . 'vendor/az/sys/src/library.php';
require_once APPPATH . 'app/config/bootstrap.php';

$mode = getMode(APPPATH . 'app/config/mode.php');

$container = (new Sys\ContainerFactory($mode))->create(new DI\ContainerBuilder());
$app = $container->get(Sys\App::class);
$app->run();
FILE;

// $GLOBALS['_start'] = hrtime(true);
// $GLOBALS['_ram'] = memory_get_usage();

// define('DOCROOT', __DIR__ . '/');
// define('ROOTPATH', '../../');
// define('SYSPATH', ROOTPATH . 'www/');
// define('APPPATH', ROOTPATH . 'www/application/');
// define('WRITABLE', ROOTPATH . 'www/writable/');

// if (!empty(getenv('TZ'))) {
//     date_default_timezone_set(getenv('TZ'));
// }   

// require_once SYSPATH . 'vendor/autoload.php';
// require_once SYSPATH . 'vendor/az/sys/src/autoload.php';
// require_once SYSPATH . 'vendor/az/sys/src/library.php';
// require_once APPPATH . 'app/config/bootstrap.php';

// $mode = getMode(APPPATH . 'app/config/mode.php');

// $container = (new Sys\ContainerFactory($mode))->create(new DI\ContainerBuilder());
// $app = $container->get(Sys\App::class);
// $app->run();
