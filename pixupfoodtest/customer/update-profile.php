<?php

include '../dbconn.php';
$sourcePath = $_FILES['imgpro']['tmp_name']; 
$targetPath = "../upload/customer-upload/".$_FILES['imgpro']['name'];
move_uploaded_file($sourcePath,$targetPath) ;

$fname = $con->real_escape_string($_POST["cusefname"]);
$lname = $con->real_escape_string($_POST["cuselname"]);
$email = $con->real_escape_string($_POST["cuseemail"]);
$tel = $con->real_escape_string($_POST["cusephone"]);
$id = $_POST["cusidupdate"];

$con->query("UPDATE `customer` SET `firstName`='fname',`lastName`='$lname',"
        . "`email`='$email',`tel`='$tel',`img_path`='$sourcePath' WHERE '$id'");

if ($con->error == "") {
    echo $sourcePath.$fname.$lname.$email.$tel.$id;
} else {
    echo "ok";
}




