<?php

namespace src;

use src\Daemon;

class SignalHandler
{
    private Daemon $daemon;

    private int $numberOfLaunches = 5;

    public function __construct(Daemon $daemon)
    {
        $this->daemon = $daemon;

//        pcntl_signal(SIGTERM, "sig_handler");
        pcntl_signal(SIGHUP, [$this, 'restart']);
//        pcntl_signal(SIGINT,  "sig_handler");
//        pcntl_signal(SIGUSR1, "sig_handler");
    }

    /**
     * Метод позволяет запустить демона заново
     */
    public function restart()
    {
        (new Daemon())->start();
    }
}