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
