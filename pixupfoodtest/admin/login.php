<?php

session_start();

include '../dbconn.php';

$username = $_POST["username"];
$password = $_POST["password"];

$res = $con->query("select * from admin where username='$username' and password='$password'");
//$data = $res->fetch_assoc(); 

if ($res->num_rows == 0) {
    echo "username password Invalid";
} else {
    $_SESSION["islogin"] = true;
    $_SESSION["userdata"] = $res->fetch_assoc();
    echo 'ok';

}
