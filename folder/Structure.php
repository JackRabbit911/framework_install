<?php

class Structure
{
    private DrawFileSystem $draw;
    // private string $projectName;
    // private array $structure;

    public function __construct()
    {
        $this->draw = new DrawFileSystem();
        // $this->projectName = $project_name;
        // $this->structure = $structure;
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
        $root = basename(getcwd());
        $basepath = "$root/{$structure['projectName']}";

        echo "Enter path to vendor, relative '$basepath/' folder: ";
        $structure['syspath'] = ($this->inputHandle($basepath, 'vendor')) ?: '';
        
        echo "Enter path to app, relative '$basepath/' folder: ";
        $structure['apppath'] = ($this->inputHandle($basepath, 'app')) ?: '';

        echo "Enter path to document root, relative '$basepath/' folder: ";
        $structure['docroot'] = ($this->inputHandle($basepath)) ?: '';

        echo "Enter path to index.php, relative '{$structure['docroot']}/' folder: ";
        $structure['entry_point'] = ($this->inputHandle($structure['docroot'])) ?: '';

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
