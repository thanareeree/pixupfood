<?php

date_default_timezone_set("Asia/Bangkok");
include '../../dbconn.php';
include '../../register/thsms.php';
$sms = new thsms();
$sms->username = 'thanaree';
$sms->password = '58c60d';

$res = $con->query("SELECT customer.tel, fast_order.id, fast_order.order_time, fast_order.order_no FROM `fast_order` "
        . "JOIN customer on customer.id = fast_order.customer_id "
        . "WHERE  fast_order.status = 1"
        . " and fast_order.id NOT IN (SELECT fast_id as id FROM fast_sms )");

echo $con->error;
while ($data = $res->fetch_assoc()) {
    $fast_id = $data["id"];
    $ordertime = $data["order_time"];
    $diff = time() - strtotime($ordertime);
    if ($diff > (30)) {
        $con->query("INSERT INTO `fast_sms`(`id`, `fast_id`, `sent_time`) "
                . "VALUES (null,'$fast_id',now())");

        if ($con->error == "") {
             $b = $sms->send('0000', $data["tel"], "หมายเลขคำสั่งซื้อ:" . " " . $data["order_no"]
              . "\nไม่มีร้านตอบรับรายการ"
              . "\nสามารถสั่งซื้ออาหารได้ที่ pixupfood.com");
             
            $con->query("UPDATE `fast_order` SET status = '7', updated_status_time = now() where id = '$fast_id'");
            echo $fast_id . "ส่งล่ะ";
        }
    } else {
        $countRes = $con->query("SELECT COUNT(restaurant_id) as count "
                . "FROM `request_fast_order` WHERE accepted = 9 AND fast_id = '$fast_id' "
                . "and request_fast_order.fast_id NOT IN (SELECT fast_id as fast_id FROM fast_sms ) "
                . "GROUP BY fast_id");
        $countIgnore = $countRes->fetch_assoc();

        $counRestaurant = $con->query("SELECT COUNT(restaurant_id) as count FROM `request_fast_order`"
                . " WHERE fast_id = '$fast_id' "
                . "and request_fast_order.fast_id NOT IN (SELECT fast_id as fast_id FROM fast_sms )");
        $restaurantCount = $counRestaurant->fetch_assoc();

        if ($restaurantCount == $countIgnore) {
            $con->query("INSERT INTO `fast_sms`(`id`, `fast_id`, `sent_time`) "
                    . "VALUES (null,'$fast_id',now())");

            if ($con->error == "") {
                 $b = $sms->send('0000', $data["tel"], "หมายเลขคำสั่งซื้อ:" . " " . $data["order_no"]
                  . "\nไม่มีร้านตอบรับรายการ"
                  . "\nสามารถสั่งซื้ออาหารได้ที่ pixupfood.com");
                 
                $con->query("UPDATE `fast_order` SET status = '7', updated_status_time = now() where id = '$fast_id'");
                echo $fast_id . "ส่งล่ะ แบบปฏิเสธทั้งสามร้าน";
            }
        }
    }
}


