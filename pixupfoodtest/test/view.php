<?php
session_start();

echo $_SESSION["islogin"];
print_r($_SESSION["userdata"]);
$data = $_SESSION["userdata"]["email"];
echo $data["email"];