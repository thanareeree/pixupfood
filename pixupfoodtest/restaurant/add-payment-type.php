<?php

include '../dbconn.php';
$resid = @$_GET["resId"];
$paytype = @$_POST["paymentData"];
$payid = "";
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
    ?>
}
    <script>
        document.location = "/view/res_manage_edit_payment.php";
        alert($con->error);
    </script>
    <?php
}


