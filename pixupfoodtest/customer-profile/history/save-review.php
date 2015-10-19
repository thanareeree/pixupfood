<?php

session_start();
include '../../dbconn.php';

$cusid = $_SESSION["userdata"]["id"];
$resid = @$_POST["resid"];
$star = @$_POST["score"];
$detail = @$_POST["detail"];
$score = "";
if ($star == "") {
    $score = "0";
} else {
    $score = $star;
}

if (isset($_SESSION["islogin"])) {
    $con->query("INSERT INTO `comment`(`id`, `restaurant_id`, `customer_id`, `detail`, `score`, `updated_time`)"
            . " VALUES (null,'$resid','$cusid','$detail','$score',now())");
    
    if ($con->error == "") {
        echo json_encode(array(
            "result" => 1,
        ));
    } else {
        echo json_encode(array(
            "result" => 2,
            "error" => $con->error 
        ));
    }
}
    