<?php

class CreateStructure
{
    use InputTrait;

    private array $structure;
    private array $paths;
    private bool $isApp = true;

    public function __construct($structure)
    {
        $this->structure = $structure;
    }

    public function __invoke($project_name, $timezone)
    {
        $this->isApp = $this->confirm('Do You need to create application blank?');

        $this->mkDir();
        $this->createFiles($project_name, $timezone);
    }

    private function mkDir()
    {
        $pos = strlen(basename(getcwd())) + 1;

        foreach ($this->structure as $key => $path) {
            $dir = substr($path, $pos);

            if ($key === 'apppath') {
                if ($this->isApp) {
                    $dir = dirname($dir);
                } else {
                    continue;
                }
            }
 
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }

            $this->paths[$key] = $dir;
        }

        // var_dump($this->structure);
        // exit;
    }

    private function createFiles($project_name, $timezone)
    {
        $dir = getcwd();
        $docroot = $this->paths['docroot'];

        $content = include 'folder/blanks/docker.php';
        file_put_contents($dir . '/Dockerfile', $content);
        
        $content = include 'folder/blanks/default_conf.php';
        $content = str_replace('{DOCROOT}', $docroot, $content);
        file_put_contents($dir . '/default.conf', $content);

        $root_password = $this->prompt('Enter root password for MySQL:', 'secret');
        $content = include 'folder/blanks/docker-compose.php';
        file_put_contents($dir . '/docker-compose.yml', $content);

        $dir = $this->paths['apppath'];
        $dbname = $this->prompt('Enter database name:', 'test');
        $username = $this->prompt('Enter username:', 'test');
        $password = $this->prompt('Enter user password:', '12345');
        $content = include 'folder/blanks/env.php';
        file_put_contents($dir . '/.env', $content);
        // echo $this->structure['apppath'], PHP_EOL, dirname($this->structure['syspath']), PHP_EOL;
        exec('which php', $output);
        $path2php = $output[0];
        $syspath = getRelativePath($this->paths['apppath'], dirname($this->paths['syspath']));
        $content = include 'folder/blanks/console.php';
        $content = str_replace(['{PATH2PHP}', '{syspath}'], [$path2php, $syspath], $content);
        file_put_contents($dir . '/console', $content);

        // var_dump($res);
        // echo $path2php, PHP_EOL, $syspath, PHP_EOL;

        $dir = $this->paths['entry_point'];
        $syspath = getRelativePath($dir, dirname($this->paths['syspath']));
        $apppath = getRelativePath($dir, $this->paths['apppath']);
        $content = include 'folder/blanks/index.php';
        $content = str_replace(['{syspath}', '{apppath}'], [$syspath, $apppath], $content);
        file_put_contents($dir . '/index.php', $content);
    }
}
