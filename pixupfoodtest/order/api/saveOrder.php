<?php

session_start();
include '../../dbconn.php';
if (isset($_SESSION["islogin"])) {
    echo "save to db";
    print_r($_POST);
    $foodname = $_POST[""];
    
    
    
}
    