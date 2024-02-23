<?php

trait InputTrait
{
    protected function confirm($string)
    {
        echo "$string (Y/n) ";
        $input = strtolower(trim(fgets(STDIN)));

        $confirm = match ($input) {
            'y', '' => true,
            'n' => false,
            default => $this->confirm($string)
        };

        return $confirm;
    }

    protected function prompt($string, $default = '')
    {
        echo "$string [$default] ";
        $input = trim(fgets(STDIN));
        $input = trim($input, "\x22\x20\x27\x2F");

        if (empty($input)) {
            $input = $default;
        }

        return $input;
    }
}
