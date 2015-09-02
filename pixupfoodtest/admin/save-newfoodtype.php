<?php

include '../dbconn.php';
$name = $con->real_escape_string($_POST["newfoodtype"]);


$con->query("INSERT INTO `food_type`(`id`, `description`) VALUES ('null','$name')");

if ($con->error == "") {
    ?>
    <script>
        document.location = "../view/admin-restaurant-editmenu.php"
    </script>

    <?php

} else {
    echo "error";
}