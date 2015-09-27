<?php

include '../dbconn.php';
$resid = $_POST["resIdvalue"];
$accountname = $con->real_escape_string(@$_POST["accountname"]);
$bankname = $con->real_escape_string(@$_POST["bankname"]);
$accountid = $con->real_escape_string(@$_POST["accountid"]);

$fomataccId = substr($accountid, 0, 3) . "-" . substr($accountid, 3, 6) . "-" . substr($accountid, -1);


$con->query("INSERT INTO `bank_account`(`id`, `accname`, `accNo`, `bank`, `restaurant_id`) "
        . "VALUES (null,'$accountname','$fomataccId','$bankname','$resid')");

if ($con->error == "") {
    echo json_encode(array(
        "result" => 1,
        "accname" => $accountname,
        "accid"=> $fomataccId,
        "bankname" => $bankname
    ));
} else {
    echo json_encode(array(
        "result" => 2,
        "error" => $con->error
    ));
} 


