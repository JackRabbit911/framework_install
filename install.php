<?php

$warning = "\x1b[33mWARNING!\x1b[0m";

include 'folder/autoload.php';

// var_dump(is_dir('folder'));
// echo substr(sprintf('%o', fileperms('folder')), -4);

// $len = strlen(basename(getcwd()));

// echo $len, ' ', substr('install/folder', $len+1);

// echo PHP_EOL;
// exit;
// var_dump(get_loaded_extensions());
// exit;
system('clear');
new CheckRequirements;
$project_name = (new SetProjectName)();
$timezone = (new SetTimeZone)();
$structure = (new Structure($project_name))();
(new CreateStructure($structure))();

var_dump($structure);
