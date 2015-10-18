<?php

session_start();

include '../../dbconn.php';

$cusid = $_SESSION["userdata"]["id"];
$restarr = $_POST["rest"];
$foodarr = $_POST["food"];
$boxtype = $_POST["boxtype"];
$priority = @$_POST["priority"];



if ($boxtype < 4) {
    $ricetype = $_POST["ricetype"];
    array_push($foodarr, $ricetype);
}
$menustr = "(";
foreach ($foodarr as $i => $value) {
    $menustr.="'" . $value . "'";
    if ($i != sizeof($foodarr) - 1) {
        $menustr.=",";
    }
}
$menustr.=")";

$restaurantlist = "(";
foreach ($restarr as $i => $value) {
    $restaurantlist.="'" . $value . "'";
    if ($i != sizeof($restarr) - 1) {
        $restaurantlist.=",";
    }
}
$restaurantlist.=")";

$main_menu_id = "";
foreach ($foodarr as $i => $value) {
    $main_menu_id.="''" . $value . "''";
    if ($i != sizeof($foodarr) - 1) {
        $main_menu_id.=",";
    }
}




$moretext = @$_POST["moretext"];
$amtbox = $_POST["amtbox"];
$shipAddress = $_POST["address"];
$date = $_POST["date"];
$delivery_time = $_POST["time"];
$payid = $_POST["payment"];
$delivery_date = date("Y-m-d", strtotime(str_replace(" GMT+0700 (SE Asia Standard Time)", "", $date)));
$status = "1";
$digits = 8;
$shippingCode = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
 

if (isset($_SESSION["islogin"])) {

    $con->query("INSERT INTO `fast_order`(`id`, `main_menu_id`, `quantity`, `moretext`, "
            . "`order_time`, `shipping_password`, `coin`, `delivery_date`, `delivery_time`, "
            . "`status`, `updated_status_time`, `messenger_id`, `restaurant_id`, "
            . "`customer_id`, `shippingAddress_id`, `payment_id`) "
            . "VALUES (null,'$main_menu_id','$amtbox','$moretext',now(),'$shippingCode',"
            . "null,'$delivery_date','$delivery_time','$status',now(),null,null,"
            . "'$cusid','$shipAddress',$payid)");

    $fast_id = $con->insert_id;
    if ($con->error == "") {
        $foodprice = 0;
        $totalfoodprice = 0;
        $prepay = 0;
        $count = 0;

        foreach ($restarr as $i => $value) {
            $res_id = $value;
            $priceRes = $con->query("SELECT SUM(price) as sumprice ,restaurant_id FROM menu  "
                    . "WHERE  restaurant_id = '$res_id' "
                    . "and menu.main_menu_id IN $menustr GROUP BY menu.restaurant_id");
            while ($priceData = $priceRes->fetch_assoc()) {
                $foodprice = $priceData["sumprice"];
                $totalfoodprice = $foodprice * $amtbox;
                $prepay = $totalfoodprice * 0.2;

              /* if ($count == 0) {
                    $con->query("INSERT INTO `request_fast_order`(`id`, `fast_id`, `restaurant_id`, "
                            . "`price`, `total`, `prepay`, `priority`) "
                            . "VALUES (null,'$fast_id','$res_id','$foodprice','$totalfoodprice','$prepay','$priority[0]')");
                } else if ($count == 1) {
                    $con->query("INSERT INTO `request_fast_order`(`id`, `fast_id`, `restaurant_id`, "
                            . "`price`, `total`, `prepay`, `priority`) "
                            . "VALUES (null,'$fast_id','$res_id','$foodprice','$totalfoodprice','$prepay','$priority[1]')");
                } else if ($count == 2) {
                    $con->query("INSERT INTO `request_fast_order`(`id`, `fast_id`, `restaurant_id`, "
                            . "`price`, `total`, `prepay`, `priority`) "
                            . "VALUES (null,'$fast_id','$res_id','$foodprice','$totalfoodprice','$prepay','$priority[2]')");
                }
                */
                 $con->query("INSERT INTO `request_fast_order`(`id`, `fast_id`, `restaurant_id`, "
                            . "`price`, `total`, `prepay`, `priority`) "
                            . "VALUES (null,'$fast_id','$res_id','$foodprice','$totalfoodprice','$prepay','1')");

                if ($con->error == "") {
                   
                    echo 'เรียบบบบบบบบบบบบบบ';
                } else {
                    echo $con->error . 'บันทึก ตารางรีเควสฟาส ไม่ได้ #ร้องไห้หนักมาก';
                }
            }
        }
    } else {
        echo $con->error . 'บันทึกอะไรไม่ได้เลย เหี้ยยยยย !!';
    }
}  