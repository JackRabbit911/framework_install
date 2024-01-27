<?php

class DrawFileSystem
{
    public function __invoke($paths)
    {
        $lines = [];
        $s = '   ';
        $f = '├';
        $i = '│';
        $l = '└';

        $paths = $this->santize_paths($paths);

        foreach ($paths as $path) {
            $key = dirname($path) ?? 'root';
            $file = basename($path);
            $lasts[$key] = $file;
        }

        foreach ($paths as $k => $path) {
            $key = dirname($path) ?? 'root';
            $file = basename($path);
            $count = substr_count($path, '/');

            $pin = (isset($lasts[$key]) && $lasts[$key] === $file) ? $l : $f;
            
            $space = str_repeat($s, $count);
            $lines[] = $space . $pin . ' ' . $file . ' ' . PHP_EOL;

            if ($k > 0) {
                $pos = -1;

                while(($pos = mb_strpos($lines[$k-1], $f, $pos+1)) !== false) {
                    if (mb_substr($lines[$k], $pos, 1, 'UTF-8') === ' ') {
                        $lines[$k] = mb_substr_replace($lines[$k], $i, $pos, 1);
                    }
                }

                $pos = -1;

                while(($pos = mb_strpos($lines[$k-1], $i, $pos+1)) !== false) {
                    if (mb_substr($lines[$k], $pos, 1, 'UTF-8') === ' ') {
                        $lines[$k] = mb_substr_replace($lines[$k], $i, $pos, 1);
                    }
                }
            }
        }

        return implode('', $lines);
    }

    private function santize_paths($paths)
    {   
        foreach ($paths as $path) {
            $str = '';
            $arr = explode('/', $path);
            foreach ($arr as $item) {
                $str .= $item . '/';
                $full[] = rtrim($str, '/');
            }
        }
    
        return array_values(array_unique($full));
    }
}
