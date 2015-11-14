<?php

session_start();
include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$resid = @$_POST["resid"];
$delivery_date = @$_POST["date"];
$date = date("Y-m-d", strtotime(str_replace(" GMT+0700 (SE Asia Standard Time)", "", $delivery_date)));

$limitRes = $con->query("SELECT amount_box_limit, amount_box_minimum  FROM `restaurant` WHERE id ='$resid'");
$limitData = $limitRes->fetch_assoc();
$limit = $limitData["amount_box_limit"];
$minimum = $limitData["amount_box_minimum"];

$orderDetailRes = $con->query("SELECT SUM(order_detail.quantity) as allqty "
        . "FROM `order_detail` WHERE customer_id = '$cusid' and restaurant_id ='$resid' and status = '0'");
$orderDetailData = $orderDetailRes->fetch_assoc();
$orderAllQty = $orderDetailData["allqty"];

$limitQty = ($limit - $minimum);
$limiRes = $con->query("SELECT * FROM `limit_box_daily` WHERE restaurant_id = '$resid' and daily_date = '$date'");



if ($limiRes->num_rows > 0) {
    $limitData = $limiRes->fetch_assoc();
    $qtyDaily = $limitData["qty"];
    if ($qtyDaily >= $limitQty) {
        echo json_encode(array(
            "result" => 3,
            "error" => "วันที่" . date("d-m-Y", strtotime($date)) . " " . "ทางร้านไม่สามารถรับรายการสั่งซื้อได้แล้ว"
        ));
    } else if (($qtyDaily + $orderAllQty) > $limit) {
        echo json_encode(array(
            "result" => 3,
            "error" => "วันที่" . date("d-m-Y", strtotime($date)) . " " . "ร้านสามารถรับรายการได้อีกไม่เกิน" . " " . ($limit - $qtyDaily) . " " . "ชุดเท่านั้น"
        ));
    } else{

        echo json_encode(array(
            "result" => 1
        ));
    }
} else {
    if ($orderAllQty > $limit) {
        echo json_encode(array(
            "result" => 3,
            "error" => "จำนวนชุดอาหารของท่านมากเกินที่ร้านสามารถรับรายการได้"
        ));
    } else {

        echo json_encode(array(
            "result" => 1
        ));
    }
}
