<?php

$date = '2014-06-06 12:24:48';
echo date('d-m-Y (H:i:s)', strtotime($date));

 $digits = 6;
        $otppwd = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        echo $otppwd;