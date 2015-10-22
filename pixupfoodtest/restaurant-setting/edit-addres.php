<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$newAddress = $_POST["resaddress"];



if (isset($_SESSION["islogin"])) {
    $con->query("update restaurant set address = '$newAddress' where id = '$resid'");

    if ($con->error == "") {
        ?>
        <script>
            document.location = "/view/res_restaurant_manage_edit.php";
        </script>
        <?php

    } else {

        echo $con->error;
    }
}