<?php

class CheckArgument
{
    public function __invoke($argv)
    {
        array_shift($argv);
        $arg = $argv[0] ?? '-i';

        $handler = match ($arg) {
            '-f' => new Scenario(),
            '-i' => new Interactive(),
            default => new Scenario($arg),
        };

        return $handler;
    }
}
