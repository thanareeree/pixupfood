<?php
include '../dbconn.php';

$target_dir = "../upload/customer/";

$filename = $_FILES["imgpro"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$newfliename =  "img".$id."-". uniqid().$file_ext;
$target_file = $target_dir . $newfliename;

$id = $_GET["id"];


if ($_FILES['imgpro']['name'] != "") {

    move_uploaded_file(@$_FILES["imgpro"]["tmp_name"], $target_file);
    $con->query("UPDATE `customer` SET `img_path`='$target_file' WHERE id = '$id'");
    if ($con->error == "") {
        //$res = $con->query("select * from customer where id= '$id'");
         //$_SESSION["userdata"] = $res->fetch_assoc();
        ?>
        <script>
            document.location = "../view/cus_customer_profile.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
} else {
        echo $con->error;
    
}





