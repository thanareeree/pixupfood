<?php

include '../dbconn.php';
$id = $_POST["cusid"];
$otppwd = $con->real_escape_string($_POST["otpinput"]);

if (isset($_POST["otpinput"]) && $_POST["otpinput"] != "") {
    $res = $con->query("SELECT * FROM `otp_password` WHERE cusid= '$id' and password='$otppwd' and status = 0");

    if ($res->num_rows == 1) {
        $data = $res->fetch_assoc();
        $created_otp = $data["created_time"];
        $con->query("UPDATE `customer` SET `available`=1 WHERE id='$id'");
        $con->query("UPDATE `otp_password` SET `status`= 1 WHERE cusid='$id'");

        echo json_encode(array(
            "result" => '1',
            "id" => $id,
            "created_otp" => $created_otp
        ));
    } else {
        echo json_encode(array(
            "result" => 0,
            "error" => "รหัส OTP ไม่ถูกต้อง"
        ));
    }
} else {
    echo json_encode(array(
        "result" => 0,
        "error" => "กรุณากรอกรหัส!"
    ));
}

 