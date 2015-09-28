<?php

include '../dbconn.php';

$cusid = @$_GET["cusId"];
$resid = @$_GET["resId"];

$boxamount = $_POST["boxamount"];
$rice = @$_POST["ricetype"];
$foodset = $_POST["foodlist"];
$foodset_name = "";
foreach ($foodset as $fb) {
    $foodset_name .= $fb . " + ";
}
$foodQty = "";

$foodListRes = $con->query("SELECT  menu.price  "
        . "FROM `menu` LEFT JOIN main_menu on main_menu.id = menu.main_menu_id "
        . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
        . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
        . "WHERE main_menu.name = '$' or "
        . "and menu.restaurant_id = '$resid'");

while ($foddListData = $foodListRes->fetch_assoc()) {
    $foodQty += $foddListData["price"];
}

echo $foodQty;
$delivery_date = date("Y-m-d", strtotime($_POST["delivery_date"]));
$delivery_time = $_POST["delivery_time"];
$shipAddress = $_POST["shipAddress"];
$paymentData = $_POST["paymentData"];

$customerRes = $con->query("SELECT  `firstName`, `lastName` FROM `customer` WHERE id = '$cusid'");



$con->query("");



