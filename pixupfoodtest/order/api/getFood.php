<?php
include '../../dbconn.php';
$boxtype = $_POST["boxtype"];
if ($boxtype == "4") {
    $type = "อาหารจานเดียว";
} else {
    $type = "กับข้าว";
}
$foods = array();
$foodListRes = $con->query("SELECT DISTINCT main_menu.id, menu.img_path,  main_menu.name as menuname, "
        . "food_type.description as foodtype, main_menu.type, main_menu.img_path as img  "
        . "FROM menu JOIN restaurant ON menu.restaurant_id = restaurant.id "
        . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
        . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
        . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
        . "WHERE main_menu.type = '$type'");

while ($foddListData = $foodListRes->fetch_assoc()) {
    $food = array(
        "name" => $foddListData["menuname"],
        "img" => $foddListData["img"],
        "id" => $foddListData["id"]
    );
    array_push($foods, $food);
}
echo json_encode($foods);