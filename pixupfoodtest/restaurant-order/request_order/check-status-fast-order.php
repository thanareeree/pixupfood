<?php
date_default_timezone_set("Asia/Bangkok");
include '../../dbconn.php';
include '../../register/thsms.php';
$sms = new thsms();
$sms->username = 'thanaree';
$sms->password = '58c60d';

$res = $con->query("SELECT customer.tel, fast_order.id, fast_order.order_time FROM `fast_order` "
        . "JOIN customer on customer.id = fast_order.customer_id "
        . "WHERE  fast_order.status = 1"
        . " and fast_order.id NOT IN (SELECT fast_id as id FROM fast_sms )");

echo $con->error;
while ($data = $res->fetch_assoc()) {
    $fast_id = $data["id"];
    $ordertime = $data["order_time"];
    $diff = time() - strtotime($ordertime);
    if ($diff > (60 * 15)) {
        $con->query("INSERT INTO `fast_sms`(`id`, `fast_id`, `sent_time`) "
                . "VALUES (null,'$fast_id',now())");

        if ($con->error == "") {
             $b = $sms->send('0000', $data["tel"], "เลขที่รายการ(สั่งด่วน):" . " " . $data["id"]
              . "ไม่มีร้านตอบรับรายการ"
              . "สามารถสั่งซื้ออาหารได้ที่ www.pixupfood.com"); 
            //echo $fast_id."ส่งล่ะ";
        }
        echo $con->error;
    }
}


