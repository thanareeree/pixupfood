<?php

include '../../dbconn.php';
session_start();
$cusid = $_SESSION["userdata"]["id"];
$order_id = $_POST["fastno"];


$orderDetailRes = $con->query("select * from fast_order "
        . "where fast_order.order_no = '$order_id'  ");

$orderData = $orderDetailRes->fetch_assoc();
$qtyOrder = $orderData["quantity"];
$resid = $orderData["restaurant_id"];
$date = $orderData["delivery_date"];

$limiRes = $con->query("SELECT * FROM `limit_box_daily` WHERE restaurant_id = '$resid' and daily_date = '$date' ");


while ($limitData = $limiRes->fetch_assoc()) {
    $qtyDaily = $limitData["qty"];
    $diffQty = $qtyDaily - $qtyOrder;
}

if (isset($_SESSION["islogin"])) {

    $con->query("UPDATE `fast_order` SET `status`='6',`updated_status_time`= now() WHERE order_no = '$order_id' ");
    if ($limiRes->num_rows > 0) {
        $con->query("UPDATE `limit_box_daily` SET qty = '$diffQty'  where restaurant_id = '$resid' and daily_date = '$date'");
    }
    if ($con->error == "") {
        $response = array(
            "result" => 1
        );
    } else {
        $response = array(
            "result" => 0,
            "error" => "อัพเดตข้อมูลไม่ได้" . $con->error
        );
    }
}echo json_encode($response);

