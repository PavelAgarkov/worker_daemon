<?php

namespace src\app\custom_application_classes;

class Example
{
    public static function date(): void
    {
        sleep(1);
        echo date("H:i:s") . PHP_EOL;
    }
}