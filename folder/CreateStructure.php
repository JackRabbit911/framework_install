<?php

class CreateStructure
{
    private array $structure;
    private array $paths;
    private bool $isApp = true;

    public function __construct($structure)
    {
        $this->structure = $structure;
    }

    public function __invoke()
    {
        $this->isApp = $this->isApp();
        $this->mkDir();
        $this->createFiles();
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

    private function isApp()
    {
        echo "Doy need to create application blank? (Y/n) ";
        $input = strtolower(trim(fgets(STDIN)));

        $confirm = match ($input) {
            'y', '' => true,
            'n' => false,
            default => $this->isApp()
        };

        return $confirm;
    }

    private function createFiles()
    {
        $index = include 'folder/blanks/index.php';
        $dir = $this->paths['entry_point'];
        file_put_contents($dir . '/index.php', $index);
    }
}
