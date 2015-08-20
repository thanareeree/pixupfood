<?php

session_start();

include '../dbconn.php';

$email = $_POST["email"];
$password = $_POST["password"];

$res = $con->query("select * from customer where email='$email' and password='$password'");


if ($res->num_rows == 0) {
    echo "username password Invalid";
} else {
    $_SESSION["islogin"] = true;
    $_SESSION["userdata"] = $res->fetch_assoc();
    
    
    
    
    
    
    ?>

  <!--  <script>
        document.location = "../test/main.php";
    </script> -->

    <?php

}
?>
