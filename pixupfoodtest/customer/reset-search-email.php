<?php

include '../dbconn.php';

$email = $_POST["email"];
$res = $con->query("select email from customer where email = '$email'");
if ($res->num_rows > 0) {
    echo json_encode(array(
        "result" => 1,
     "email" => $email
    ));
} else {
    $res = $con->query("select email from restaurant where email = '$email'");
    if ($res->num_rows > 0) {
        echo json_encode(array(
            "result" => 1,
            "email" => $email
        ));
    } else {
        echo json_encode(array(
            "result" => 0,
            "error" => "เราไม่สามารถค้นหาบัญชีผู้ใช้ได้จากข้อมูลดังกล่าว"."<br>"."โปรดลองค้นหาด้วยอีเมล อีกครั้ง"
        ));
    }
}