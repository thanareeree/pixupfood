<?php
include '../../dbconn.php';
$cusid = $_POST["cusid"];
$resid = $_POST["resid"];
$shippingid = $_POST["shippingid"];

$res = $con->query("SELECT shippingAddress.postal_code, shippingAddress.sublocality_level_1 FROM `shippingAddress` WHERE id = '$shippingid'");
$data = $res->fetch_assoc();
$code = $data["postal_code"];
$name = $data["sublocality_level_1"];

$postcodeRes = $con->query("SELECT data_postcode.postcode , data_district.district_name"
        . "FROM delivery_place "
        . "LEFT JOIN data_postcode ON data_postcode.district_ID = delivery_place.district_id "
        . "LEFT JOIN data_district ON data_district.district_id = delivery_place.district_id"
        . "WHERE data_postcode.postcode = '$code' GROUP BY data_postcode.postcode");

if ($postcodeRes->num_rows == 0) {
    $response = array(
        "result" => 0,
        "name" => $name,
            "error" => "SELECT data_postcode.postcode , data_district.district_name"
        . "FROM delivery_place "
        . "LEFT JOIN data_postcode ON data_postcode.district_ID = delivery_place.district_id "
        . "LEFT JOIN data_district ON data_district.district_id = delivery_place.district_id"
        . "WHERE data_postcode.postcode = '$code' GROUP BY data_postcode.postcode"
    );
}  else {
    $response = array(
        "result" => 1,
        "error" => "เจออออออออออ"
    );
}

echo json_encode($response);
