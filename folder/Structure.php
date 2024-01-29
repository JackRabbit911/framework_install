<?php

class Structure
{
    private DrawFileSystem $draw;
    private string $projectName;

    public function __construct($project_name)
    {
        $this->draw = new DrawFileSystem();
        $this->projectName = $project_name;
    }
    public function __invoke()
    {
        $structure = include 'default_structure.php';

        echo 'Default structure:' . PHP_EOL . PHP_EOL;
        echo $this->draw->draw($structure, $this->projectName) . PHP_EOL;
               
        return $this->prompt($structure);
    }

    private function prompt($structure)
    {
        echo 'Are You confirm? (Y/n) ';
        $input = strtolower(trim(fgets(STDIN)));

        $confirm = match ($input) {
            'y', '' => $this->santize($structure),
            'n' => $this->interactive($structure),
            default => $this->prompt($structure)
        };

        return $confirm;
    }

    private function interactive($structure)
    {
        $root = basename(getcwd());
        $basepath = "$root/$this->projectName";

        echo "Enter path to vendor, relative '$basepath' folder: ";
        $structure['syspath'] = ($this->inputHandle($basepath, 'vendor')) ?: $structure['syspath'];
        
        echo "Enter path to app, relative '$basepath' folder: ";
        $structure['apppath'] = ($this->inputHandle($basepath, 'app')) ?: $structure['apppath'];

        echo "Enter path to document root, relative '$basepath' folder: ";
        $structure['docroot'] = ($this->inputHandle($basepath)) ?: $structure['docroot'];

        echo "Enter path to index.php, relative '$basepath' folder: ";
        $structure['entry_point'] = ($this->inputHandle($basepath)) ?: $structure['entry_point'];

        echo $this->draw->draw($structure, $this->projectName);

        return $this->prompt($structure);
    }

    private function inputHandle($basepath, $end = '')
    {
        $input = trim(fgets(STDIN));
        $input = trim($input, "\x22\x20\x27\x2F");

        if (!empty($input)) {
            $pos = strrpos($input, $end);
            $input = ($pos) ? rtrim(substr_replace($input, '', $pos), '/') : $input;
            return rtrim("$basepath/$input/$end", '/');
        }

        return str_replace('root/site.zone', $basepath, "root/site.zone/$end");
    }

    private function santize(&$structure)
    {
        $root = basename(getcwd());
        $replace = "$root/$this->projectName";

        foreach ($structure as &$path)
        {
            $path = str_replace('root/site.zone', $replace, $path);
        }

        return $structure;
    }
}
