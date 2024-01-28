<?php

class SetTimeZone
{
    public function __invoke()
    {
        $timezone = date_default_timezone_get();
        echo "Your time zone: '$timezone' Y/n? ";
        return $this->prompt($timezone);
    }

    private function setTimeZone()
    {
        echo 'Enter Your time zone: ';
        $timezone = trim(fgets(STDIN));
        $timezone = trim($timezone, "\x22\x20\x27");
        echo "Ok, Your time zone is: '$timezone'" . PHP_EOL;
        return $timezone;
    }

    private function unknown($timezone)
    {
        echo 'Your answer not recognized. Please enter "Y", "y" or "n" ';
        return $this->prompt($timezone);
    }

    private function prompt($timezone)
    {
        $line = strtolower(trim(fgets(STDIN)));
        $confirm = match ($line) {
            'y', '' => $timezone,
            'n' => $this->setTimeZone(),
            default => $this->unknown($timezone)
        };

        return $confirm;
    }
}
