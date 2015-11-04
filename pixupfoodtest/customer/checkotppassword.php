<?php

date_default_timezone_set("Asia/Bangkok");
include '../dbconn.php';
$id = $_POST["cusid"];
$otppwd = $con->real_escape_string($_POST["otpinput"]);

if (isset($_POST["otpinput"]) && $_POST["otpinput"] != "") {
    $res = $con->query("SELECT * FROM `otp_password` WHERE cusid= '$id' and password='$otppwd' and status = 0");

    if ($res->num_rows == 1) {
        $now = time();
        $data = $res->fetch_assoc();
        $created_otp = strtotime($data["created_time"]);
        $diff = $now - $created_otp;
        $timeleft;
        if ($diff > (60 * 30)) {
            $con->query("DELETE FROM `otp_password` WHERE cusid = '$id'");
            $con->query("DELETE FROM `shippingAddress` WHERE customer_id = '$id'");
             $con->query("DELETE FROM `customer` WHERE id = '$id'");
          //  $con->query("UPDATE `customer` SET `email`= 'xxxxx' WHERE id='$id'");
            echo json_encode(array(
                "result" => 2,
                "error" => "รหัส OTP ท่านหมดอายุแล้ว กรุณาสมัครสมาขิกใหม่อีกครั้ง" . $con->error
            ));
        } else {
            $con->query("UPDATE `customer` SET `available`=1 WHERE id='$id'");
            $con->query("UPDATE `otp_password` SET `status`= 1 WHERE cusid='$id'");

            echo json_encode(array(
                "result" => '1',
                "id" => $id
            ));
        }
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

 