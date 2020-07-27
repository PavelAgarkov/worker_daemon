<?php

require __DIR__ . '/vendor/autoload.php';

declare(ticks=1);

use src\Daemon;

(new Daemon())->start();