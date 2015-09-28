<?php

session_start();
include '../../dbconn.php';
$response = array("result" => 0);
if (isset($_SESSION["islogin"])) {
    $cmd = @$_POST["cmd"];
    $user_id = $_SESSION["userdata"]["id"];
    if ($cmd == "getAddress") {
        $responsein = array();
        $res = $con->query("SELECT * FROM shippingAddress WHERE customer_id = '$user_id'");
        if ($res->num_rows > 0) {
            while ($data = $res->fetch_assoc()) {
                array_push($responsein, $data);
            }
        }
        $response = array(
            "result" => 1,
            "data" => $responsein
        );
    } else if ($cmd == "addAddress") {
        $administrative_area_level_1 = $con->real_escape_string($_POST["administrative_area_level_1"]);
        $sublocality_level_1 = $con->real_escape_string($_POST["sublocality_level_1"]);
        $sublocality_level_2 = $con->real_escape_string($_POST["sublocality_level_2"]);
        $full = $con->real_escape_string($_POST["full"]);
        $country = $con->real_escape_string($_POST["country"]);
        $locality = $con->real_escape_string($_POST["locality"]);
        $postal_code = $con->real_escape_string($_POST["postal_code"]);
        $route = $con->real_escape_string($_POST["route"]);
        $type = $con->real_escape_string($_POST["type"]);
        $address_naming = $con->real_escape_string($_POST["address_naming"]);
        $latitude = $con->real_escape_string($_POST["latitude"]);
        $longitude = $con->real_escape_string($_POST["longitude"]);
        $res = $con->query("INSERT INTO `shippingAddress`(`id`, `type`, `address_naming`, `full_address`, `administrative_area_level_1`, "
                . "`sublocality_level_1`, sublocality_level_2, `country`, `locality`, `postal_code`, `route`, `customer_id`, latitude, longitude)"
                . " VALUES (null,'$type','$address_naming','$full','$administrative_area_level_1',"
                . "'$sublocality_level_1','$sublocality_level_2','$country','$locality','$postal_code','$route','$user_id', '$latitude','$longitude')");
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
    } else if ($cmd == "getDetail") {
        $id = $con->real_escape_string($_POST["id"]);
        $res = $con->query("SELECT * FROM shippingAddress WHERE id = '$id'");
        $data = $res->fetch_assoc();
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
        if ($res->num_rows > 0) {
            $response = array(
                "result" => 1,
                "data" => $data,
                "nearby" => $neardata
            );
        }
    } else if ($cmd == "getNearBy") {
        $lat = $_POST["x"];
        $lng = $_POST["y"];
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
        $response = array(
            "result" => 1,
            "nearby" => $neardata
        );
    }
}
echo json_encode($response);
