<?php
include './dbconn.php';


$res = $con->query("select delivery_date from normal_order where id = 66");
$data  = $res->fetch_assoc();
echo date('m',strtotime($data["delivery_date"]));