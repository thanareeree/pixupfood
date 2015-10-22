<?php
session_start();

include '../../dbconn.php';
$orderDetailId = $_POST["id"];

if (isset($_SESSION["islogin"])) {
    $con->query("DELETE FROM `order_detail` WHERE id = '$orderDetailId'");
    
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