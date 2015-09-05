<?php

function sendsms($username, $password, $from, $to, $message) {

    $url = "http://www.thsms.com/api/rest?method=send&username=$username&password=$password&from=$from&to=$to&message=$message";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    return $result;
}

//วิธีเรียกใช้
$username = "thanaree";
$password = "58c60d";
$from = "0000";
$to = "0909923252";
$message = "Test Send Message From sms gateway";

$result = sendsms($username, $password, $from, $to, $message);
echo $result;
