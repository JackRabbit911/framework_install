<?php

class Interactive
{
    use InputTrait;

    private string $defaultName = 'site.zone';

    public function __invoke()
    {
        $structure['project_name'] = $this->prompt('Enter Your project name:', $this->defaultName);
    
        $timezone = date_default_timezone_get();
        $structure['timezone'] = $this->prompt('Enter Your time zone:', $timezone);

        $structure = include 'default_structure.php';
        $structure = (new Structure())($structure);

        $structure['database']['root_pswd'] = $this->prompt('Enter root password for MySQL:', 'secret');
        $structure['database']['dbname'] = $this->prompt('Enter database name:', 'test');
        $structure['database']['username'] = $this->prompt('Enter username:', 'test');
        $structure['database']['password'] = $this->prompt('Enter user password:', '12345');

        return $structure;
    }
}
