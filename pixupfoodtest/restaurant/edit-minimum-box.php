<?php
include '../dbconn.php';

$minimum = $_POST["minimumbox"];
$resid = $_GET["resId"];
$con->query("UPDATE `restaurant` SET `amount_box_minimum`= '$minimum' where id = '$resid' ");


if ($con->error == "") {
    ?>
    <script>
        document.location = "/view/res_manage_edit_order.php";
    </script>
    <?php

} else {
    echo $con->error;
}
