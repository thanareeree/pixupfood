<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$menu = "";
$orderRes = $con->query("SELECT normal_order.id, order_detail.menu_id, order_detail.quantity ,"
        . " normal_order.delivery_date FROM normal_order "
        . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "WHERE normal_order.status > 1 AND normal_order.status < 6 "
        . "AND normal_order.restaurant_id = '$resid' order by delivery_date");
while ($normalData = $orderRes->fetch_assoc()) {
    $delivery_date = $normalData["delivery_date"];
    $fastOrderRes = $con->query("SELECT * FROM `fast_order` WHERE delivery_date = '$delivery_date'  ");
    while ($fast = $fastOrderRes->fetch_assoc()) {
        
    }
    $menu = $normalData["menu_id"];
}


$limitRes = $con->query("SELECT amount_box_limit, amount_box_minimum  FROM `restaurant` WHERE id ='$resid'");
$limitData = $limitRes->fetch_assoc();
$limit = $limitData["amount_box_limit"];
$minimum = $limitData["amount_box_minimum"];

$limiRes = $con->query("SELECT * FROM `limit_box_daily` WHERE restaurant_id = '$resid'");

$events = array();

$type = $_POST["type"];

if ($type == 'fetch') {
    while ($limitData = $limiRes->fetch_assoc()) {
        $date = $limitData['daily_date'];
        $orderRes = $con->query("SELECT normal_order.id, order_detail.menu_id, order_detail.quantity ,"
                . " normal_order.delivery_date FROM normal_order "
                . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                . "WHERE normal_order.status > 1 AND normal_order.status < 6 "
                . "AND normal_order.restaurant_id = '$resid' and delivery_date = '$date' order by delivery_date");
        while ($normalData = $orderRes->fetch_assoc()) {
            $delivery_date = $normalData["delivery_date"];
            $fastOrderRes = $con->query("SELECT * FROM `fast_order` WHERE delivery_date = '$delivery_date'  ");
            while ($fast = $fastOrderRes->fetch_assoc()) {
                
            }
            $menu = $normalData["menu_id"];
        }
        
        $allQty = $limitData["qty"];
        if ($allQty != 0 & $allQty != "") {
            $e = array();
            $e['title'] = $limitData['qty'] . " " . "ชุด";
            $e['start'] = $limitData['daily_date'];
            $e['status'] = 1;
            $e['menu'] = $menu;
            array_push($events, $e);
        }
    }
    echo json_encode($events);
} 