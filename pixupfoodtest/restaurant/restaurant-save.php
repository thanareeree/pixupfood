<?php

include "../dbconn.php";


if (isset($_POST["resemail"]) && $_POST["resemail"] != "") {

    $fname = $con->real_escape_string($_POST["resfname"]);
    $lname = $con->real_escape_string($_POST["reslname"]);
    $phone = $con->real_escape_string($_POST["resphone"]);
    $email = $con->real_escape_string($_POST["resemail"]);
    $password = $con->real_escape_string($_POST["respassword"]);
    $resname = $con->real_escape_string($_POST["restaurantname"]);
    $detail = $con->real_escape_string($_POST["detail"]);
    $lat = $con->real_escape_string($_POST["latinput"]);
    $long = $con->real_escape_string($_POST["longinput"]);
    $resaddress = $con->real_escape_string($_POST["resaddress"]);
    $prolist = $con->real_escape_string($_POST["provincelist"]);
    $zoneid = $con->real_escape_string($_POST["zonelist"]);
    $planid = $con->real_escape_string($_POST["planlist"]);
    $en_password = md5($password);


    $con->query("INSERT INTO `restaurant`(`id`, `name`, `firstname`, `lastname`, `email`, `tel`, `available`, "
            . "`created_time`, `password`, `detail`, `x`, `y`, `img_path`, `address`, `opentime`, "
            . "`price_prepay`, `amount_box_limit`, `img_path_confirm`, `serviceplan_id`, `zone_id`, "
            . "`province`,`has_restaurant`, `restaurant_type`) "
            . "VALUES (null,'$resname','$fname','$lname','$email','$phone','0',"
            . "now(),'$en_password','$detail','$lat','$long',null,'$resaddress',null,"
            . "null,null,null,'$planid','$zoneid',"
            . "'$prolist',null,null)");
    
    
    if ($con->error == "") {
        $res = $con->query("select id from restaurant where email = '$email'");
        $data = $res->fetch_assoc();
        $id = $data['id'];
        
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

