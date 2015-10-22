<?php

session_start();

include '../../dbconn.php';
$order_id = $_POST["id"];
$resid = $_SESSION["restdata"]["id"];
$statusid = (int) $_POST["statusid"];
$orderRes = $con->query("SELECT * FROM `normal_order`  WHERE id ='$order_id'");
$orderData = $orderRes->fetch_assoc();
$payid = $orderData["payment_id"];

if (isset($_SESSION["islogin"])) {

    if ($statusid == 3) {
        $checkRes = $con->query("SELECT * FROM `transfer` WHERE type = 'n1' and order_id = '$order_id'");
        if ($checkRes->num_rows == 0) {
            echo json_encode(array(
                "result" => 2,
                "error" => "ลูกค้ายังไม่ได้แจ้งหลักฐานโอนเงินค่ามัดจำมาที่ระบบ กรุณาตรวจสอบข้อมูลก่อนเปลี่ยนแปลงสถานะ"
            ));
        } else {
            $con->query("UPDATE `normal_order` SET `status`='$statusid',`updated_status_time`= now() WHERE id = '$order_id'");

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
    } else if ($statusid == 5 && $payid == 2) {
        $checkRes = $con->query("SELECT * FROM `transfer` WHERE type = 'n2' and order_id = '$order_id'");

        if ($checkRes->num_rows == 0) {
            echo json_encode(array(
                "result" => 2,
                "error" => "ลูกค้ายังไม่ได้แจ้งหลักฐานโอนเงินในส่วนที่เหลือมามาที่ระบบ กรุณาตรวจสอบข้อมูลก่อนเปลี่ยนแปลงสถานะ"
            ));
        } else {
            $con->query("UPDATE `normal_order` SET `status`='$statusid',`updated_status_time`= now() WHERE id = '$order_id'");

            if ($con->error == "") {
                echo json_encode(array(
                    "result" => 0,
                    "orderid" => $order_id
                ));
            } else {
                echo json_encode(array(
                    "result" => 2,
                    "error" => $con->error
                ));
            }
        }
    } else {
        $con->query("UPDATE `normal_order` SET `status`='$statusid',`updated_status_time`= now() WHERE id = '$order_id'");

        if ($con->error == "") {

            if ($statusid == 5) {
                echo json_encode(array(
                    "result" => 0,
                    "orderid" => $order_id
                ));
            } else {
                echo json_encode(array(
                    "result" => 1,
                ));
            }
        } else {
            echo json_encode(array(
                "result" => 2,
                "error" => $con->error
            ));
        }
    }
}