<?php

$warning = "\x1b[33mWARNING!\x1b[0m";

include 'folder/autoload.php';

// system('clear');
// var_dump($argv); exit;
new CheckRequirements;
$handler = (new CheckArgument)($argv);
$structure = $handler();
// $project_name = (new SetProjectName)();
// $timezone = (new SetTimeZone)();
// $structure = (new Structure($project_name))();
// (new CreateStructure($structure))($project_name, $timezone);

var_dump($structure);
