<?php

include '../dbconn.php';
$id = $_GET["id"];

$target_dir = "../upload/customer/";

$filename = @$_FILES["imgpro"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$newfliename = "img" . $id . "-" . uniqid() . $file_ext;
$target_file = $target_dir . $newfliename;
$path_img = substr($target_file, 2);


$fname = @$_POST["ecfname"];
$lname = @$_POST["eclname"];
$email = @$_POST["ecemail"];
$tel = @$_POST["ecphone"];
$address = @$_POST["ecadd"];







if (@$_FILES['imgpro']['name'] != "") {

    if (move_uploaded_file(@$_FILES["imgpro"]["tmp_name"], $target_file)) {
        $con->query("UPDATE `customer` SET `firstName`='$fname',`lastName`='$lname',"
                . "`email`='$email',`tel`='$tel',`address`='$address',"
                . "`img_path`='$path_img' WHERE id = '$id'");
        if ($con->error == "") {
            ?>
            <script>
                document.location = "/view/cus_customer_profile.php";
            </script>
            <?php

        } else {
            echo $con->error;
        }
    } else {
        echo 'อัพไม่ได้';
    }
} else {
    $con->query("UPDATE `customer` SET `firstName`='$fname',`lastName`='$lname',"
            . "`email`='$email',`tel`='$tel',`address`='$address' WHERE id = '$id'");
    if ($con->error == "") {
        ?>
        <script>
            document.location = "/view/cus_customer_profile.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
}





