<?php

session_start();

include '../dbconn.php';

$email = $_POST["loginemail"];
$password = $_POST["password"];

$res = $con->query("select * from customer where email='$email' and password='$password'");
//$data = $res->fetch_assoc(); 

if ($res->num_rows == 0) {
    echo "username password Invalid";
} else {
    $_SESSION["islogin"] = true;
    $_SESSION["userdata"] = $res->fetch_assoc();

    if ($_SESSION["userdata"]["available"] == 0) {
        ?>

        <script>
            document.location = "../view/customer-otpform.php";
        </script>


        <?php

    }
    ?>

    <script>
        document.location = "../view/cus_customer_profile.php";
    </script>

    <?php

}
?>

