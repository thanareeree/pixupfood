<?php

include '../dbconn.php';
$name = $con->real_escape_string($_POST["servicename"]);
$description = $con->real_escape_string($_POST["description"]);

$con->query("INSERT INTO `serviceplan`(`id`, `description`, `name`) "
        . "VALUES ('null','$description','$name')");

if ($con->error == "") {
    ?>
    <script>
        document.location = "/view/admin-restaurant-serviceplan.php"
    </script>

    <?php

} else {
    echo "error";
}