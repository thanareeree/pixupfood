<?php

include '../dbconn.php';

$name = $_POST["name"];
$lname = $_POST["lname"];
$dob = $_POST["dob"];
$gender = $_POST["gender"];
$email = $_POST["email"];
$password = $_POST["password"];
$resid = $_POST["resid"];

$con->query("INSERT INTO `test`(`register_id`, `name`, `lname`, `dob`,gender, `regis_time`, `email`, `password`,res_id) "
        . "VALUES (null,'$name','$lname','$dob','$gender',now(),'$email','$password','$resid')");

if($con->error==""){
    echo "saved"; 
    ?>
<br>

<a href="testform.php" >back</a>


<?php
}  else {
    echo "error: ".$con->error;
}