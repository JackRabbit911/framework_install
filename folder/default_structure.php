<?php

return [
    'project_name' => 'site.zone',
    'structure' => [
        'rootpath' => "root/site.zone",  
        'docroot' => "root/site.zone/htdocs/www",
        'entry_point' => "root/site.zone/htdocs/www/index.php",
        'apppath' => "root/site.zone/www/application",
        'syspath' => "root/site.zone/www/",
        'writable' => "root/site.zone/www/writable",
    ],
    'database' => [
        'root_pswd' => 'secret',
        'dbname' => 'test',
        'username' => 'test',
        'password' => '12345',
    ],
    'application' => 'https://github.com/JackRabbit911/az_framework_application',
    'system' => 'https://github.com/JackRabbit911/az_framework',
];
