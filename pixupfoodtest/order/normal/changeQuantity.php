<?php

session_start();

include '../../dbconn.php';
$orderDetailId = $_POST["id"];
$newqty = @$_POST["newqty"];



if (isset($_SESSION["islogin"])) {
    $con->query("UPDATE `order_detail` SET `quantity`='$newqty' WHERE id = '$orderDetailId'");
    
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