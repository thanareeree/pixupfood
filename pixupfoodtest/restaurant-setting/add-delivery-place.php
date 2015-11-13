<?php

session_start();

include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$proid = $_POST["province_id"];
$disid = $_POST["district_id"];

$res = $con->query("SELECT district_name FROM `data_district` WHERE district_id = '$disid'");
$data = $res->fetch_assoc();
$disname = $data["district_name"];

$placeRes = $con->query("SELECT data_district.district_name FROM data_district "
        . "RIGHT JOIN delivery_place ON delivery_place.district_id = data_district.district_id "
        . "WHERE delivery_place.restaurant_id = '$resid' "
        . "AND delivery_place.district_id = '$disid'");

if ($placeRes->num_rows > 0) {
    echo json_encode(array(
        "result" => 2,
        "error" => "คุณบันทึก" . $disname . "เรียบร้อยเเล้ว"
    ));
} else {

    $con->query("INSERT INTO `delivery_place`(`id`, `province_id`, `district_id`, "
            . "`restaurant_id`) "
            . "VALUES (null,'$proid','$disid','$resid')");

    if ($con->error == "") {
        echo json_encode(array(
            "result" => 1,
            "name" => $disname
        ));
    } else {
        echo json_encode(array(
            "result" => 2,
            "error" => $con->error
        ));
    }
}

