<?php
include '../../dbconn.php';
$cusid = $_POST["cusid"];
$resid = $_POST["resid"];
$orderDetailRes = $con->query("SELECT `id`, `quantity`, `price`, `set_type`, "
        . "`menu_id`, `created_time`, `status`,  `customer_id`,"
        . " `restaurant_id`"
        . " FROM `order_detail` "
        . "WHERE customer_id = '$cusid' and restaurant_id ='$resid' ");

if ($orderDetailRes->num_rows == 0) {
    $response = array(
        "result" => 0
    );
}  else {
    $response = array(
        "result" => 1
    );
}

echo json_encode($response);
