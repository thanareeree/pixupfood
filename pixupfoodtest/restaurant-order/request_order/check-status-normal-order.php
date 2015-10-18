<?php
date_default_timezone_set("Asia/Bangkok");
include '../../dbconn.php';
include '../../register/thsms.php';
$sms = new thsms();
$sms->username = 'thanaree';
$sms->password = '58c60d';

$res = $con->query("SELECT customer.tel, normal_order.id, normal_order.order_time FROM `normal_order` "
        . "JOIN customer on customer.id = normal_order.customer_id "
        . "WHERE  normal_order.status = 1"
        . " and normal_order.id NOT IN (SELECT normal_id as id FROM normal_sms )");


while ($data = $res->fetch_assoc()) {
    $normal_id = $data["id"];
    $ordertime = $data["order_time"];
    $diff = time() - strtotime($ordertime);
    if ($diff > (60 * 60 * 24)) {
        $con->query("INSERT INTO `normal_sms`(`id`, `normal_id`, `sent_time`) "
                . "VALUES (null,'$normal_id',now())");

        if ($con->error == "") {
             /*$b = $sms->send('0000', $data["tel"], "เลขที่รายการ:" . " " . $normal_id
              . "\nไม่มีร้านตอบรับรายการ"
              . "\nสามารถสั่งซื้ออาหารได้ที่ www.pixupfood.com"); */
              $con->query("UPDATE `normal_order` SET status = '7' where id = '$normal_id'");  
            echo $normal_id."ส่งล่ะ";
        }
        echo $con->error;
    }
}


