<?php

class Scenario
{
    private string $file;

    public function __construct(string $file = './folder/default_structure.php')
    {
        // var_dump(realpath('./'), __DIR__); exit;
        if (!is_file($file)) {
            $file = './' . $file;
        }

        $this->file = $file;
    }

    public function __invoke()
    {
        $structure = include $this->file;

        $replace = basename(getcwd());

        foreach ($structure['structure'] as &$path) {
            $path = str_replace('root', $replace, $path);
            $path = str_replace("$replace/", '', $path);
        }

        if (!isset($structure['timezone'])) {
            $structure['timezone'] = date_default_timezone_get();
        }

        return $structure;
    }
}
