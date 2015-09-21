<?php
include '../dbconn.php';
$cusid = $_GET["id"];
$id = $_POST["addid"];
$address = $con->real_escape_string($_POST["address"]);
$addtype = $_POST["addtype"];
$addnaming = $con->real_escape_string($_POST["addnaming"]);

if($address!="" && $addtype!="" && $addnaming !=""){
    $con->query("UPDATE `shippingAddress` SET `address`='$address',`type`='$addtype',"
            . "`address_naming`='$addnaming' WHERE id = '$id' and customer_id = '$cusid'");
    if ($con->error == "") {
        ?>
        <script>
            document.location = "../view/cus_customer_profile.php";
            $(".preloader").removeClass();
        </script>
        <?php

    } else {
        echo $con->error;
    }
}

