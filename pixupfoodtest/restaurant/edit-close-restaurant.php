<?php

session_start();
include '../dbconn.php';
$id = $_SESSION["restdata"]["id"];

$closestatus = @$_POST["close"];

if ($closestatus == 0) {
    $con->query("UPDATE restaurant SET close = 1 where id = '$id'");
    if ($con->error == "") {
        echo json_encode(array(
            "result" => 1
        ));
    } else {
        echo json_encode(array(
            "result" => 2,
            "error" => $con->error
        ));
    }
} else if($closestatus == 1){
    $con->query("UPDATE restaurant SET close = 0 where id = '$id'");
    if ($con->error == "") {
        echo json_encode(array(
            "result" => 0
        ));
    } else {
        echo json_encode(array(
            "result" => 2,
            "error" => $con->error
        ));
    }
}
