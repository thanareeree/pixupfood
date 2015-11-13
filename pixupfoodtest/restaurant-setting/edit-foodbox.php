<?php

session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$foodbox = @$_POST["foodbox"];
$foodbox_id = "";

if (isset($foodbox)) {

    $con->query("DELETE FROM `mapping_food_box` WHERE restaurant_id = '$resid' ");


    foreach ($foodbox as $fb) {
        $foodbox_id = $fb;

        $con->query("INSERT INTO `mapping_food_box`(`restaurant_id`, `food_box_id`)"
                . " VALUES ('$resid','$foodbox_id')");
    }
}

if ($con->error == "") {
    ?>
    <script>
        document.location = "/view/res_manage_edit_order.php";
    </script>
    <?php

} else {

    echo $con->error;
}


