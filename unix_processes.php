<?php
declare(strict_types=1);

//echo $user = get_current_user();
//echo posix_getpgrp();
// print_r(posix_getgrgid(posix_getpgrp()));

$ps = shell_exec('ps -aux');
//echo $ps;
$processes_array = explode("\n", $ps);
unset($processes_array[0]);

$process = [];

foreach ($processes_array as $key => $val) {
    if ($val == '') {
        continue;
    }

    $one_process_information = explode(' ', $val);
    asort($one_process_information);

    $func = function () use ($one_process_information) {
        $counter = 0;
            array_map(
                function ($item) use (&$counter) {
                    if ($item == "") {
                        $counter++;
                    }
                },
                $one_process_information
        );
        return $counter;
    };

    $diff_process_information = $func();

    $slice = array_slice($one_process_information, $diff_process_information);

    $process[$slice[1]] =
        [
            'time'  => $slice[0],
            'pid'   => $slice[1],
            'cmd'   => $slice[2],
            'tty'   => $slice[3]
        ];
}

print_r($process);