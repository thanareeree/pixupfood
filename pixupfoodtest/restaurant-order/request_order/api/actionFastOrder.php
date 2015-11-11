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

        $orderDetailRes = $con->query("SELECT * FROM `request_fast_order` WHERE request_fast_order.fast_id = '$order_id' and restaurant_id = '$resid'");
        $orderDetailData = $orderDetailRes->fetch_assoc();
        $coin = round($orderDetailData["total"] / 500);
        $prepay = $orderDetailData["prepay"];

        $promoRes = $con->query("select * from promotion LEFT JOIN promotion_main ON promotion_main.id = promotion.promotion_main_id "
                . "where restaurant_id = '$resid' and end_time >= date(now()) "
                . "and start_time <= date(now()) "
                . "and promotion_main.id = 1");



        $orderupdate = $con->query("UPDATE `request_fast_order` SET accepted = 1 WHERE request_fast_order.fast_id = '$order_id' and restaurant_id = '$resid'");

        $con->query("UPDATE `fast_order` SET `status`='2',`updated_status_time`= now(), coin = '$coin', restaurant_id = '$resid' WHERE id = '$order_id'");


        if ($con->error == "") {
            if ($promoRes->num_rows > 0) {
                $con->query("INSERT INTO `promotion_use`(`id`, `order_id`, `promotion_id`, `used_timed`, `order_type`)"
                        . " VALUES (null,'$order_id','1',now(),'f')");
            }

            $res = $con->query("SELECT * FROM `fast_order` "
                    . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
                    . "WHERE fast_order.id ='$order_id'");
            $data = $res->fetch_assoc();
            $delidate = $data["delivery_date"];
            $qty = $data["quantity"];
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

            $b = $sms->send('0000', $data["tel"], "ร้าน:" . $_SESSION["restdata"]["name"]
                    . "\nตอบรับรายการสั่งซื้อเลขที่: " . 'F' . sprintf("%07d", $order_id) . "แล้ว" . ""
                    . "\nค่ามัดจำ 20%:" . $prepay
                    . "\nShipping Code:" . $data["shipping_password"]
                    . "\n กรุณาชำระค่ามัดจำภายใน 4 ชั่วโมง"
                    . "\nสามารถเช็คสถานะรายการได้ที่ pixupfood.com");


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

        $orderDetailRes = $con->query("UPDATE `request_fast_order` SET accepted = 9 WHERE request_fast_order.fast_id = '$ignoreNormalId' and restaurant_id = '$resid'");

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

echo json_encode($response);
