<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$messid = $_GET["messid"];



if (isset($_SESSION["islogin"])) {
    $con->query(" DELETE FROM `messenger` where id = '$messid'");
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