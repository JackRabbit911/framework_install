<?php

class SetTimeZone
{
    use InputTrait;

    public function __invoke()
    {
        $timezone = date_default_timezone_get();
        return $this->propmpt('Enter Your time zone:', $timezone);
    }
}
