<?php

include '../dbconn.php';
$orderid = $_POST["orderid"];
$shipcode = $_POST["shipcode"];
$orderDetailRes = $con->query("select * from fast_order "
        . "where fast_order.shipping_password = '$shipcode' AND id = '$orderid' ");

if ($orderDetailRes->num_rows == 0) {

    $response = array(
        "result" => 0,
         "error" => "รหัสยืนยันผิด"
    );
} else {
    $con->query("UPDATE `fast_order` SET `status`= '9',`updated_status_time`= now()  where id = '$orderid' ");
    if ($con->error == "") {
        $response = array(
            "result" => 1
        );
    } else {
        $response = array(
            "result" => 0,
            "error" => "อัพเดตข้อมูลไม่ได้"
        );
    }
}

echo json_encode($response);
