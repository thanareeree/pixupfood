<?php
session_start();
if(!isset($_SESSION["islogin"])){
 echo  '<script>document.location = "../view/login.php";</script>';
 die();

    
    }
?>