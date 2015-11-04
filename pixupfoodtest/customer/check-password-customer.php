<?php
session_start();
include '../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$oldpwd = md5($_POST["oldpwd"]);
$res = $con->query("select password from customer where id = '$cusid'");
$data = $res->fetch_assoc();
if ($data["password"] == $oldpwd) {
    echo json_encode(array(
        "result" => 0
    ));
} else {

    echo json_encode(array(
        "result" => 1,
        "pwd" => $oldpwd."--".$_POST["oldpwd"]
    ));
}