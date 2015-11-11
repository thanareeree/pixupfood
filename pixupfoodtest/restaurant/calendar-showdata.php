<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];


$orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, delivery_date, status "
        . "FROM normal_order "
        . "WHERE status < 6  AND status > 1 AND restaurant_id = '$resid'"
        . " UNION "
        . "select concat('F') as orderType, id, delivery_date, status "
        . "FROM fast_order "
        . "WHERE status < 6  AND status > 1  AND restaurant_id = '$resid' "
        . "ORDER BY delivery_date , id");


while ($orderIdAllData = $orderNowAllRes->fetch_assoc()) {
    $order_type = $orderIdAllData["orderType"];
    $orderIdAll = $orderIdAllData["id"];


    if ($order_type == 'F') {
        $fastOrderRes = $con->query(" ");
        while ($fastOrderData = $fastOrderRes->fetch_assoc()) {
            ?>

            <?php

        }
    } else {
        $normalOrderRes = $con->query("");

        while ($normalOrderData = $normalOrderRes->fetch_assoc()) {
            ?>

            <?php

        }
    }
}

