<?php

include "../dbconn.php";

//print_r($_POST);

if (isset($_POST["resemail"]) && $_POST["resemail"] != "") {

    $fname = $con->real_escape_string($_POST["resfname"]);
    $lname = $con->real_escape_string($_POST["reslname"]);
    $phone = $con->real_escape_string($_POST["resphone"]);
    $email = $con->real_escape_string($_POST["resemail"]);
    $password = $con->real_escape_string($_POST["respassword"]);
    $resname = $con->real_escape_string($_POST["restaurantname"]);
    $detail = $con->real_escape_string($_POST["detail"]);

    $planid = $con->real_escape_string($_POST["planlist"]);
    $en_password = md5($password);

    $resaddress = $con->real_escape_string($_POST["full"]);
    $administrative_area_level_1 = $con->real_escape_string($_POST["administrative_area_level_1"]);
    $sublocality_level_1 = $con->real_escape_string($_POST["sublocality_level_1"]);
    $sublocality_level_2 = $con->real_escape_string($_POST["sublocality_level_2"]);
    $country = $con->real_escape_string($_POST["country"]);
    $locality = $con->real_escape_string($_POST["locality"]);
    $postal_code = $con->real_escape_string($_POST["postal_code"]);
    $route = $con->real_escape_string($_POST["route"]);


    $latitude = $con->real_escape_string($_POST["latitude"]);
    $longitude = $con->real_escape_string($_POST["longitude"]);


    $con->query("INSERT INTO `restaurant`(`id`, `name`, `firstname`, `lastname`, `email`,"
            . " `tel`, `available`, `created_time`, `password`, `detail`, `x`, `y`, "
            . "`img_path`, `star`, `address`, `opentime`, `amount_box_minimum`, "
            . "`amount_box_limit`, `prepay`, `img_path_confirm`, `serviceplan_id`,"
            . " `zone_id`, `province`, `block`, `type`, `close`, `has_restaurant`, "
            . "`restaurant_type`, `level`, `administrative_area_level_1`, "
            . "`sublocality_level_1`, `sublocality_level_2`, `country`, `locality`, "
            . "`postal_code`, `route`) "
            . "VALUES (null,'$resname','$fname','$lname','$email',"
            . "'$phone','0',now(),'$en_password','$detail','$latitude','$longitude',"
            . "null,null,'$resaddress',null,null,"
            . "null,null,null,'$planid',"
            . "null,'$locality','0','1','0',null,"
            . "null,'น้อย','$administrative_area_level_1',"
            . "'$sublocality_level_1','$sublocality_level_2','$country','$locality',"
            . "'$postal_code','$route')");


    if ($con->error == "") {
       
        $id = $con->insert_id;

        echo json_encode(array(
            "result" => '1',
            "id" => $id
        ));
    } else {
        echo json_encode(array(
            "result" => '0',
            "error" => $con->error
        ));
    }
} else {
    echo json_encode(array(
        "result" => 0,
        "error" => "No Data Submited !"
    ));
 
}
