<?php

include '../dbconn.php';
include '../register/thsms.php';
$sms = new thsms();
$sms->username = 'thanaree';
$sms->password = '58c60d';

$tel = @$_POST["tel"];
$email = @$_POST["account_identifier"];

$digits = 8;
$pwd = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
$newpassword = md5($pwd);

$con->query("UPDATE `customer` SET password = '$newpassword' where email = '$email'");

if ($con->error == "") {
   $b = $sms->send('0000', $tel, "New Password: " . $pwd . "\n " . "\npixupfood.com");
    echo json_encode(array(
        "result" => 1
    ));
} else {
    echo json_encode(array(
        "result" => 0,
        "error" => $con->error
    ));
}   