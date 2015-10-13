<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$limit = $_SESSION["restdata"]["amount_box_limit"];

$dataOrder = $con->query("SELECT delivery_date, SUM(order_detail.quantity) as qty,"
        . "order_time, normal_order.delivery_time "
        . "FROM `normal_order` "
        . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "WHERE normal_order.restaurant_id = '$resid' AND normal_order.status != 1 AND normal_order.status != 6  " 
        . "GROUP BY order_detail.order_id "
        . "ORDER BY normal_order.delivery_date ASC,normal_order.delivery_time ASC");



$events = array();

$type = $_POST["type"];

if ($type == 'fetch') {
    while ($data = $dataOrder->fetch_assoc()) {
        $e = array();
        $e['title'] = $data['qty']." ชุด ส่งเวลา"." ".$data['delivery_time']." น.";
        $e['start'] = $data['delivery_date'];
        array_push($events, $e);
    }
      echo json_encode($events);
} 