<?php

include '../../dbconn.php';
session_start();
$cusid = $_SESSION["userdata"]["id"];
$order_id = $_POST["orderid"];

$time = $_POST["time"];
$bankname = $_POST["bankname"];
$type = "n1";
$d = $_POST["date"];
$date = date("Y-m-d", strtotime( $d));
$detail = $bankname."  "."วันที่ "." ".$date." ".$time."น.";

$target_dir = "../../upload/customer/slip-tranfer/";
$filename = @$_FILES["slip_path"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$newfliename =  "img".$cusid."-". uniqid().$file_ext;
$target_file = $target_dir . $newfliename;
$path_img = substr($target_file, 5);



if (isset($_SESSION["islogin"])) {
    if (move_uploaded_file(@$_FILES["slip_path"]["tmp_name"], $target_file)) {
        $con->query("INSERT INTO `transfer`(`id`, `order_id`, `customer_id`, `detail`, `slip_path`, `type`, `upload_time`)"
                . " VALUES (null,'$order_id','$cusid','$detail','$path_img','$type',now())");
         if ($con->error == "") {
        ?>
        <script>
            document.location = "/view/cus_customer_profile.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
    }else{
        echo 'อัพรูปไม่ได้';
    }
}