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

        if (isset($this->structure['application'])) {
            $source = $this->structure['application'];
            $own_app = true;
        } else {
            $source = 'git clone https://github.com/JackRabbit911/az_framework_application';
            $own_app = false;
        }
        
        exec($source . ' ' . $path);
        
        if (!$own_app && is_dir($path . '/.git')) {
            exec('rm -Rf ' . $path . '/.git');
        }

        return "\x1b[32mApplication was installed successful\x1b[0m";
    }

    public function vendor()
    {
        $pwd = getcwd();

        $path = $this->structure['structure']['syspath'];
        $path = str_replace(basename($pwd) . '/', '', $path) . '/az';

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
