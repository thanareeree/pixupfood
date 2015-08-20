<?php

include '../dbconn.php';

$adds = $con->real_escape_string($_POST["address"]);
$proid = $con->real_escape_string($_POST["proid"]);
$addnaming = $con->real_escape_string($_POST["addnaming"]);
$cusid = $con->real_escape_string($_POST["cusid"]);

 $con->query("INSERT INTO `shippingAddress`(`id`, `address`, `address_naming`, `province_id`, `customer_id`) "
        . "VALUES (null,'$adds','$addnaming','$proid','$cusid')");

if ($con->error == "") {
    echo "ok";
} else {
    echo $cusid."errorrrrrrrrrrrr";
}