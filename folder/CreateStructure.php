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

    public function __invoke($timezone)
    {
        $this->isApp = $this->confirm('Do You need to create application blank?');

        $this->mkDir();
        $this->createFiles($timezone);
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

    private function createFiles($timezone)
    {
        $dir = getcwd();
        $root_password = $this->propmpt('Enter root password for MySQL:', 'secret');
        $content = include 'folder/blanks/docker-compose.php';
        file_put_contents($dir . '/docker-compose.yml', $content);

        $content = include 'folder/blanks/index.php';
        $dir = $this->paths['entry_point'];
        file_put_contents($dir . '/index.php', $content);
    }
}
