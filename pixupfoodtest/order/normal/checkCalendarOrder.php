<?php

include '../../dbconn.php';
$resid = @$_POST["resid"];

$orderNowAllRes = $con->query("SELECT concat('N') as orderType, normal_order.id,delivery_date,"
        . " SUM(order_detail.quantity) as qty FROM `normal_order` "
        . "JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "WHERE normal_order.restaurant_id = '16' AND normal_order.status > 1 AND normal_order.status < 6 "
        . "GROUP BY normal_order.delivery_date ");


$qtyAll = 0;
while ($orderIdAllData = $orderNowAllRes->fetch_assoc()) {
    $order_type = $orderIdAllData["orderType"];
    $qtyNormal = $orderIdAllData["qty"];
    $dateNormal = $orderIdAllData["delivery_date"];
    

    $res = $con->query("select concat('F') as orderType, id, delivery_date, SUM(quantity) as qty "
            . "FROM fast_order WHERE status < 6 AND status > 1 AND restaurant_id = '16' "
            . "GROUP BY delivery_date ORDER BY delivery_date , id");
    
    while ($fastData = $res->fetch_assoc()){
        $delidate = $fastData["delivery_date"];
        $qtyFast = $fastData["qty"];
        $order_type = $fastData["orderType"];
        
        if($delidate == $dateNormal){
            $qtyAll = $qtyNormal + $qtyFast;
            echo $dateNormal." ".$qtyAll."--------------";
          // break;
        }else if($order_type == 'N'){
            echo $dateNormal." ".$qtyNormal."///////////";
            //break;
        }else if($order_type == 'F'){
             echo $delidate." ".$qtyFast."************";
           // break;
        }
        
        
    }
 
}