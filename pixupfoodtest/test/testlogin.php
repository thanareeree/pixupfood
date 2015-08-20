<?php

session_start();

include '../dbconn.php';

$email = $_POST["email"];
$password = $_POST["password"];

$res = $con->query("select * from test where email='$email' and password='$password'");


if ($res->num_rows == 0) {
    echo "username password Invalid";
} else {
    $_SESSION["islogin"] = true;
    $_SESSION["userdata"] = $res->fetch_assoc();
    ?>

    <script>
        document.location = "main.php";
    </script>

    <?php
 
}
?>


