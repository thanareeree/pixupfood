<?php

include '../dbconn.php';

$name = $_GET["searchname"];

$resid = $_GET["restaurant"];

echo $name."\n".$resid;