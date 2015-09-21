<?php
session_start();

include '../dbconn.php';

$email = $_POST["loginemail"];
$password = $_POST["password"];
$de_password = md5($password);

$res = $con->query("select * from customer where email='$email' and password='$de_password'");
$res2 = $con->query("select * from restaurant where email='$email' and password='$de_password'");


if ($res->num_rows == 0 && $res2->num_rows == 0) {
    echo "username password Invalid";
} else {
    $_SESSION["islogin"] = true;
    $_SESSION["userdata"] = $res->fetch_assoc();
    $_SESSION["restdata"] = $res2->fetch_assoc();
    
    if ($_SESSION["userdata"]["type"] == 2 && $_SESSION["userdata"]["available"] == 0) {
        ?>
        <script>
            document.location = "../view/cus_otpform.php?id=<?= $_SESSION["userdata"]["id"]?>";
        </script>
        <?php
    
    } else if ($_SESSION["userdata"]["available"] != 0) {
        ?>
        <script>
            document.location = "../view/cus_customer_profile.php";
        </script>
        <?php

    } else if ($_SESSION["restdata"]["type"] == 1 && $_SESSION["restdata"]["img_path"] == null) {  //กรณีแอดมินยังไม่ได้ verify ให้เปิดร้าน
        ?>
        <script>
            document.location = "../view/res_confirmform.php?id=<?= $_SESSION["restdata"]["id"] ?>";
        </script>
        <?php
    } else if ($_SESSION["restdata"]["available"] == 0) { //แอดมิน ยังไม่อนุมัติ
        ?>
        <script>
            document.location = "../view/res_unapprove.php";
        </script>
        <?php
    }else if ($_SESSION["restdata"]["available"] != 0) { //แอดมิน อนุมัติแล้ว ร้านอาหารสามารถเข้าไป manage ร้านได้ปกติ
        ?>
        <script>
            document.location = "../view/res_restaurant_manage_menulist.php";
        </script>
        <?php
    }
}
?>

