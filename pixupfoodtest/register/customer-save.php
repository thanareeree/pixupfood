<?php

include "../dbconn.php";


if (isset($_POST["cusemail"]) && $_POST["cusemail"] != "") {

    $fname = $con->real_escape_string($_POST["cusfname"]);
    $lname = $con->real_escape_string($_POST["cuslname"]);
    $phone = $con->real_escape_string($_POST["cusphone"]);
    $email = $con->real_escape_string($_POST["cusemail"]);
    $password = $con->real_escape_string($_POST["cuspwd"]);
    $available = $con->real_escape_string($_POST["available"]);


    $con->query("INSERT INTO `customer`(`id`, `firstName`, "
            . "`lastName`, `email`, `tel`, `available`, `created_time`, "
            . "`img_path`, `password`)  "
            . "VALUES "
            . "('null','$fname','$lname','$email',"
            . "'$phone','$available',now(),null,'$password')");

    if ($con->error == "") {
        $digits = 4;
        $otppwd = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

        $res = $con->query("select id from customer where email = '$email'");
        $data = $res->fetch_assoc();
        $id = $data['id'];

        $con->query("INSERT INTO `otp_password`(`id`, `password`, `tel`, `cusid`, `status`) "
                . "VALUES ('null','$otppwd','$phone','$id','0')");
        ?>

        <script>
            document.location = "../view/index.php";
        </script>

        <?php

    } else {
       
        echo $con->error;
    }
} else {
    echo json_encode(array(
        "result" => 0,
        "error" => "No Data Submited !"
    ));
}
?>
