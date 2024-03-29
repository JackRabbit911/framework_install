<?php

class Structure
{
    private DrawFileSystem $draw;

    public function __construct()
    {
        $this->draw = new DrawFileSystem();
    }

    public function __invoke($structure)
    {
        echo 'Default structure:' . PHP_EOL;
        echo $this->draw->draw($structure);
               
        return $this->prompt($structure);
    }

    private function prompt($structure)
    {
        echo PHP_EOL, 'Are You confirm? (Y/n) ';
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
        $structure = $this->santize($structure);

        $root = basename(getcwd());
        $basepath = "$root/{$structure['project_name']}";

        echo "Enter path to vendor, relative '$basepath/' folder: ";
        $structure['structure']['syspath'] = ($this->inputHandle($basepath, 'vendor')) ?: '';
        
        echo "Enter path to app, relative '$basepath/' folder: ";
        $structure['structure']['apppath'] = ($this->inputHandle($basepath, 'application')) ?: '';

        echo "Enter path to document root, relative '$basepath/' folder: ";
        $structure['structure']['docroot'] = ($this->inputHandle($basepath)) ?: '';

        echo "Enter path to index.php, relative '{$structure['structure']['docroot']}/' folder: ";
        $structure['structure']['entry_point'] = ($this->inputHandle($structure['structure']['docroot'], 'index.php')) ?: '';

        $structure['structure']['writable'] = str_replace('application', 'writable', $structure['structure']['apppath']);

        echo $this->draw->draw($structure);

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
        $replace = "$root/{$structure['project_name']}";

        foreach ($structure['structure'] as &$path)
        {
            $path = str_replace('root/site.zone', $replace, $path);
        }

        return $structure;
    }
}
