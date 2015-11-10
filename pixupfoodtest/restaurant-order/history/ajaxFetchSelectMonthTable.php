<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include '../../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$month = $_POST["month"];


$orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, updated_status_time, status "
        . "FROM normal_order "
        . "WHERE status = 9 AND restaurant_id = '$resid' "
        . "UNION "
        . "select concat('F') as orderType, id, updated_status_time, status "
        . "FROM fast_order WHERE status = 9 AND restaurant_id = '$resid' "
        . "ORDER BY updated_status_time DESC, id");


if ($orderNowAllRes->num_rows == 0) {
    ?>
    <input type="hidden" id="fastordercount" value="0">
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>
    <?php
} else {
   
        while ($orderIdAllData = $orderNowAllRes->fetch_assoc()) {
            $order_type = $orderIdAllData["orderType"];
            $orderIdAll = $orderIdAllData["id"];
            $order_update = substr($orderIdAllData["updated_status_time"], 5, 2);
            if($order_update == $month){
                include '../history/sqlSelectMonth.php';
            }
        }
  
}
