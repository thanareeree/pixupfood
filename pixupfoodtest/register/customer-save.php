<?php

include "../dbconn.php";
//include './thsms.php';


if (isset($_POST["cusemail"]) && $_POST["cusemail"] != "") {

    $fname = $con->real_escape_string($_POST["cusfname"]);
    $lname = $con->real_escape_string($_POST["cuslname"]);
    $phone = $con->real_escape_string($_POST["cusphone"]);
    $email = $con->real_escape_string($_POST["cusemail"]);
    $address = $con->real_escape_string($_POST["full"]);
    $password = $con->real_escape_string($_POST["cuspwd"]);
    $en_password = md5($password);
    
    $administrative_area_level_1 = $con->real_escape_string($_POST["administrative_area_level_1"]);
    $sublocality_level_1 = $con->real_escape_string($_POST["sublocality_level_1"]);
    $sublocality_level_2 = $con->real_escape_string($_POST["sublocality_level_2"]);
    $country = $con->real_escape_string($_POST["country"]);
    $locality = $con->real_escape_string($_POST["locality"]);
    $postal_code = $con->real_escape_string($_POST["postal_code"]);
    $route = $con->real_escape_string($_POST["route"]);
    $latitude = $con->real_escape_string($_POST["latitude"]);
    $longitude = $con->real_escape_string($_POST["longitude"]);


    $con->query("INSERT INTO `customer`(`id`, `firstName`, `lastName`,"
            . " `email`, `tel`, `address`, `available`, `created_time`, "
            . "`img_path`, `password`)  "
            . "VALUES "
            . "('null','$fname','$lname','$email',"
            . "'$phone','$address','0',now(),null,'$en_password')");


    if ($con->error == "") {
        $digits = 4;
        $otppwd = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $id = $con->insert_id;
        $con->query("INSERT INTO `shippingAddress`(`id`, `type`, `address_naming`, `full_address`,"
                . " `latitude`, `longitude`, `administrative_area_level_1`, `sublocality_level_1`,"
                . " `sublocality_level_2`, `country`, `locality`, `postal_code`, `route`, `customer_id`)"
                . " VALUES (null,'บ้าน','บ้าน','$address',"
                . "'$latitude','$longitude','$administrative_area_level_1','$sublocality_level_1',"
                . "'$sublocality_level_2','$country','$locality','$postal_code','$route','$id')");
        

        $con->query("INSERT INTO `otp_password`(`id`, `password`, `tel`, `cusid`, `status`, `created_time`) "
                . "VALUES ('null','$otppwd','$phone','$id','0', now())");

        $res2 = $con->query("SELECT * FROM `otp_password` WHERE cusid= '$id'");

        if ($res2->num_rows == 1) {
            $data2 = $res2->fetch_assoc();
            include './thsms.php';
            $sms = new thsms();
            $sms->username = 'thanaree';
            $sms->password = '58c60d';

            $b = $sms->send('0000', $data2["tel"], "Your Pixupfood OTP password is: " . $data2["password"] . "\nใช้รหัสได้ภายใน 30 นาที\n https://pixupfood.com");
            //var_dump( $b);
            echo json_encode(array(
                "result" => '1'
            ));
        } else {
            echo json_encode(array(
                "result" => '0',
                "error" => $con->error . "หาข้อมูล otp ไม่เจอ"
            ));
        }
    } else {
        echo json_encode(array(
            "result" => '0',
            "error" => $con->error . "testtttttt"
        ));
    }
} else {
    echo json_encode(array(
        "result" => '0',
        "error" => "No Data Submited !"
    ));
}
?>
