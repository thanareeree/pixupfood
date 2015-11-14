<?php

include '../../dbconn.php';
session_start();
$cusid = $_SESSION["userdata"]["id"];
$order_id = $_POST["normalno"];


$orderDetailRes = $con->query("select * from normal_order "
        . "where normal_order.order_no = '$order_id' ");
$orderData = $orderDetailRes->fetch_assoc();
$resid = $orderData["restaurant_id"];


$normalOrderRes = $con->query("SELECT normal_order.id as order_id, normal_order.order_time,delivery_date,"
        . " delivery_time, total_nofee,prepay, normal_order.status, normal_order.shippingAddress_id, "
        . "normal_order.customer_id , COUNT(order_detail.id) as foodlist, normal_order.order_no, "
        . "SUM(order_detail.quantity) as qty , customer.firstName, "
        . "customer.lastName, customer.tel, shippingAddress.full_address, order_status.description,"
        . " normal_order.updated_status_time, normal_order.payment_id "
        . "FROM `normal_order` "
        . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
        . "LEFT JOIN order_status ON order_status.id = normal_order.status "
        . "LEFT JOIN shippingAddress ON shippingAddress.id = normal_order.shippingAddress_id "
        . "WHERE normal_order.order_no = '$order_id' "
        . "GROUP BY normal_order.id "
        . "ORDER BY normal_order.delivery_date , normal_order.id");
$normalOrderData = $normalOrderRes->fetch_assoc();
$qtyOrder = $normalOrderData["qty"];
$date = $normalOrderData["delivery_date"];


$limiRes = $con->query("SELECT * FROM `limit_box_daily` WHERE restaurant_id = '$resid' and daily_date = '$date' ");


while ($limitData = $limiRes->fetch_assoc()) {
    $qtyDaily = $limitData["qty"];
    $diffQty = $qtyDaily - $qtyOrder;
}

if (isset($_SESSION["islogin"])) {

    $con->query("UPDATE `normal_order` SET `status`='6',`updated_status_time`= now() WHERE order_no = '$order_id' ");
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

