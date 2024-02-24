<?php

class MkAppSys
{
    private $structure;

    public function __construct($structure)
    {
        $this->structure = $structure;
    }

    public function app()
    {
        $path = $this->structure['structure']['apppath'];
        $current = basename(getcwd());
        $path = str_replace("$current/", '', $path);

        $command = 'git clone https://github.com/JackRabbit911/az_framework_application ' . $path;
        exec($command);
        
        if (is_dir($path . '/.git')) {
            exec('rm -Rf ' . $path . '/.git');
            $return = "\x1b[32mApplication was installed successful\x1b[0m";
        } else {
            $return = 'We have some problem...';
        }

        return $return;
    }

    public function vendor()
    {
        $pwd = getcwd();

        $path = $this->structure['structure']['syspath'];
        $path = str_replace(basename($pwd) . '/', '', $path) . '/az';

        // var_dump($path); exit;

        if (!file_exists($path)) {
            mkdir($path, 0775, true);           
        }

        chdir($path);
        exec('git clone https://github.com/JackRabbit911/az_framework .');

        if (!isset($structure['az_dev']) || !$structure['az_dev']) {
            exec('rm -Rf .git');
            
            if (!is_file('../../composer.json')) {
                rename('composer.json', '../../composer.json');
            }

            if (!is_file('../../composer.lock')) {
                rename('composer.lock', '../../composer.lock');
            }
        } else {
                copy('composer.json', '../../composer.json');
                copy('composer.lock', '../../composer.lock');
        }

        chdir('../../');
        exec('composer update');        
        chdir($pwd);

        return "\x1b[32mVendor was installed successful\x1b[0m";
    }
}
