<?php
session_start();
if(!isset($_SESSION["islogin"])){
 echo  '<script>document.location = "../index.php";</script>';
 die();

    
    }
?>