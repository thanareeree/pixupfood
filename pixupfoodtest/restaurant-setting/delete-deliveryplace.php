<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$delid = $_GET["delid"];



if (isset($_SESSION["islogin"])) {
    $con->query(" DELETE FROM `delivery_place` where id = '$delid'");
    if ($con->error == "") {
        echo json_encode(array(
            "result" => '1'
        ));
    } else {
        echo json_encode(array(
            "result" => '0',
            "error" => $con->error
        ));
    }
}