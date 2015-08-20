<?php

include "../dbconn.php";


if (isset($_POST["resemail"]) && $_POST["resemail"] != "" ) {
   
    $fname = $con->real_escape_string($_POST["resname"]);
    $lname = $con->real_escape_string($_POST["reslname"]);
    $phone = $con->real_escape_string($_POST["resphone"]);
    $email = $con->real_escape_string($_POST["resemail"]);
    $password = $con->real_escape_string($_POST["respwd"]);
    $available= $con->real_escape_string($_POST["available"]);
   

    $con->query("INSERT INTO `restaurant`(`id`, `firstname`, `lastname`, `email`, "
            . "`tel`, `available`, `created_time`, `password`, `detail`, `x`, `y`, `img_path`, "
            . "`star`, `address`, `price_prepay`, `img_path_confirm`,"
            . " `serviceplan_id`, `zone_id`)"
            . "VALUES "
            . "('null','$fname','$lname','$email',"
            . "'$phone','$available',now(),'$password',null,null,null,null,null,null,null,null,'1','1')");

    if ($con->error == "") {
        echo 'success';
        
     
       
       
    } else {
        echo  $con->error ;
    }
} else {
    echo json_encode(array(
        "result" => 0,
        "error" => "No Data Submited !"
    ));
}

