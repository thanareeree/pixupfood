<?php
session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$name = @$_POST["foodname"];
$type = @$_POST["typefood-add"];




$target_dir = "../upload/menu/";

$filename = @$_FILES["imagerest"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$newfliename = "img-menu-" . uniqid() . $file_ext;
$target_file = $target_dir . $newfliename;
$path_img = substr($target_file, 2);
//$target_file = $target_dir . basename(@$_FILES["imagesnewmenu"]["name"]);

$menu_id = "";



if ($_FILES['imagerest']['name'] != "" && ($type == "กับข้าว" || $type == "อาหารจานเดียว")) {  //มีรูป เป็นกับข้าว
    $food_type = @$_POST["foodtypelist"];
    $priceMainMenu = @$_POST["priceMainMenu"];

    move_uploaded_file(@$_FILES["imagerest"]["tmp_name"], $target_file);
    $con->query("INSERT INTO `main_menu`(`id`, `name`, `type`, `img_path`)"
            . " VALUES (null,'$name','$type','$path_img')");

    $menu_id = $con->insert_id;

    if (!empty($menu_id)) {
        $con->query("INSERT INTO `mapping_food_type`(`menu_id`, `food_type_id`) "
                . "VALUES ('$menu_id','$food_type')");
        $con->query("INSERT INTO `menu`(`id`, `price`, `img_path`, "
                . " `main_menu_id`, `restaurant_id`)"
                . " VALUES (null,'$priceMainMenu',null,'$menu_id','$resid')");

        if ($con->error == "") {
            ?>
            <script>
                document.location = "/view/res_restaurant_manage_menulist.php";
            </script>
            <?php

        } else {
            echo $con->error;
        }
    }
} else if ($_FILES['imagerest']['name'] != "" && ($type == 'ชนิดข้าว' || $type == 'ขนม' || $type == 'เครื่องดื่ม' )) {  //มีรูป ไม่ใช่กับข้าว ไม่มี foodtype
    move_uploaded_file(@$_FILES["imagerest"]["tmp_name"], $target_file);
    $con->query("INSERT INTO `main_menu`(`id`, `name`, `type`, `img_path`)"
            . " VALUES (null,'$name','$type','$path_img')");

    $menu_id = $con->insert_id;
    $price = @$_POST["priceMainMenu"];
    if (!empty($menu_id)) {
       $con->query("INSERT INTO `menu`(`id`, `price`, `img_path`, "
                . " `main_menu_id`, `restaurant_id`)"
                . " VALUES (null,'$price',null,'$menu_id','$resid')");

        if ($con->error == "") {
            ?>
            <script>
                document.location = "/view/res_restaurant_manage_menulist.php";
            </script>
            <?php

        } else {
            echo $con->error;
        }
    } 
} 