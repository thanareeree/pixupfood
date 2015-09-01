<?php
include '../dbconn.php';

$id = $_POST["id"];
$con->query("DELETE FROM customer WHERE id = '$id'");
if($con->error==""){
    echo "ok";
}else{
    echo "error";
}
