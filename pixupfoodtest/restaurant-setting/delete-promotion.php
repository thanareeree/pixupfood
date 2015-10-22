<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$proid = $_GET["proid"];



if (isset($_SESSION["islogin"])) {
    $con->query(" DELETE FROM `promotion` where id = '$proid'");
    if ($con->error == "") {
        echo json_encode(array(
            "result" => '1'
        ));
    } else {
        echo json_encode(array(
            "result" => '0',
            "error" => $con->error
        ));
    }
}