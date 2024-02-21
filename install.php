<?php

$warning = "\x1b[33mWARNING!\x1b[0m";

include 'folder/autoload.php';

system('clear');
new CheckRequirements;
$project_name = (new SetProjectName)();
$timezone = (new SetTimeZone)();
$structure = (new Structure($project_name))();
(new CreateStructure($structure))($project_name, $timezone);

var_dump($structure);
