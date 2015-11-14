<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$newid = $_GET["newid"];



if (isset($_SESSION["islogin"])) {
    $con->query(" DELETE FROM `news` where id = '$newid'");
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