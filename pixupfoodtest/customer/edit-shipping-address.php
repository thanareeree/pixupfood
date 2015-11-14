<?php
session_start();
include '../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];

$id = $_POST["id"];
$address = $con->real_escape_string($_POST["full"]);
$addtype = $_POST["addtype"];
$addnaming = $con->real_escape_string($_POST["addnaming"]);


$administrative_area_level_1 = $con->real_escape_string($_POST["administrative_area_level_1"]);
$sublocality_level_1 = $con->real_escape_string($_POST["sublocality_level_1"]);
$sublocality_level_2 = $con->real_escape_string($_POST["sublocality_level_2"]);
$country = $con->real_escape_string($_POST["country"]);
$locality = $con->real_escape_string($_POST["locality"]);
$postal_code = $con->real_escape_string($_POST["postal_code"]);
$route = $con->real_escape_string($_POST["route"]);
$latitude = $con->real_escape_string($_POST["latitude"]);
$longitude = $con->real_escape_string($_POST["longitude"]);


if ($address != "" && $addtype != "" && $addnaming != "") {
    $con->query("UPDATE `shippingAddress` SET `type`='$addtype',"
            . "`address_naming`= '$addnaming',`full_address`= '$address',`latitude`='$latitude',"
            . "`longitude`='$longitude',`administrative_area_level_1`='$administrative_area_level_1',"
            . "`sublocality_level_1`='$sublocality_level_1',`sublocality_level_2`='$sublocality_level_2',"
            . "`country`='$country',`locality`='$locality',`postal_code`='$postal_code',"
            . "`route`='$route' "
            . "WHERE id = '$id'");
    if ($con->error == "") {
         echo json_encode(array(
                "result" => '1'
            ));

    } else {
        echo json_encode(array(
            "result" => '0',
            "error" => $con->error . "testtttttt"
        ));
    }
}

