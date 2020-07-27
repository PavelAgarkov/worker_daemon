<?php

namespace src;

use src\Daemon;

class SignalHandler
{
    private int $numberOfLaunches = 3;

    public function __construct()
    {
//        pcntl_signal(SIGTERM, "sig_handler");
        pcntl_signal(SIGHUP, [$this, 'restart']);
//        pcntl_signal(SIGINT,  "sig_handler");
//        pcntl_signal(SIGUSR1, "sig_handler");
    }

    public function restart()
    {
        while ($this->numberOfLaunches != 0) {
            (new Daemon())->start();
        }

    }

}