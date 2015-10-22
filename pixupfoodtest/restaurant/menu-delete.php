<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$menuresid = $_GET["menuresid"];

if (isset($_SESSION["islogin"])) {
    $con->query("DELETE FROM `menu` WHERE id = '$menuresid'");
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



