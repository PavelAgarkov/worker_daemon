<?php

namespace src\app;

use src\app\custom_application_classes\Example;
use src\Process;

class Application
{
    public function __construct()
    {
    }

    /**
     * Метод реализующий пользовательское приложение
     */
    public function handler(): void
    {
        Example::date();
    }

    /**
     * @param int $number
     * @return bool
     * Метод реалзующий логику выхода из daemon режима
     */
    public function exitCondition(int $number): bool
    {
        while ($number < 3) {
            $number++;
            if ($number == 2) {
                return true;
            }
        }
        return false;
    }
}