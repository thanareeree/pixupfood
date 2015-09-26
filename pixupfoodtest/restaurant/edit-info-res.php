<?php


include '../dbconn.php';
$resid = $_GET["resId"];
$resname = @$_POST["resname"];
$restaurant_type = @$_POST["restaurant_type"];
$has_rest = @$_POST["has_rest"];

$con->query("update restaurant set name = '$resname' , has_restaurant = '$has_rest',"
        . " restaurant_type = '$restaurant_type' where id = '$resid' ");
if ($con->error == "") {
    ?>
    <script>
        document.location = "/view/res_restaurant_manage_edit.php";
    </script>
    <?php

} else {
    echo $con->error;
}