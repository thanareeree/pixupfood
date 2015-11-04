<?php
session_start();
include '../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$newpwd = md5($_POST["newpwd"]);

$con->query("update customer set password = '$newpwd' where id = '$cusid'");

if ($con->error == "") {
    echo json_encode(array(
        "result" => 0
    ));
} else {

    echo json_encode(array(
        "result" => 1,
        "error" => $con->error
    ));
}