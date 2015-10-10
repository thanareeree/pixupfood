<?php
include '../../dbconn.php';

$res = $con->query("SELECT * FROM `order_detail` WHERE 1");

$data = $res->fetch_assoc();
$menuid = $data["menu_id"];
$menuid = "(".$menuid.")";
echo $menuid;
$resName = $con->query("SELECT menu.price, main_menu.name FROM menu "
        . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
        . "WHERE menu.id IN $menuid");
$foodname = "";
$i = 0;
while ($dataName = $resName->fetch_assoc()){
    $foodname .= "''";
    $foodname .= $dataName["name"]."''";
    $i++;
   if($i < $resName->num_rows){
        $foodname .= ",";
    }
}

$con->query("UPDATE `order_detail` SET `menu_id`= '$foodname' WHERE 1");


