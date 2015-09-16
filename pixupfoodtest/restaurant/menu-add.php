<?php


include '../dbconn.php';

$target_dir = "../upload/restaurant/menu";
$target_file = $target_dir . basename(@$_FILES["imagesnewmenu"]["name"]);



$fname = $_POST["ecfname"];
$lname = $_POST["eclname"];
$email = $_POST["ecemail"];
$tel = $_POST["ecphone"];
$address = $_POST["ecadd"];

$resid = $_GET["id"];





if ($_FILES['imagesnewmenu']['name'] != "") {

    move_uploaded_file(@$_FILES["imagesnewmenu"]["tmp_name"], $target_file);
    $con->query(" ");
    if ($con->error == "") {
        //$res = $con->query("select * from customer where id= '$id'");
         //$_SESSION["userdata"] = $res->fetch_assoc();
        ?>
        <script>
            document.location = "../view/res_restaurant_manage_menulist.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
} else {
    $con->query("insert into");
    if ($con->error == "") {
        // $res = $con->query("select * from customer where id= '$id'");
         //$_SESSION["userdata"] = $res->fetch_assoc();
        ?>
        <script>
            document.location = "../view/res_restaurant_manage_menulist.php";
        </script>
        <?php

    } else {
        echo $con->error;
    }
}




