<?php
include '../dbconn.php';

$menuid = $con->real_escape_string(@$_POST["menuid"]);
$riceid = $con->real_escape_string(@$_POST["riceid"]);
$singleid = $con->real_escape_string(@$_POST["singleid"]);
$menusetid = $con->real_escape_string(@$_POST["menusetid"]);
$price = $con->real_escape_string(@$_POST["price"]);
$resid = $con->real_escape_string(@$_POST["resid"]);

$response = array(
    "result" => 0,
    "reason"=>"กรุณาใส่ข้อมูล"
);

if($menuid != "0"){
    $con->query("INSERT INTO `menu`(`id`, `price`, `img_path`, "
            . " `main_menu_id`, `restaurant_id`)"
            . " VALUES (null,'$price',null,'$menuid','$resid')");
    if($con->error==""){
         $response = array(
            "result" => 1
        );
        
    }else{
        $response = array(
        "result" => 0,
        "reason" => $con->error
    );
    }
    
    
   
}else if ($riceid != "0") {
    echo '1';
}else if ($riceid != "0") {
    echo '2';
}else if ($riceid != "0") {
    echo '3';
}else if ($riceid != "0") {
    echo '4';
}  else {
    echo '11221';
}
echo json_encode($response);
?>

