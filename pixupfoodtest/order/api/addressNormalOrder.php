<?php

session_start();
include '../../dbconn.php';
$response = array("result" => 0);
if (isset($_SESSION["islogin"])) {
    $cmd = @$_POST["cmd"];
    $user_id = $_SESSION["userdata"]["id"];

    if ($cmd == "getDetail") {
        $id = $con->real_escape_string($_POST["id"]);
        $resid = $_POST["resid"];
        $res = $con->query("SELECT * FROM shippingAddress WHERE id = '$id'");
        $data = $res->fetch_assoc();
        $postcode = $data["postal_code"];
        $name = $data["sublocality_level_1"];


        $lat = $data["latitude"];
        $lng = $data["longitude"];
        $findDistanct = $con->query("SELECT 
                    id,name,detail,x,y,
                     ( 6371 * acos( cos( radians('$lat') ) * cos( radians( restaurant.x ) ) 
                     * cos( radians(restaurant.y) - radians('$lng')) + sin(radians('$lat')) 
                     * sin( radians(restaurant.x)))) AS distance 
                  FROM restaurant 
                  ORDER BY distance"
                . " LIMIT 10");
        $neardata = array();
        while ($near = $findDistanct->fetch_assoc()) {
            array_push($neardata, $near);
        }

        $postcodeRes = $con->query("SELECT data_postcode.postcode , data_district.district_name "
                . "FROM delivery_place "
                . "LEFT JOIN data_postcode ON data_postcode.district_ID = delivery_place.district_id "
                . "LEFT JOIN data_district ON data_district.district_id = delivery_place.district_id "
                . "WHERE delivery_place.restaurant_id = '$resid' "
                . "AND data_postcode.postcode = '$postcode' "
                . "GROUP BY data_postcode.postcode");

        if ($res->num_rows > 0 && $postcodeRes->num_rows == 0) {
            $response = array(
                "result" => 1,
                "data" => $data,
                "nearby" => $neardata,
                  "districtName" => $name
            );
        } else if ($res->num_rows > 0 ) {
            $response = array(
                "result" => 2,
                "data" => $data,
                "nearby" => $neardata
            );
        }
    }
}
echo json_encode($response);

