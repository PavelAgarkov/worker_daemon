<?php

namespace src;

use src\app\Application;
use src\Process;
use src\ProcessPool;
use src\SignalHandler;

class Daemon
{
    private bool $enable = true;

    private Process $forkProcess;

    public function __construct()
    {
        $this->forkProcess = new Process();
        $this->forkProcess->fork();
    }

    public function start()
    {
        $forkProcessPid = $this->forkProcess->getPid();

        if ($forkProcessPid == -1) {
            exit('Не удалось породить дочерний процесс');

        } else if ($forkProcessPid) {
            //тут убит родительский процесс
            exit(PHP_EOL . 'parent die');

        } else {

            //назначить текущий процесс главным в сессии
            posix_setsid();

            //текущий процесс - является дочерним в данном блоке, родительский убит
            $childrenProcess = new Process(posix_getpid());

            //обработчик сигналов linux
            $signalHandler = new SignalHandler();

            // пул процессов для создания многопроцессного демона
            $processPool = new ProcessPool();

            //инициализация пользовательского приложения
            $app = new Application();

            // основной цикл (daemon)
            while ($this->enable) {

                //логика приложения
                $app->handler();

                //условия выхода из daemon
                if ($app->exitCondition($childrenProcess, 0)) {
                    $this->enable = false;
                }
            }
        }
    }
}