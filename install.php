<?php

include 'folder/autoload.php';

system('clear');

new CheckRequirements;
$handler = (new CheckArgument)($argv);
$structure = $handler();

var_dump($structure);

// echo PHP_EOL, 'Installation begins', PHP_EOL, PHP_EOL;
// $make = new MkAppSys($structure);
// $msg = $make->app();
// echo $msg, PHP_EOL;

// $msg = $make->vendor();
// echo $msg, PHP_EOL;

// $mkDir = (new MkDir($structure));

// $msg = $mkDir->writable();
// echo $msg, PHP_EOL;

// $msg = $mkDir->docroot();
// echo $msg, PHP_EOL;

// $mkFiles = new MkFiles($structure);

// $msg = $mkFiles->dockerFiles();
// echo $msg, PHP_EOL;

// $msg = $mkFiles->env();
// echo $msg, PHP_EOL;

// $msg = $mkFiles->console();
// echo $msg, PHP_EOL;

// $msg = $mkFiles->index();
// echo $msg, PHP_EOL, PHP_EOL;

// if (isset($structure['adminer']) && $structure['adminer'] === true) {
//     $paths = $structure['structure'];
//     $entry_point = dirname($paths['entry_point']) ?? $paths['docroot'];
//     $dir = str_replace([basename(getcwd()) . '/', '/index.php'], '', $entry_point);
//     $todb = $dir . '/todb';

//     if (!is_dir($todb)) {
//         rename('folder/todb',  $dir . '/todb');
//     }
// }

// if (!isset($structure['dev']['install']) || $structure['dev']['install'] === false) {
//     exec('rm -Rf folder');
//     exec('rm -Rf .git');
//     unlink('.gitignore');
//     unlink('install.php');
// }

echo 'Insallation is complete!', PHP_EOL;
echo 'Up Your docker container and go to localhost', PHP_EOL;
exit;
