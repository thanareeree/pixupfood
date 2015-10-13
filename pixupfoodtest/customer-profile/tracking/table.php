<?php

session_start();
include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$orderRes = $con->query(" SELECT DISTINCT normal_order.id as order_id, order_status.description, "
        . "restaurant.name, SUM(order_detail.quantity) as qty "
        . "FROM `normal_order` "
        . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "LEFT JOIN customer ON customer.id = normal_order.customer_id"
        . " LEFT JOIN order_status ON order_status.id = normal_order.status "
        . "LEFT JOIN restaurant ON restaurant.id = normal_order.restaurant_id "
        . "WHERE normal_order.customer_id = '$cusid' "
        . "and normal_order.status != '7' "
        . "GROUP BY normal_order.id ORDER BY normal_order.status ASC, normal_order.order_time DESC");

if ($orderRes->num_rows == 0) {
    ?>
    <tr>
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการสั่งซื้อ</h4></td></tr>                  
    </tr>
    <?php

} else {
    $i = 1;
    while ($orderData = $orderRes->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $i++;?></td>
            <td><?= $orderData["order_id"]?></td>    
            <td><?= $orderData["qty"]?></td>
            <td><?= $orderData["name"]?></td>
            <td><?= $orderData["description"]?></td>
            <td class="text-center">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target='#track' href="#track">
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
            <td class="text-center">
                <button class="btn btn-warning btn-xs" data-toggle="modal" data-target='#transf' href="#transf" disabled="disabled">
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    อัพโหลด
                </button>
            </td>
        </tr>
        <?php

    }
}
?>

