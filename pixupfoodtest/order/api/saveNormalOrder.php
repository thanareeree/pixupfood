<?php

session_start();

include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$resid = $_POST["resid"];
$shipAddress = $_POST["address"];
$delivery_date = $_POST["date"];
$delivery_time = $_POST["time"];
$payid = $_POST["payment"];
$date = date("Y-m-d", strtotime(str_replace(" GMT+0700 (SE Asia Standard Time)", "", $delivery_date)));
$digits = 8;
$shippingCode = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

$orderDetailRes = $con->query("SELECT `id`, `quantity`, `price`, `set_type`, "
        . "`menu_id`, `created_time`, `status`,  `customer_id`,"
        . " `restaurant_id`"
        . " FROM `order_detail` "
        . "WHERE customer_id = '$cusid' and restaurant_id ='$resid' and status = '0' ");
$total_nofee = 0;
$allprice = 0;
$allQty = 0;
while ($orderDetailData = $orderDetailRes->fetch_assoc()) {
    $allprice += $orderDetailData["price"];
    $allQty += $orderDetailData["quantity"];
    $total_nofee += $orderDetailData["price"] * $orderDetailData["quantity"];
}

$promoRes = $con->query("select * from promotion "
        . "LEFT JOIN promotion_main ON promotion_main.id = promotion.promotion_main_id "
        . "where restaurant_id = '$resid' "
        . "and end_time >= date(now()) and start_time <= date(now()) and promotion_main.id = 1");


$prepay = $total_nofee * 0.2;
$status = "1";
$coin = round($total_nofee / 500);



if (isset($_SESSION["islogin"])) {
    $con->query("INSERT INTO `normal_order`(`id`, `shipping_password`,"
            . " `order_time`, `delivery_date`, `delivery_time`, order_no, `total_nofee`, "
            . "`coin`, `prepay`, `status`, `updated_status_time`, `messenger_id`, "
            . "`restaurant_id`, `customer_id`, `shippingAddress_id`, `payment_id`) "
            . "VALUES (null,'$shippingCode',now(),'$date','$delivery_time',null,'$total_nofee',"
            . "'$coin','$prepay','$status',now(),null,'$resid','$cusid',"
            . "'$shipAddress','$payid[0]')");

    if ($con->error == "") {
        $orderid = $con->insert_id;
        
        $order_no = 'N'.sprintf("%07d",$orderid);
        $con->query("UPDATE `normal_order` SET `order_no`= '$order_no'  WHERE id = $orderid ");
        
        $con->query("UPDATE `order_detail` "
                . "SET `status`= '1',`order_id`= '$orderid' "
                . "WHERE customer_id = '$cusid' and restaurant_id ='$resid' and status = '0' ");

        if ($promoRes->num_rows > 0) {
              $con->query("INSERT INTO `promotion_use`(`id`, `order_id`, `promotion_id`, `used_timed`, `order_type`)"
                      . " VALUES (null,'$orderid','1',now(),'n')");
        }

        if ($con->error == "") {
            echo 'เรียบบบบบบบบบบบบบบบบบบบบบบบบ ร้องไห้ TT';
        } else {
            echo 'อัพเดตคออเดอไม่ได้';
        }
    } else {
        echo 'บันทึกออเดอไม่ได้';
    }
}