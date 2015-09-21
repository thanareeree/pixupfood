<?php

include '../dbconn.php';

$id = $_POST["id"];


if($id !=""){
    $con->query("DELETE FROM `shippingAddress` where id = '$id' ");
    if ($con->error == "") {
       echo "ok";

    } else {
        echo $con->error;
    }
}else {
        echo $con->error;
    }


