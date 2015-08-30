<?php
sleep(2);
include '../dbconn.php';

$id = $_POST["id"];
$con->query("UPDATE `restaurant` SET `available`= 1 WHERE id = '$id'");
if($con->error==""){
    echo "ok";
}else{
    echo "error";
}

