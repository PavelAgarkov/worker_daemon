<?php

require __DIR__ . '/vendor/autoload.php';

declare(ticks=1);

use src\Daemon;

$daemon = new Daemon();
$daemon->start();