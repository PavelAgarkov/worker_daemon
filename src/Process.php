<?php

namespace src;

class Process
{
    private int $PID;

    public function __construct($pid = null)
    {
        if ($pid !== null) {
            $this->PID = $pid;
        }
    }

    public function getPid(): int
    {
        return $this->PID;
    }

    public function fork(): void
    {
        $this->PID = pcntl_fork();
    }

    public function kill(int $pid, string $signature): void
    {
        posix_kill($pid, $signature);
    }
}