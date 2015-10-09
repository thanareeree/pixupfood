<?php

include '../dbconn.php';
$resid = $_POST["resid"];
$dataOrder = $con->query("select order_time, amount "
        . "from order "
        . "left join restaurant on restaurant.id = order.restaurant_id");

if ($dataOrder->num_rows >= 1) {
    while ($data = $dataOrder->fetch_assoc()) {
        $amount .= $data["amount"]; 
        
        echo json_encode(array(
        "title" => $amount ,
        "start" => substr($data["order_time"], 10)
        ));
    }
} else {
    $booked[] = array();
}

echo json_encode($booked);
