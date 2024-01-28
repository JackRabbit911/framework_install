<?php

class SetTimeZone
{
    public string $timeZone;

    public function __construct()
    {
        $this->timeZone = date_default_timezone_get();
        echo "Your time zone: '$this->timeZone' Y/n? ";
        $this->prompt();
    }

    private function setTimeZone()
    {
        echo 'Enter Your time zone: ';
        $this->timeZone = trim(fgets(STDIN));
        $this->timeZone = trim($this->timeZone, "\x22\x20\x27");
        echo "Ok, Your time zone is: '$this->timeZone'" . PHP_EOL;
    }

    private function unknown()
    {
        echo 'Your answer not recognized. Please enter "Y", "y" or "n" ';
        $this->prompt();
    }

    private function prompt()
    {
        $line = strtolower(trim(fgets(STDIN)));
        $confirm = match ($line) {
            'y', '' => true,
            'n' => $this->setTimeZone(),
            default => $this->unknown()
        };

        $confirm;
    }
}
