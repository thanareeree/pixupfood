<?php

session_start();
include '../../../dbconn.php';

$resid = $_SESSION["restdata"]["id"];
$order_id = $_POST["orderid"];
$cmd = $_POST["cmd"];
$response = array(
    "result" => 0,
    "error" => "พังงงงงงงงงง"
);

if (isset($_SESSION["islogin"])) {
    if ($cmd == "accept") {
        $con->query("UPDATE `normal_order` SET `status`='2',`updated_status_time`= now() WHERE id = '$order_id'");
        if ($con->error == "") {
            $res = $con->query("SELECT normal_order.shipping_password, customer.tel,"
                    . " normal_order.prepay , SUM(order_detail.quantity) as qty ,"
                    . "normal_order.delivery_date, normal_order.delivery_time, "
                    . "restaurant.name, restaurant.email "
                    . "FROM `normal_order` "
                    . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
                    . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                    . "LEFT JOIN restaurant ON restaurant.id = normal_order.restaurant_id "
                    . "WHERE normal_order.id = '$order_id' "
                    . "GROUP BY order_detail.order_id");
            $data = $res->fetch_assoc();
            include '../../../register/thsms.php';
            $sms = new thsms();
            $sms->username = 'thanaree';
            $sms->password = '58c60d';

            $b = $sms->send('0000', $data["tel"], "\n".$data["shipping_password"]." https://pixupfood.com");
            
            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "error" => $con->error
            );
        }
    } else if ($cmd == "fast") {
        $con->query("UPDATE `normal_order` SET `status`='6',`updated_status_time`= now() WHERE id = '$order_id'");
        if ($con->error == "") {
            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "error" => $con->error
            );
        }
    }
}
echo json_encode($response);
