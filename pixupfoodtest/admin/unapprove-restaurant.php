<?php

include '../dbconn.php';

$name = $_POST["name"];
$reason = $_POST["reason"];
$con->query("UPDATE `restaurant` SET `available`= 2 WHERE name = '$name'"); // available 2 = แอดมินไม่อนุญาติให้ร้านเข้าใช้เว็บ

if ($con->error == "") {
    $res = $con->query("select * from restaurant where name = '$name'");

    if ($res->num_rows == 1) {
        $data = $res->fetch_assoc();
        $restid = $data["id"];
        $con->query("INSERT INTO `disapprove_restaurant`(`id`, `detail`, `restaurant_id`) "
                . "VALUES ('null','$reason','$restid')");
        if ($con->error == "") {
            
              include '/register/thsms.php';
              $sms = new thsms();
              $sms->username = 'thanaree';
              $sms->password = '58c60d';

              $b = $sms->send('0000', $data["tel"], "ร้านอาหาร: ".$data["name"]." \nท่านไม่มีสิทธิเข้าใช้เว็บ www.pixupfood.com เนื่องจาก".$reason." \nติดต่อสอบถามเพิ่มเติมได้ที่เบอร์ 0856656986 \nขอบคุณครับ");
              //var_dump( $b);
             
            echo "ok";
        }
    } else {
        echo $con->error;
    }
}else {
        echo $con->error;
    }  