<?php

session_start();

include '../dbconn.php';

$email = 'peepo@gmail.com';
$pwd = '1234';
$password = substr(md5($pwd),0,20);
//echo $password;

$sql ="select * from test where email='$email' and password = '$password'";

$res = $con->query($sql);


if ($res->num_rows==0) {
    echo gettype($res);
    echo $password;
    echo $res->num_rows;
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


