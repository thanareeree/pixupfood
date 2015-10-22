<?php

session_start();
include '../../dbconn.php';

$resid = $_SESSION["restdata"]["id"];
$orderid = $_POST["orderid"];
$messid = $_POST["messselect"];

if (isset($_SESSION["islogin"])) {
    $con->query("UPDATE `fast_order` SET messenger_id = '$messid' WHERE id = '$orderid'");

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
