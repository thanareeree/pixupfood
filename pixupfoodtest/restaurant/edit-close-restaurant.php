<?php
session_start();
include '../dbconn.php';
$id = $_SESSION["restdata"]["id"];

$closestatus = @$_POST["closestatus"];

if($closestatus == 0){
    $con->query("UPDATE restaurant SET close = 1 where id = '$id'");
    if ($con->error == "") {
       
        ?>
        <script>
            document.location = "../view/res_restaurant_manage_edit.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
}  else {
    $con->query("UPDATE restaurant SET close = 0 where id = '$id'");
    if ($con->error == "") {
        
        ?>
        <script>
            document.location = "../view/res_restaurant_manage_edit.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
}
