<?php

include '../dbconn.php';
$orderid = @$_POST["orderid"];
$shipcode = @$_POST["shipcode"];
$orderDetailRes = $con->query("select * from fast_order "
        . "where fast_order.shipping_password = '$shipcode' AND id = '$orderid' ");

$orderData = $orderDetailRes->fetch_assoc();
$qtyOrder = $orderData["quantity"];
$resid = $orderData["restaurant_id"];
$date = $orderData["delivery_date"];

$limiRes = $con->query("SELECT * FROM `limit_box_daily` WHERE restaurant_id = '$resid' and daily_date = '$date' ");
$limitData = $limiRes->fetch_assoc();
$qtyDaily = $limitData["qty"];

$diffQty = $qtyDaily - $qtyOrder;


if ($orderDetailRes->num_rows == 0) {

    $response = array(
        "result" => 0,
        "error" => "รหัสยืนยันผิด"
    );
} else {
    $con->query("UPDATE `fast_order` SET `status`= '9',`updated_status_time`= now()  where id = '$orderid' ");
     $con->query("UPDATE `limit_box_daily` SET qty = '$diffQty'  where restaurant_id = '$resid' and daily_date = '$date'");
    if ($con->error == "") {
        $response = array(
            "result" => 1
        );
    } else {
        $response = array(
            "result" => 0,
            "error" => "อัพเดตข้อมูลไม่ได้".$con->error
        );
    }
}

echo json_encode($response);
