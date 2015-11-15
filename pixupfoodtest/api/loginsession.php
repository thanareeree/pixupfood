<?php

session_start();

include '../dbconn.php';
$email = $_POST["loginemail"];
$password = $_POST["password"];
$de_password = md5($password);

$res = $con->query("select * from customer where email='$email' and password='$de_password'");
$res2 = $con->query("select * from restaurant where email='$email' and password='$de_password'");

$response = array(
    "result" => 0,
    "reason" => "Please Input Username / Password"
);

if ($res->num_rows == 0 && $res2->num_rows == 0) {
    $response = array(
        "result" => 0,
        "reason" => "Username or Password not Found !"
    );
} else {
    $_SESSION["islogin"] = true;
    $_SESSION["userdata"] = $res->fetch_assoc();
    $data = $_SESSION["userdata"];
    $_SESSION["restdata"] = $res2->fetch_assoc();

    if ($_SESSION["userdata"]["type"] == 2 && $_SESSION["userdata"]["available"] == 0) {
        $response = array(
            "result" => 1,
            "redirectTo" => "/view/cus_otpform.php?id=" . $_SESSION["userdata"]["id"]
        );
    } else if ($_SESSION["userdata"]["available"] != 0 && $_SESSION["userdata"]["block"] != 0) {
         $response = array(
            "result" => 1,
            "redirectTo" => "/view/cus_blocked.php"
        );
    }else if ($_SESSION["userdata"]["available"] != 0) {
        $response = array(
            "result" => 2,
            "id" => $data["id"],
            "name" => $data["firstName"] . " " . $data["lastName"],
            "img" => ($data["img_path"] == "" ? '/assets/images/defaulf-profile.png' : $data["img_path"])
        );
    } else if ($_SESSION["restdata"]["type"] == 1 && $_SESSION["restdata"]["img_path_confirm"] == null) {  //ไม่อัพรูป
        $response = array(
            "result" => 1,
            "redirectTo" => "./view/res_confirmform.php?id=" . $_SESSION["restdata"]["id"]
        );
    } else if ($_SESSION["restdata"]["available"] == 0 || $_SESSION["restdata"]["available"] == 2) { //แอดมิน ยังไม่อนุมัติ
        $response = array(
            "result" => 1,
            "redirectTo" => "/view/res_unapprove.php"
        );
    } else if ($_SESSION["restdata"]["available"] == 1 && $_SESSION["restdata"]["block"] == 1) { //แอดมิน อนุมัติแล้ว ร้านอาหารสามารถเข้าไป manage ร้านได้ปกติ
        $response = array(
            "result" => 1,
            "redirectTo" => "/view/res_blocked.php"
        );
    } else if ($_SESSION["restdata"]["available"] == 1) { //แอดมิน อนุมัติแล้ว ร้านอาหารสามารถเข้าไป manage ร้านได้ปกติ
        $response = array(
            "result" => 1,
            "redirectTo" => "/view/res_restaurant_manage_edit.php"
        );
    }
}
echo json_encode($response);
?>

