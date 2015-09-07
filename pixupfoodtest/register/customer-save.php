<?php

include "../dbconn.php";
//include './thsms.php';


if (isset($_POST["cusemail"]) && $_POST["cusemail"] != "") {

    $fname = $con->real_escape_string($_POST["cusfname"]);
    $lname = $con->real_escape_string($_POST["cuslname"]);
    $phone = $con->real_escape_string($_POST["cusphone"]);
    $email = $con->real_escape_string($_POST["cusemail"]);
    $address = $con->real_escape_string($_POST["cusaddress"]);
    $password = $con->real_escape_string($_POST["cuspwd"]);
    $en_password = md5($password);



    $con->query("INSERT INTO `customer`(`id`, `firstName`, `lastName`,"
            . " `email`, `tel`, `address`, `available`, `created_time`, "
            . "`img_path`, `password`)  "
            . "VALUES "
            . "('null','$fname','$lname','$email',"
            . "'$phone','$address','0',now(),null,'$en_password')");

    if ($con->error == "") {
        $digits = 4;
        $otppwd = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

        $res = $con->query("select id from customer where email = '$email'");
        $data = $res->fetch_assoc();
        $id = $data['id'];

        $con->query("INSERT INTO `otp_password`(`id`, `password`, `tel`, `cusid`, `status`, `created_time`) "
                . "VALUES ('null','$otppwd','$phone','$id','0', now())");

        $res2 = $con->query("SELECT * FROM `otp_password` WHERE cusid= '$id'");

        if ($res2->num_rows == 1) {
            $data2 = $res2->fetch_assoc();
            include './thsms.php';
            $sms = new thsms();
            $sms->username = 'thanaree';
            $sms->password = '58c60d';

            $b = $sms->send('0000', $data2["tel"], "Your Pixupfood OTP password is: " . $data2["password"] . "\n" . "รหัสนี้ใช้ได้ภายใน 7 วัน");
            //var_dump( $b);
            ?>
            <script>
                document.location = "../index.php";
            </script>

            <?php

        } else {
            echo $con->error . "หาข้อมูล otp ไม่เจอ";
        }
    } else {

        echo $con->error . "testtttttt";
    }
} else {
    echo "No Data Submited !";
}
?>
