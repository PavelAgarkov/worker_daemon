<?php

print_r(posix_uname());

$pid = pcntl_fork();

if ($pid == -1) {
    die('Не удалось породить дочерний процесс');
} else if ($pid) {
    echo 'parent';
    exit();
} else {
    echo 'child';
    exit();
}