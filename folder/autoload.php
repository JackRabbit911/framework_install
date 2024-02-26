<?php

spl_autoload_register(function ($className) {

    $file = str_replace('\\', '/', $className) . '.php';

    if (!is_file($file)) {
        $file = 'folder/' . $file;
    }

    if (!is_file($file)) {        
        return false;
    }

    require_once $file;
    return true;
});

if (!function_exists('mb_substr_replace')) {
	function mb_substr_replace($original, $replacement, $position, $length)
	{
		$startString = mb_substr($original, 0, $position, 'UTF-8');
		$endString = mb_substr($original, $position + $length, mb_strlen($original), 'UTF-8');
		$out = $startString . $replacement . $endString;
		return $out;
	}
}

function getRelativePath($root, $path)
{
    if ($root === $path) {
        return './';
    }

    $arr_root = explode('/', trim($root, '/'));
    $arr_path = explode('/', trim($path, '/'));

    foreach ($arr_root as $key => &$val) {
        if (isset($arr_path[$key]) && $val === $arr_path[$key]) {
            array_shift($arr_root);
            array_shift($arr_path);
        }
    }

    $up = (empty($arr_root)) ? './' : str_repeat('../', count($arr_root));
    $down = implode('/', $arr_path);

    $str = $up . $down . '/';
    $str = preg_replace('/(\/){2,}/', '$1', $str);

    return $str;
}
