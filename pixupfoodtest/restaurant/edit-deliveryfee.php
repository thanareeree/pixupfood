<?php

include '../dbconn.php';

$deliveryfee = $_POST["deliveryfee"];
$resid = $_GET["resId"];

$con->query("INSERT INTO `mapping_delivery_type`(`restaurant_id`, `delivery_type_id`, `deliveryfee`)"
        . " VALUES ('$resid','1','$deliveryfee')");


if ($con->error == "") {
    ?>
    <script>
        document.location = "/view/res_manage_edit_order.php";
    </script>
    <?php

} else {
    echo $con->error;
}

