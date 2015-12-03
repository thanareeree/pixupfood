<?php

include '../dbconn.php';
$foodname = $_POST["foodname"];


$res = $con->query("select name from main_menu where name = '$foodname'");
if ($res->num_rows > 0) {
    echo json_encode(array(
        "result" => 1
    ));
} else {

    echo json_encode(array(
        "result" => 0
    ));
}