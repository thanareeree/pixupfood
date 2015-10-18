<?php
session_start();

include '../dbconn.php';
$username = $_POST["loginemail"];
$password = $_POST["password"];

$res = $con->query("select * from messenger where username='$username' and password='$password'");


if ($res->num_rows == 0 && $res2->num_rows == 0) {
    $response = array(
        "result" => 0,
        "reason" => "Username or Password not Found !"
    );
} else {
    $_SESSION["islogin"] = true;
    $_SESSION["messengerdata"] = $res->fetch_assoc();
    
    ?>
<script>
    document.location = "/view/messenger_order.php";
</script>
<?php
}
