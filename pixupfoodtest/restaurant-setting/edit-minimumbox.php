<?php
session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$new = $_POST["minimumbox"];


if(isset($_SESSION["islogin"])){
    $con->query("update restaurant set amount_box_minimum = '$new' where id = '$resid'");
    
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