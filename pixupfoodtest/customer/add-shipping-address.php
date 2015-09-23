<?php
include '../dbconn.php';
$cusid = $_GET["id"];

$address = $con->real_escape_string($_POST["address"]);
$addtype = $_POST["addtype"];
$addnaming = $con->real_escape_string($_POST["addnaming"]);

if($address!="" && $addtype!="" && $addnaming !=""){
    $con->query("INSERT INTO `shippingAddress`(`id`, `address`, `type`, `address_naming`, `customer_id`)"
            . " VALUES ('null','$address','$addtype','$addnaming','$cusid')");
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

