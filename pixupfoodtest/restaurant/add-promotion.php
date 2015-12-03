<?php
session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$promoid = $_POST["promotionselect"];


if ($promoid = "1") {
    $detail = $_POST["detail"];
    $start = $_POST["start_date"];
    $end = $_POST["end_date"];
    $start_date = date("Y-m-d", strtotime( $start));
    $end_date = date("Y-m-d", strtotime( $end));
    $con->query("INSERT INTO `promotion`(`id`, `description`, `created_time`, `start_time`, `end_time`, "
            . "`limit`, `img_path`, `discount`, `restaurant_id`, `promotion_main_id`)"
            . " VALUES (null,'$detail',now(),'$start_date','$end_date',null,"
            . "null,null,'$resid','$promoid')");

    if ($con->error == "") {
        ?>
        <script>
            document.location = "/view/res_manage_edit_promotion.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }

//print_r($_POST);
    
    //echo "\n".$start_date;
}