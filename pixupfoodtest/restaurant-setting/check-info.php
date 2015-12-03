<?php

session_start();

include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$res = $con->query("SELECT * FROM `restaurant` WHERE id = '$resid'");
$boxres = $con->query("SELECT * FROM `mapping_food_box` WHERE restaurant_id = '$resid'");
$paymentres = $con->query("SELECT * FROM `mapping_payment_type` WHERE restaurant_id = '$resid'");
$delires = $con->query("SELECT * FROM `mapping_delivery_type` WHERE restaurant_id = '$resid'");
$data = $res->fetch_assoc();

$amount_box_minimum = $data["amount_box_minimum"];
$amount_box_limit = $data["amount_box_limit"];

if ($amount_box_limit == null || $amount_box_minimum == null || $boxres->num_rows == 0 || $paymentres->num_rows == 0 || $delires->num_rows == 0) {
    echo json_encode(array(
        "result" => 1,
    ));
} else {
    echo json_encode(array(
        "result" => 0
    ));
}