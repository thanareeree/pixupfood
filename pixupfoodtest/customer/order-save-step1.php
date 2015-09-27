<?php
include '../dbconn.php';
$foodListRes = $con->query("SELECT  menu.price  "
        . "FROM `menu` LEFT JOIN main_menu on main_menu.id = menu.main_menu_id "
        . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
        . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
        . "WHERE main_menu.name = 'ยำไข่ดาว' "
        . "and menu.restaurant_id = 34");

while ($foddListData = $foodListRes->fetch_assoc()) {
  
   
        $foodlist[] = $foddListData;
        print_r($foodlist);
   
} echo $foodlist[0];
