<?php
session_start();
include '../dbconn.php';

$resid = $_SESSION["restdata"]["id"]; 
$detail = $_POST["newsdetail"];
$title = $_POST["title"];

$target_dir = "../upload/restaurant/news/";

$filename = @$_FILES["imagerest"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$newfliename = "img-menu-" . uniqid() . $file_ext;
$target_file = $target_dir . $newfliename;
$path_img = substr($target_file, 2);

if (isset($_SESSION["islogin"])) {
    if( move_uploaded_file(@$_FILES["imagerest"]["tmp_name"], $target_file)){
        $con->query("INSERT INTO `news`(`id`, `created_time`, `title`, `img_path`,`detail`, `availble`, `restaurant_id`) "
                . "VALUES (null,now(),'$title','$path_img','$detail','0','$resid')");
        
         if ($con->error == "") {
            ?>
            <script>
                document.location = "/view/res_restaurant_manage_today.php";
            </script>
            <?php

        } else {
            echo $con->error;
        }
    }
}