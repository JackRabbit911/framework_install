<?php

class SetProjectName
{
    public function __invoke()
    {
        echo 'Enter Your project name: ';
        $input = trim(fgets(STDIN));
        return trim($input, "\x22\x20\x27");
    }
}
