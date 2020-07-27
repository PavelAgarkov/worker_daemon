<?php

namespace src;

use src\Process;

class ProcessPool
{
    private array $pool;

    private int $numberOfOpenProcesses;

    public function __construct()
    {
        $this->numberOfOpenProcesses = 0;
    }

    public function appendToPool(Process $process): int
    {
        $this->pool[] = $process;
        $this->numberOfOpenProcesses++;
        return $this->numberOfOpenProcesses;
    }

    public function deleteFromPool(Process $process): int
    {

    }

    public function findProcessInPool(int $pid): Process
    {

    }

}