<?php

include '../dbconn.php';

$name = $_POST["foodname"];
$type = $_POST["select_type"];
$price = $_POST["price"];

$resid = $_GET["id"];


$target_dir = "../upload/restaurant/menu/";

$filename = $_FILES["imagesnewmenu"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$newfliename =  "img".$resid."-". uniqid().$file_ext;
$target_file = $target_dir . $newfliename;

//$target_file = $target_dir . basename(@$_FILES["imagesnewmenu"]["name"]);





if ($_FILES['imagesnewmenu']['name'] != "" && $type == "กับข้าว") {  //มีรูป เป็นกับข้าว
    $food_type = $_POST["foodtypelist"];


    move_uploaded_file(@$_FILES["imagesnewmenu"]["tmp_name"], $target_file);
    $con->query("INSERT INTO `menu`(`id`, `name`, `type`, `price`, `img_path`, `restaurant_id`) "
            . "VALUES ('null','$name','$type','$price','$target_file','$resid')");

    $menu_id = $con->insert_id;

    if (!empty($menu_id)) {
        $con->query("INSERT INTO `mapping_food_type`(`menu_id`, `food_type_id`) "
                . "VALUES ('$menu_id','$food_type')");

        if ($con->error == "") {
            ?>
            <script>
                document.location = "../view/res_restaurant_manage_menulist.php";
            </script>
            <?php

        } else {
            echo $con->error;
        }
    } else {
        echo $con->error;
    }
} else if ($_FILES['imagesnewmenu']['name'] != "" && $type != "กับข้าว") {  //มีรูป ไม่ใช่กับข้าว ไม่มี foodtype
    move_uploaded_file(@$_FILES["imagesnewmenu"]["tmp_name"], $target_file);
    $con->query("INSERT INTO `menu`(`id`, `name`, `type`, `price`, `img_path`, `restaurant_id`) "
            . "VALUES ('null','$name','$type','$price','$target_file','$resid')");

    if ($con->error == "") {
        ?>
        <script>
            document.location = "../view/res_restaurant_manage_menulist.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
} else if ($_FILES['imagesnewmenu']['name'] == "" && $type == "กับข้าว") {  //ไม่มีรูป แต่เป็นกับข้าว เลยมี foodtype
    $food_type = $_POST["foodtypelist"];

    $con->query("INSERT INTO `menu`(`id`, `name`, `type`, `price`, `img_path`, `restaurant_id`) "
            . "VALUES ('null','$name','$type','$price',null,'$resid')");

    $menu_id = $con->insert_id;

    if (!empty($menu_id)) {
        $con->query("INSERT INTO `mapping_food_type`(`menu_id`, `food_type_id`) "
                . "VALUES ('$menu_id','$food_type')");

        if ($con->error == "") {
            ?>
            <script>
                document.location = "../view/res_restaurant_manage_menulist.php";
            </script>
            <?php

        } else {
            echo $con->error;
        }
    } else {
        echo "ไม่เจอ menu id";
    }
} else if ($_FILES['imagesnewmenu']['name'] == "" && $type != "กับข้าว") {  //ไม่มีรูป ไม่ใช่กับข้าว
    $con->query("INSERT INTO `menu`(`id`, `name`, `type`, `price`, `img_path`, `restaurant_id`) "
            . "VALUES ('null','$name','$type','$price',null,'$resid')");

    if ($con->error == "") {
        ?>
        <script>
            document.location = "../view/res_restaurant_manage_menulist.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
}




