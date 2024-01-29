<?php

class SetProjectName
{
    private string $defaultName = 'site.zone';

    public function __invoke()
    {
        echo "Enter Your project name [$this->defaultName]: ";
        $input = trim(fgets(STDIN));
        return (empty($input)) ? $this->defaultName : trim($input, "\x22\x20\x27");
    }
}
