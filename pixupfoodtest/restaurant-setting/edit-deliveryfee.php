<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$new = $_POST["newfee"];


if (isset($_SESSION["islogin"])) {
    $con->query("UPDATE `mapping_delivery_type` SET `deliveryfee`='$new' WHERE  restaurant_id = '$resid'");

    if ($con->error == "") {
        ?>
        <script>
            document.location = "/view/res_manage_edit_order.php";
        </script>
        <?php

    } else {

        echo $con->error;
    }
}