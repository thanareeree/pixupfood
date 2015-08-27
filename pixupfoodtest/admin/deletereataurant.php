<?php
sleep(2);
include '../dbconn.php';

$id = $_POST["id"];
$con->query("DELETE FROM restaurant WHERE id = '$id'");
if($con->error==""){
    echo "ok";
}else{
    echo "error";
}

