<?php

namespace src;

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
            die('Не удалось породить дочерний процесс');
        } else if ($forkProcessPid) {
            //тут убит родительский процесс
            exit(PHP_EOL . 'parent die');
        } else {

            posix_setsid();
            //текущий процесс - является дочерним в данном блоке, родительский убит
            $childrenProcess = new Process(posix_getpid());

            //обработчик сигналов linux
            $signalHandler = new SignalHandler();

            // пул процессов для создания многопроцессорного демона
            $processPool = new ProcessPool();

            $a = 0;
            while ($this->enable) {

                //логика приложения
                sleep(1);
                echo date("H:i:s") . PHP_EOL;

                //условия выхода из Daemon
                if ($a == 2) {
                    $childrenProcess->kill($childrenProcess->getPid(), SIGHUP);
                    $this->enable = false;
                }
                $a++;
            }
        }
    }
}