<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include '../../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$normalOrderRes = $con->query("SELECT normal_order.id as order_id, normal_order.order_time,delivery_date, "
        . "delivery_time, total_nofee,prepay, normal_order.status, normal_order.shippingAddress_id,"
        . " normal_order.customer_id , COUNT(order_detail.id) as foodlist, SUM(order_detail.quantity) as qty , "
        . "customer.firstName, customer.lastName, customer.tel, order_status.description, normal_order.updated_status_time "
        . "FROM `normal_order` "
        . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
        . "LEFT JOIN order_status ON order_status.id = normal_order.status"
        . " WHERE normal_order.restaurant_id = '$resid' and normal_order.status = 9 "
        . "GROUP BY normal_order.id "
        . "ORDER BY normal_order.order_time DESC");
$i = 1;



if ($normalOrderRes->num_rows == 0) {
    ?>
    <input type="hidden" id="normalordercount" value="0">
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>
    <?php
} else {
    while ($normalOrderData = $normalOrderRes->fetch_assoc()) {
       
        ?>
        <tr >
            <td><?= $i++; ?></td>
            <td><?= $normalOrderData["order_id"] ?></td>                         
            <td><?= $normalOrderData["firstName"] . '&nbsp;' . $normalOrderData["lastName"] ?></td>
            <td class="text-center"><?= $normalOrderData["foodlist"] ?></td>
            <td style="text-align: center"><?= $normalOrderData["qty"] ?></td>
            <td class="text-center"><?= substr($normalOrderData["updated_status_time"], 0, 11) ?>&nbsp;<?= substr($normalOrderData["updated_status_time"], 11, 5) ?>&nbsp;น.</td>
            <td style="text-align: center"><?= $normalOrderData["description"] ?></td>
            <td class="text-center">
                <button class="btn btn-info btn-xs normalOrderView" data-id="<?= $normalOrderData["order_id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
            <td class="text-center"></td>
           
        </tr>
        <?php
    }
}
