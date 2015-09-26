<?php


include '../dbconn.php';
$resid = $_GET["resId"];
$opentime = @$_POST["opentime"];
$closetime = @$_POST["closetime"];
$time = $opentime." ถึง ".$closetime;

$con->query("update restaurant set opentime = '$time' where id = '$resid' ");
if ($con->error == "") {
    ?>
    <script>
        document.location = "/view/res_restaurant_manage_edit.php";
    </script>
    <?php

} else {
    echo $con->error;
}