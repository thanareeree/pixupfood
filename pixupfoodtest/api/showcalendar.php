<?php

include '../dbconn.php';
$resid = $_GET[""];
$dataOrder = $con->query("SELECT delivery_date, SUM(order_detail.quantity) as qty, order_time "
        . "FROM `normal_order` "
        . "JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "WHERE normal_order.restaurant_id = '$resid' "
        . "and normal_order.status != '6' "
        . "GROUP BY normal_order.delivery_date");

$limitRes = $con->query("SELECT amount_box_limit FROM `restaurant` WHERE id ='33'");
$limitData = $limitRes->fetassoc();
$limit = $limitData["amount_box_limit"];


if ($_GET['gData']) {
    while ($data = $dataOrder->fetch_assoc()) {
        $allQty = $data["qty"];

        $json_data[] = array(
            "title" => "เต็ม",
            "start" => $data["order_time"]
        );
    }
}else{
    while ($data = $dataOrder->fetch_assoc()) {
        $allQty = $data["qty"];

        $json_data[] = array(
            "title" => "เต็ม",
            "start" => $data["order_time"]
        );
    }
}

$json = json_encode($json_data);
if (isset($_GET['callback']) && $_GET['callback'] != "") {
    echo $_GET['callback'] . "(" . $json . ");";
} else {
    echo $json;
}    

/*  echo json_encode(array(
                "title" => $limit - $allQty,
                "start" => $data["order_time"]
            )); */