<?php

include '../dbconn.php';

$id = $_POST["id"];
$res = $con->query("select block from customer where id = $id");
$data  = $res->fetch_assoc();
if($data["block"]==0){
    $con->query("UPDATE `customer` SET `block`= 1 WHERE id = '$id'");
  
}else if($data["block"]==1){
    $con->query("UPDATE `customer` SET `block`= 0 WHERE id = '$id'");    
}

if($con->error==""){
    echo "ok";
}else{
    echo "error";
}

