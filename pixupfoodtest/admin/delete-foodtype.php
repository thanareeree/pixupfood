<?php

include '../dbconn.php';

$id = $_POST["id"];
$con->query("DELETE FROM food_type WHERE id = '$id'");
if($con->error==""){
    echo "ok";
}else{
    echo "error";
}

