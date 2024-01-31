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
        var_dump($dir);
        file_put_contents($dir . '/.env', $content);

        $content = include 'folder/blanks/index.php';
        $dir = $this->paths['entry_point'];
        file_put_contents($dir . '/index.php', $content);
    }
}
