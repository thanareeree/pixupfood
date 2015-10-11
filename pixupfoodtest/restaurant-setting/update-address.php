<?php
session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$administrative_area_level_1 = $con->real_escape_string($_POST["administrative_area_level_1"]);
$sublocality_level_1 = $con->real_escape_string($_POST["sublocality_level_1"]);
$sublocality_level_2 = $con->real_escape_string($_POST["sublocality_level_2"]);
$full = $con->real_escape_string($_POST["full"]);
$country = $con->real_escape_string($_POST["country"]);
$locality = $con->real_escape_string($_POST["locality"]);
$postal_code = $con->real_escape_string($_POST["postal_code"]);
$route = $con->real_escape_string($_POST["route"]);


$latitude = $con->real_escape_string($_POST["latitude"]);
$longitude = $con->real_escape_string($_POST["longitude"]);


$con->query("UPDATE `restaurant` SET `x`='$latitude',`y`='$longitude',"
        . "`address`='$full',`province`='$locality',`administrative_area_level_1`='$administrative_area_level_1',"
        . "`sublocality_level_1`='$sublocality_level_1',`sublocality_level_2`='$sublocality_level_2',"
        . "`country`='$country',"
        . "`locality`='$locality',`postal_code`='$postal_code',`route`='$route'"
        . " WHERE id = '$resid'");

if ($con->error == "") {
    $response = array(
        "result" => 1,
        "id" => $con->insert_id
    );
} else {
    $response = array(
        "result" => 0,
        "reason" => $con->error
    );
}
echo json_encode($response);