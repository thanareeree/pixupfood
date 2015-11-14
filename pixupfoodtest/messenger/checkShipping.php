<?php

include '../dbconn.php';
$orderid = $_POST["orderid"];
$shipcode = $_POST["shipcode"];
$orderDetailRes = $con->query("select * from normal_order "
        . "where normal_order.shipping_password = '$shipcode' AND id = '$orderid' ");
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
        . "WHERE normal_order.id = '$orderid' "
        . "GROUP BY normal_order.id "
        . "ORDER BY normal_order.delivery_date , normal_order.id");
$normalOrderData = $normalOrderRes->fetch_assoc();
$qtyOrder = $normalOrderData["qty"];
$date = $normalOrderData["delivery_date"];

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
    $con->query("UPDATE `normal_order` SET `status`= '9', `updated_status_time`= now()  where id = '$orderid' ");
    $con->query("UPDATE `limit_box_daily` SET qty = '$diffQty'  where restaurant_id = '$resid' and daily_date = '$date'");
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
