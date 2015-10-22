<?php
session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$newEmail = $_POST["email"];
$newTel = $_POST["tel"];



if(isset($_SESSION["islogin"])){
    $con->query("update restaurant set tel = '$newTel', email='$newEmail' where id = '$resid'");
    
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