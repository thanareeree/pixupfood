<?php

session_start();
include '../../../dbconn.php';

$resid = $_SESSION["restdata"]["id"];
$order_id = $_POST["orderid"];
$cmd = $_POST["cmd"];
$response = array(
    "result" => 0,
    "error" => "พังงงงงงงงงง"
);

if (isset($_SESSION["islogin"])) {
    if ($cmd == "accept") {
        $con->query("UPDATE `normal_order` SET `status`='2',`updated_status_time`= now() WHERE id = '$order_id'");
        if ($con->error == "") {
            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "error" => $con->error
            );
        }
    } else if ($cmd == "ignore") {
        $con->query("UPDATE `normal_order` SET `status`='6',`updated_status_time`= now() WHERE id = '$order_id'");
        if ($con->error == "") {
            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "error" => $con->error
            );
        }
    }
}
echo json_encode($response);
