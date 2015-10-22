<?php

session_start();
include '../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];

$favid = $_GET["menuid"];

if (isset($_SESSION["islogin"])) {
    $con->query("INSERT INTO `favorite_menu`(`id`, `fav_time`, `menu_id`, `customer_id`)"
            . " VALUES (null,now(),'$favid','$cusid')");
    if ($con->error == "") {
        echo json_encode(array(
            "result" => '1',
            "favid" => $con->insert_id
        ));
    } else {
        echo json_encode(array(
            "result" => '0',
            "error" => $con->error
        ));
    }
}