<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$planid = $_SESSION["restdata"]["serviceplan_id"];
$user = $_POST["username"];
$name = $_POST["name"];
$password = $_POST["password"];
$tel = $_POST["tel"];
$username = $resid . $user;

$countRes = $con->query("SELECT *, COUNT(id) as mess FROM `messenger` WHERE restaurant_id = '$resid' GROUP BY restaurant_id");
$countData = $countRes-> fetch_assoc();
if ($planid == 1 && $countData["mess"] == 2) {
    echo 'บันทึกไม่ได้เพราะ serviceplan ของท่านจำกัดจำนวนคนส่ง';
} else {

    $con->query("INSERT INTO `messenger`(`id`, `username`, `password`, `name`, `tel`, `restaurant_id`)"
            . " VALUES (null,'$username','$password','$name','$tel','$resid')");



    if ($con->error == "") {
        ?>
        <script>
            document.location = "/view/res_manage_edit_messenger.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
}
