<?php

session_start();

include '../dbconn.php';

$email = $_POST["loginemail"];
$password = $_POST["password"];

$res = $con->query("select * from customer where email='$email' and password='$password'");
$res2 = $con->query("select * from restaurant where email='$email' and password='$password'");


if ($res->num_rows == 0 && $res2->num_rows == 0) {
    echo "username password Invalid";
} else {
    $_SESSION["islogin"] = true;
    $_SESSION["userdata"] = $res->fetch_assoc();
    $_SESSION["restdata"] = $res2->fetch_assoc();

    if ($_SESSION["userdata"]["type"] == 2 && $_SESSION["userdata"]["available"] == 0) {
        ?>
        <script>
            document.location = "../view/customer-otpform.php";
        </script>
        <?php

    } else if ($_SESSION["userdata"]["available"] != 0) {
        ?>
        <script>
            document.location = "../view/cus_customer_profile.php";
        </script>
        <?php

    } else if ($_SESSION["restdata"]["type"] == 1 && $_SESSION["restdata"]["available"] == 0) {  //กรณีแอดมินยังไม่ได้ verify ให้เปิดร้าน
        ?>
        <script>
            document.location = "###";
        </script>
        <?php
    } else if ($_SESSION["restdata"]["available"] != 0) { //แอดมิน อนุมัติแล้ว ร้านอาหารสามารถเข้าไป manage ร้านได้ปกติ
        ?>
        <script>
            document.location = "###";
        </script>
        <?php
    }
}
?>

