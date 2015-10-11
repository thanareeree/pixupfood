<?php

session_start();

include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$resid = $_POST["resid"];
$foodarr = $_POST["food"];
$boxtype = $_POST["boxtype"];
$moretext = @$_POST["moretext"];
if ($boxtype < 4) {
    $ricetype = $_POST["ricetype"];
    array_push($foodarr, $ricetype);
}

$amtbox = $_POST["amtbox"];
$set_type = "";
if (sizeof($foodarr) == 1) {
    $set_type = '1';
} else {
    $set_type = '2';
}

$menustr = "(";
foreach ($foodarr as $i => $value) {
    $menustr.="'" . $value . "'";
    if ($i != sizeof($foodarr) - 1) {
        $menustr.=",";
    }
}
$menustr.=")";
$res = $con->query("SELECT menu.price, main_menu.name, menu.id FROM menu "
        . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
        . "WHERE restaurant_id = '$resid' AND menu.id IN $menustr");
if ($res->num_rows == sizeof($foodarr)) {
    $foodprice = 0;
    $foodid = "";
    $i = 0;
    while ($food = $res->fetch_assoc()) {
        $foodprice += $food["price"];
        
        $foodid .= "''";
        $foodid .= $food["id"] . "''";
        $i++;
        if ($i < $res->num_rows) {
            $foodid .= ",";
        }
    }
}

if (isset($_SESSION["islogin"])) {
    $con->query("INSERT INTO `order_detail`(`id`, `quantity`, `price`, `set_type`,"
            . " `menu_id`, `moretext`, `created_time`, `status`, `order_id`, "
            . "`customer_id`, `restaurant_id`)"
            . " VALUES (null,'$amtbox','$foodprice','$set_type','$foodid',"
            . "'$moretext',now(),'0',null,'$cusid','$resid')");

    if ($con->error == "") {
        echo json_encode(array(
            "result" => 1,
        ));
    } else {
        echo json_encode(array(
            "result" => 2,
            "error" => $con->error 
        ));
    }
}
?>