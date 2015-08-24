<?php
session_start();
if(!isset($_SESSION["islogin"])){
 echo  '<script>document.location = "../view/admin-home.php";</script>';
 die();

    
    }
?>