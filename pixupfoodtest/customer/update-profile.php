<?php

include '../dbconn.php';
$id = $_GET["id"];

$target_dir = "../upload/customer/";

$filename = $_FILES["imgpro"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$newfliename =  "img".$id."-". uniqid().$file_ext;
$target_file = $target_dir . $newfliename;



$fname = @$_POST["ecfname"];
$lname = @$_POST["eclname"];
$email = @$_POST["ecemail"];
$tel = @$_POST["ecphone"];
$address = @$_POST["ecadd"];







if ($_FILES['imgpro']['name'] != "") {

    move_uploaded_file(@$_FILES["imgpro"]["tmp_name"], $target_file);
    $con->query("UPDATE `customer` SET `firstName`='$fname',`lastName`='$lname',"
            . "`email`='$email',`tel`='$tel',`address`='$address',"
            . "`img_path`='$target_file' WHERE id = '$id'");
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
    $con->query("UPDATE `customer` SET `firstName`='$fname',`lastName`='$lname',"
            . "`email`='$email',`tel`='$tel',`address`='$address' WHERE id = '$id'");
    if ($con->error == "") {
        // $res = $con->query("select * from customer where id= '$id'");
         //$_SESSION["userdata"] = $res->fetch_assoc();
        ?>
        <script>
            document.location = "../view/cus_customer_profile.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
}





