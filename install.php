<?php

include 'folder/autoload.php';

system('clear');

new CheckRequirements;
$handler = (new CheckArgument)($argv);
$structure = $handler();

echo PHP_EOL, 'Installation begins', PHP_EOL, PHP_EOL;
$make = new MkAppSys($structure);
$msg = $make->app();
echo $msg, PHP_EOL;

$msg = $make->vendor();
echo $msg, PHP_EOL;

$mkDir = (new MkDir($structure));

$msg = $mkDir->writable();
echo $msg, PHP_EOL;

$msg = $mkDir->docroot();
echo $msg, PHP_EOL;

$mkFiles = new MkFiles($structure);

$msg = $mkFiles->dockerFiles();
echo $msg, PHP_EOL;

$msg = $mkFiles->env();
echo $msg, PHP_EOL;

$msg = $mkFiles->console();
echo $msg, PHP_EOL;

$msg = $mkFiles->index();
echo $msg, PHP_EOL, PHP_EOL;

echo 'Insallation is complete!', PHP_EOL;
echo 'Up Your docker container and go to localhost', PHP_EOL;
