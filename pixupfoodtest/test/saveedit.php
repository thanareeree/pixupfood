<?php

include '../dbconn.php';

$name = $_POST["name"];
$lname = $_POST["lname"];
$dob = $_POST["dob"];
$gender = $_POST["gender"];
$email = $_POST["email"];
$password = $_POST["password"];
$resid = $_POST["resid"];
$id = $_POST["registerid"];


$con->query(" UPDATE `test` SET `name`='$name',`lname`='$lname',"
        . "`dob`='$dob',`gender`='$gender',`email`='$email',"
        . "`password`='$password',`res_id`='$resid' WHERE register_id=$id");

if($con->error==""){
    echo "saved"; 
    ?>
<br>

<a href="showAll.php" >back</a>


<?php
}  else {
    echo "error: ".$con->error;
}