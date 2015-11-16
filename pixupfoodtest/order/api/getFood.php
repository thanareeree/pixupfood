<?php
include '../../dbconn.php';
$boxtype = $_POST["boxtype"];
if ($boxtype == "4") {
    $type = "อาหารจานเดียว";
} else if ($boxtype == "5") {
    $type = "ขนม";
}else if ($boxtype == "6") {
    $type = "เครื่องดื่ม";
}else{
    $type = "กับข้าว";
}
$foods = array();
$foodListRes = $con->query("SELECT main_menu.id, menu.img_path, main_menu.name as menuname,"
        . " food_type.description as foodtype, main_menu.type, main_menu.img_path as img "
        . "FROM menu "
        . "left JOIN restaurant ON menu.restaurant_id = restaurant.id "
        . "left JOIN main_menu ON main_menu.id = menu.main_menu_id "
        . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
        . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
        . "WHERE main_menu.type = '$type' "
        . "GROUP by main_menu.id "
        . "ORDER BY main_menu.name");

while ($foddListData = $foodListRes->fetch_assoc()) {
    $food = array(
        "name" => $foddListData["menuname"],
        "img" => $foddListData["img"],
        "id" => $foddListData["id"]
    );
    array_push($foods, $food);
}
echo json_encode($foods);