<?php
include '../dbconn.php';

$limiit = $_POST["limitbox"];
$resid = $_POST["restiddata"];
$con->query("UPDATE `restaurant` SET `amount_box_limit`= '$limiit' where id = '$resid' ");


if ($con->error == "") {
    ?>
    <script>
        document.location = "/view/res_manage_edit_order.php";
    </script>
    <?php

} else {
    echo $con->error;
}
