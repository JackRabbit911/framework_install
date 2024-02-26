<?php

class MkFiles
{
    private $structure;

    public function __construct($structure)
    {
        $this->structure = $structure;
    }

    public function dockerFiles()
    {
        $dir = getcwd();
        $docroot = $this->structure['structure']['docroot'];
        $docroot = str_replace(basename($dir) . '/', '', $docroot);

        if (!is_file($dir . '/Dockerfile')) {
            $content = include 'folder/blanks/docker.php';
            file_put_contents($dir . '/Dockerfile', $content);
        }
    
        if (!is_file($dir . '/default.conf')) {
            $content = include 'folder/blanks/default_conf.php';
            $content = str_replace('{docroot}', $docroot, $content);
            file_put_contents($dir . '/default.conf', $content);
        }

        if (!is_file($dir . '/docker-compose.yml')) {
            $root_pswd = $this->structure['database']['root_pswd'] ?? 'secret';
            $timezone = $this->structure['timezone'];
            $content = include 'folder/blanks/docker_compose.php';
            file_put_contents($dir . '/docker-compose.yml', $content);
        }

        return 'Files Dockerfile, default.conf, docker-compose.yml was created';
    }

    public function env()
    {
        $root = basename(getcwd());
        $paths = $this->structure['structure'];
        $dir = str_replace($root . '/', '', $paths['apppath']);
        $project_name = $this->structure['project_name'];
        $timezone = $this->structure['timezone'];
        $dbname = $this->structure['database']['dbname'] ?? 'test';
        $username = $this->structure['database']['username'] ?? 'test';
        $password = $this->structure['database']['password'] ?? '12345';
        $content = include 'folder/blanks/env.php';
        file_put_contents($dir . '/.env', $content);

        return 'File .env was created';
    }

    public function console()
    {
        $paths = $this->structure['structure'];
        $dir = str_replace(basename(getcwd()) . '/', '', $paths['apppath']);
        exec('which php', $output);
        $path2php = $output[0];
        $docroot = getRelativePath($paths['apppath'], dirname($paths['entry_point']) ?? $paths['docroot']);
        $rootpath = getRelativePath($paths['apppath'], $paths['rootpath'] ?? dirname($paths['apppath']));
        $apppath = getRelativePath($paths['apppath'], $paths['apppath']);
        $syspath = getRelativePath($paths['apppath'], $paths['syspath']);
        $writable = getRelativePath($paths['apppath'], $paths['writable']);

        $content = include 'folder/blanks/console.php';
        $search = ['{PATH2PHP}', '{docroot}', '{rootpath}', '{apppath}', '{syspath}', '{writable}'];
        $replace = [$path2php, $docroot, $rootpath, $apppath, $syspath, $writable];
        $content = str_replace($search, $replace, $content);
        file_put_contents($dir . '/console', $content);

        return 'File console was created';
    }

    public function index()
    {
        $paths = $this->structure['structure'];
        $entry_point = dirname($paths['entry_point']) ?? $paths['docroot'];
        $dir = str_replace([basename(getcwd()) . '/', '/index.php'], '', $entry_point);
        
        $rootpath = getRelativePath($entry_point, $paths['rootpath'] ?? dirname($paths['apppath']));
        $syspath = getRelativePath($entry_point, $paths['syspath']);

        $apppath = getRelativePath($entry_point, $paths['apppath']);
        $writable = getRelativePath($entry_point, $paths['writable']);

        $content = include 'folder/blanks/index.php';
        $search = ['{rootpath}', '{syspath}', '{apppath}', '{writable}'];
        $replace = [$rootpath, $syspath, $apppath, $writable];
        $content = str_replace($search, $replace, $content);
        file_put_contents($dir . '/index.php', $content);

        $content = include 'folder/blanks/htaccess.php';
        file_put_contents($dir . '/.htaccess', $content);

        copy('folder/blanks/favicon.ico', $dir . '/favicon.ico');
        copy('folder/blanks/page404.html', $dir . '/page404.html');

        return 'Files index.php, htaccess, favicon.ico was created';
    }
}
