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
    $arr_root = explode('/', trim($root, '/'));
    $arr_path = explode('/', trim($path, '/'));
    $diff_root = array_diff($arr_root, $arr_path);
    $diff_path = array_diff($arr_path, $arr_root);
    $up = (empty($diff_root)) ? './' : str_repeat('../', count($diff_root));
    $down = implode('/', $diff_path);
    $str = $up . $down . '/';
    $str = preg_replace('/(\/){2,}/', '$1', $str);

    return $str;
}
