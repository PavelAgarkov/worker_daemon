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
     * @param Process $childrenProcess
     * @param int $number
     * @return bool
     * Метод реалзующий логику выхода из daemon режима
     */
    public function exitCondition(Process $childrenProcess, int $number): bool
    {
        while ($number != 5) {
            $number++;
            if ($number == 2) {
                $childrenProcess->kill($childrenProcess->getPid(), SIGHUP);
            }
        }
        return true;
    }
}