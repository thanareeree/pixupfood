<?php

session_start();
include '../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];

$favid = $_GET["favid"];

if (isset($_SESSION["islogin"])) {
    $con->query("DELETE FROM `favorite_menu` WHERE id = '$favid'");
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