<?php

include '../dbconn.php';
$resid = $_POST["resid"];
$dataOrder = $con->query("SELECT delivery_date, SUM(order_detail.quantity) as qty, order_time,delivery_time "
        . "FROM `normal_order` "
        . "JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "WHERE normal_order.restaurant_id = '$resid' AND normal_order.status > 1 AND normal_order.status < 6    "
        . "GROUP BY normal_order.delivery_date");


$limitRes = $con->query("SELECT amount_box_limit, amount_box_minimum  FROM `restaurant` WHERE id ='$resid'");
$limitData = $limitRes->fetch_assoc();
$limit = $limitData["amount_box_limit"];
$minimum = $limitData["amount_box_minimum"];

$limiRes = $con->query("SELECT * FROM `limit_box_daily` WHERE restaurant_id = '$resid'");

$events = array();

$type = $_POST["type"];

if ($type == 'fetch') {
    while ($limitData = $limiRes->fetch_assoc()) {
        $allQty = $limitData["qty"];
        if ($allQty >= ($limit - $minimum) && $limit !== null) {
            $e = array();
            $e['title'] = "เต็ม";
            $e['start'] = $limitData['daily_date'];
            $e['status'] = 0;
            array_push($events, $e);
        } else if($allQty != 0 & $allQty != ""){
            $e = array();
            $e['title'] = $limitData['qty'] . " " . "ชุด";
            $e['start'] = $limitData['daily_date'];
            $e['status'] = 1;
            array_push($events, $e);
        }
    }
    echo json_encode($events);
} 