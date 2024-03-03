<?php

class MkDir
{
    private $structure;

    public function __construct($structure)
    {
        $this->structure = $structure;
    }

    public function writable()
    {
        $path = $this->structure['structure']['writable'];
        
        $search = basename(getcwd());
        $path = str_replace("$search/", '', $path);

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        chmod($path, 0777);

        mkdir($path . '/logs');
        mkdir($path . '/cache');
        mkdir($path . '/sessions');
        mkdir($path . '/uploads');

        chmod($path . '/logs', 0777);
        chmod($path . '/cache', 0777);
        chmod($path . '/sessions', 0777);
        chmod($path . '/uploads', 0777);

        rename('folder/logo.png', $path . '/uploads/logo.png');

        return "\x1b[32mWritable folder was created\x1b[0m";
    }

    public function docroot()
    {
        $path = $this->structure['structure']['docroot'];
        
        $search = basename(getcwd());
        $path = str_replace("$search/", '', $path);

        if (!is_dir($path)) {
            mkdir($path, 0775, true);
        }

        $entry_point = $this->structure['structure']['entry_point'] ?? null;
        
        if ($entry_point) {
            $search = basename(getcwd());
            $entry_point = str_replace(["$search/", '/index.php'], '', $entry_point);

            if ($path !== $entry_point) {
                mkdir($entry_point, 0775, true);
            }
        }

        return "\x1b[32mDocroot folder was created\x1b[0m";
    }
}
