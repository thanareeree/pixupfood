<?php

include '../dbconn.php';

$name = $_POST["name"];
$con->query("UPDATE `restaurant` SET `available`= 1 WHERE name = '$name'");
if($con->error==""){
    echo "ok";
}else{
    echo $con->error;
}

