<?php

session_start();
include '../../../dbconn.php';

$resid = $_SESSION["restdata"]["id"];
$order_id = @$_POST["orderid"];
$ignoreNormalId = @$_POST["ignoreNormalId"];
$cmd = $_POST["cmd"];
$response = array(
    "result" => 0,
    "error" => "พังงงงงงงงงง"
);

if (isset($_SESSION["islogin"])) {
    if ($cmd == "accept") {
        $con->query("UPDATE `normal_order` SET `status`='2',`updated_status_time`= now() WHERE id = '$order_id'");
        if ($con->error == "") {
            $res = $con->query("SELECT normal_order.shipping_password, customer.tel,normal_order.id,"
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
            
            $delidate = $data["delivery_date"];
            $qty = $data["qty"];
            $checkDailyDateRes = $con->query("SELECT * FROM `limit_box_daily` WHERE daily_date = '$delidate' and restaurant_id = '$resid' ");
            if ($checkDailyDateRes->num_rows == 0) {
                $con->query("INSERT INTO `limit_box_daily`(`id`, `qty`, `daily_date`, `restaurant_id`) "
                        . "VALUES (null,'$qty','$delidate','$resid')");
            } else {
                $dailyData = $checkDailyDateRes->fetch_assoc();
                $qtyDaily = $dailyData["qty"];
                $addQty = $qtyDaily + $qty;
                $con->query("UPDATE `limit_box_daily` SET `qty`= '$addQty' WHERE restaurant_id = '$resid' AND daily_date = '$delidate'");
            }
           include '../../../register/thsms.php';
            $sms = new thsms();
            $sms->username = 'thanaree';
            $sms->password = '58c60d';

            $b = $sms->send('0000', $data["tel"], "ร้านอาหาร:" . $data["name"]
                    . "\nตอบรับรายการสั่งซื้อเลขที่: " . 'N' . sprintf("%07d", $data["id"])
                    . "\nแล้ว Shipping Code:" . $data["shipping_password"]
                    . "\nสามารถเช็คสถานะได้ที่ pixupfood.com");

            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "error" => $con->error
            );
        }
    } else if ($cmd == "ignore") {
        $con->query("UPDATE `normal_order` SET `status`='7',`updated_status_time`= now() WHERE id = '$ignoreNormalId'");
        if ($con->error == "") {

            $res = $con->query("SELECT normal_order.shipping_password, customer.tel, normal_order.id,"
                    . " normal_order.prepay , SUM(order_detail.quantity) as qty ,"
                    . "normal_order.delivery_date, normal_order.delivery_time, "
                    . "restaurant.name, restaurant.email "
                    . "FROM `normal_order` "
                    . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
                    . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                    . "LEFT JOIN restaurant ON restaurant.id = normal_order.restaurant_id "
                    . "WHERE normal_order.id = '$ignoreNormalId' "
                    . "GROUP BY order_detail.order_id");
            $data = $res->fetch_assoc();
            include '../../../register/thsms.php';
            $sms = new thsms();
            $sms->username = 'thanaree';
            $sms->password = '58c60d';

            $b = $sms->send('0000', $data["tel"], "หมายเลขคำสั่งซื้อ: " . 'N' . sprintf("%07d", $data["id"])
                    . " \nถูกปฏิเสธรายการจากร้าน" . $data["name"]
                    . " \nสามารถสั่งซื้ออาหารได้ที่ pixupfood.com");


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
