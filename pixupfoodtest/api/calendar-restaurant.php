<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$limit = $_SESSION["restdata"]["amount_box_limit"];
$type = $_POST["type"];

$events = array();



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

        $dataOrder = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date,"
                . "fast_order.delivery_time, order_status.description, order_status.id, fast_order.order_no, "
                . "fast_order.shippingAddress_id,fast_order.customer_id ,quantity as qty , shippingAddress.full_address, "
                . "customer.firstName, customer.lastName , fast_order.main_menu_id,  order_status.description,"
                . "request_fast_order.priority, fast_order.order_time,customer.tel, messenger.name as mesname, "
                . "restaurant.name, fast_order.updated_status_time, fast_order.status, fast_order.payment_id "
                . "FROM `fast_order`"
                . "LEFT JOIN order_status ON order_status.id = fast_order.status "
                . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
                . "LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
                . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
                . "LEFT JOIN shippingAddress ON shippingAddress.id = fast_order.shippingAddress_id "
                . "LEFT JOIN messenger ON messenger.id = fast_order.messenger_id "
                . "WHERE fast_order.id = '$orderIdAll' and request_fast_order.accepted = 1 ");

        if ($type == 'fetch') {
            while ($data = $dataOrder->fetch_assoc()) {

                $e = array();
                $e['title'] = $data['qty'] . " ชุด ส่ง" . $data['delivery_time'];
                $e['start'] = $data['delivery_date'];
                $e['id'] = $data["order_no"];
                $e['full_address'] = $data["full_address"];
                $e['name'] = $data["mesname"];
                $e['time'] = date("d-m-Y", strtotime($data['delivery_date'])) . " " . $data['delivery_time'];
                $e['description'] = $data["description"];
                array_push($events, $e);
            }
        }
    } else {

        $dataOrder = $con->query("SELECT normal_order.id as order_id, normal_order.order_time,delivery_date,"
                . " delivery_time, total_nofee,prepay, normal_order.status, normal_order.shippingAddress_id, "
                . "normal_order.customer_id , COUNT(order_detail.id) as foodlist, normal_order.order_no, "
                . "SUM(order_detail.quantity) as qty , customer.firstName, "
                . "customer.lastName, customer.tel, shippingAddress.full_address, order_status.description,"
                . " normal_order.updated_status_time, normal_order.payment_id, messenger.name "
                . "FROM `normal_order` "
                . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
                . "LEFT JOIN order_status ON order_status.id = normal_order.status "
                . "LEFT JOIN shippingAddress ON shippingAddress.id = normal_order.shippingAddress_id "
                . "LEFT JOIN messenger ON messenger.id = normal_order.messenger_id "
                . "WHERE normal_order.id = '$orderIdAll' "
                . "GROUP BY normal_order.id "
                . "ORDER BY normal_order.delivery_date , normal_order.id");

        if ($type == 'fetch') {
            while ($data = $dataOrder->fetch_assoc()) {
                $e = array();
                $e['title'] = $data['qty'] . " ชุด ส่ง" . $data['delivery_time'];
                $e['start'] = $data['delivery_date'];
                $e['id'] = $data["order_no"];
                $e['full_address'] = $data["full_address"];
                $e['name'] = $data["name"];
                $e['time'] = date("d-m-Y", strtotime($data['delivery_date'])) . " " . $data['delivery_time'];
                $e['description'] = $data["description"];
                array_push($events, $e);
            }
        }
    }
}
echo json_encode($events);
