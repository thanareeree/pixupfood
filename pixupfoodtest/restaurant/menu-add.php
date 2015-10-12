<?php

include '../dbconn.php';

$menuid = $con->real_escape_string(@$_POST["menuid"]);
$riceid = $con->real_escape_string(@$_POST["riceid"]);
$singleid = $con->real_escape_string(@$_POST["singleid"]);
$snackid = $con->real_escape_string(@$_POST["snackid"]);
$drinkid = $con->real_escape_string(@$_POST["drinkid"]);
$price = $con->real_escape_string(@$_POST["price"]);
$resid = $con->real_escape_string(@$_POST["resid"]);

$res = $con->query("SELECT main_menu_id FROM `menu` WHERE restaurant_id = '$resid'");


$response = array(
    "result" => 0,
    "reason" => "กรุณาใส่ข้อมูล"
);

$count = 0;

if ($menuid != "0") {
    while ($data = $res->fetch_assoc()) {
        if ($data["main_menu_id"] == $menuid) {
            $response = array(
                "result" => 2
            );
            $count = 1;
        }
    }

    if ($count == 0) {
        $con->query("INSERT INTO `menu`(`id`, `price`, `img_path`, "
                . " `main_menu_id`, `restaurant_id`)"
                . " VALUES (null,'$price',null,'$menuid','$resid')");
        if ($con->error == "") {
            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "reason" => $con->error
            );
        }
    }
} else if ($riceid != "0") {
    while ($data = $res->fetch_assoc()) {
        if ($data["main_menu_id"] == $riceid) {
            $response = array(
                "result" => 2
            );
            $count = 1;
        }
    }

    if ($count == 0) {
        $con->query("INSERT INTO `menu`(`id`, `price`, `img_path`, "
                . " `main_menu_id`, `restaurant_id`)"
                . " VALUES (null,'$price',null,'$riceid','$resid')");
        if ($con->error == "") {
            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "reason" => $con->error
            );
        }
    }
} else if ($singleid != "0") {
    while ($data = $res->fetch_assoc()) {
        if ($data["main_menu_id"] == $singleid) {
            $response = array(
                "result" => 2
            );
            $count = 1;
        }
    }

    if ($count == 0) {
        $con->query("INSERT INTO `menu`(`id`, `price`, `img_path`, "
                . " `main_menu_id`, `restaurant_id`)"
                . " VALUES (null,'$price',null,'$singleid','$resid')");
        if ($con->error == "") {
            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "reason" => $con->error
            );
        }
    }
} else if ($snackid != "0") {
    while ($data = $res->fetch_assoc()) {
        if ($data["main_menu_id"] == $snackid) {
            $response = array(
                "result" => 2
            );
            $count = 1;
        }
    }

    if ($count == 0) {
        $con->query("INSERT INTO `menu`(`id`, `price`, `img_path`, "
                . " `main_menu_id`, `restaurant_id`)"
                . " VALUES (null,'$price',null,'$snackid','$resid')");
        if ($con->error == "") {

            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "reason" => $con->error
            );
        }
    }
} else if ($drinkid != "0") {
    while ($data = $res->fetch_assoc()) {
        if ($data["main_menu_id"] == $drinkid) {
            $response = array(
                "result" => 2
            );
            $count = 1;
        }
    }

    if ($count == 0) {
        $con->query("INSERT INTO `menu`(`id`, `price`, `img_path`, "
                . " `main_menu_id`, `restaurant_id`)"
                . " VALUES (null,'$price',null,'$drinkid','$resid')");
        if ($con->error == "") {
            $response = array(
                "result" => 1
            );
        } else {
            $response = array(
                "result" => 0,
                "reason" => $con->error
            );
        }
    }
}
echo json_encode($response);
?>

