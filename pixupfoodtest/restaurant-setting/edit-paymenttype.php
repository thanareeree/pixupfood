<?php
session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$paytype = @$_POST["paymentData"];
$payid = "";

//print_r($_POST);
 $con->query("DELETE FROM `mapping_payment_type` WHERE restaurant_id = '$resid' ");
  
foreach ($paytype as $fb) {
    $payid = $fb;
    
    $con->query("INSERT INTO `mapping_payment_type`(`restaurant_id`, `payment_type_id`)"
            . " VALUES ('$resid','$payid')");
}
if ($con->error == "") {
    ?>
    <script>
        document.location = "/view/res_manage_edit_payment.php";
    </script>
    <?php

} else {
    echo $con->error;

}


