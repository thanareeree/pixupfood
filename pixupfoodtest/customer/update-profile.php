<?php

include '../dbconn.php';

$target_dir = "../upload/customer/";
$target_file = $target_dir . basename(@$_FILES["imgpro"]["name"]);



$fname = $_POST["ecfname"];
$lname = $_POST["eclname"];
$email = $_POST["ecemail"];
$tel = $_POST["ecphone"];
$address = $_POST["ecadd"];

$id = $_GET["id"];





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





