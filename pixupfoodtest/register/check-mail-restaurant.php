<?php

include '../dbconn.php';

$email = $_POST["resemail"];
$res = $con->query("select email from restaurant where email = '$email'");
if ($res->num_rows > 0) {
    echo json_encode(array(
        "result" => 1
    ));
} else {
     echo json_encode(array(
        "result" => 0
    ));
}