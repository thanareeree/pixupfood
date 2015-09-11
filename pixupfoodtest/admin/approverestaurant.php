<?php

include '../dbconn.php';

$name = $_POST["name"];
$con->query("UPDATE `restaurant` SET `available`= 1 WHERE name = '$name'");

if ($con->error == "") {
    $res = $con->query("select * from restaurant where name = '$name'");

    if ($res->num_rows == 1) {
        $data = $res->fetch_assoc();
        
        include '../register/thsms.php';
        $sms = new thsms();
        $sms->username = 'thanaree';
        $sms->password = '58c60d';

        $b = $sms->send('0000', $data["tel"], "ร้านอาหาร: ".$data["name"]." \nขณะนี้สามารถเข้าใช้งานเว็บ www.pixupfood.com เพื่อไปบันทึกข้อมูลร้านและเข้าใช้งานได้เรียบร้อยแล้ว \n ขอบคุณที่ใช้บริการค่ะ ร่ำรวยเงินทองค่ะ :)");
        //var_dump( $b);

        echo "ok";
    } else {
        echo $con->error;
    }
}  