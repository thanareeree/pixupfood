<?php

include '../dbconn.php';
$cusid = @$_POST["cusid"];

$address = $con->real_escape_string(@$_POST["address"]);
$addtype = @$_POST["addtype"];
$addnaming = $con->real_escape_string(@$_POST["addnaming"]);

if ($address != "" && $addtype != "" && $addnaming != "") {
    $con->query("INSERT INTO `shippingAddress`(`id`, `address`, `type`, `address_naming`, `customer_id`)"
            . " VALUES ('null','$address','$addtype','$addnaming','$cusid')");
    $shipid = $con->insert_id;
    $shipRes = $con->query("SELECT CONCAT(shippingAddress.address,' ประเภท',shippingAddress.type,'(', shippingAddress.address_naming,')') AS ship_address, "
            . "shippingAddress.id,shippingAddress.address  "
            . "FROM `shippingAddress` WHERE id = '$shipid' ");
    $shipData = $shipRes->fetch_assoc();
    if($shipData["ship_address"]==""){
        $addship = $shipData["ship_address"];
    }  else {
        $addship = $shipData["address"];
    }
    
    
    if ($con->error == "") {
         echo json_encode(array(
            "result" => 1,
            "address" => $addship
        ));
    } else {
         echo json_encode(array(
            "result" => 0,
            "reason" => $con->error
        ));
    }
}
