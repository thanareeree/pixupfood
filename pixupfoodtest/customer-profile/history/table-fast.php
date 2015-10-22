<?php
session_start();
include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$orderRes = $con->query("SELECT fast_order.id as fast_id, order_status.description, order_status.id as status_id,"
        . " fast_order.quantity as qty, restaurant.name, fast_order.main_menu_id, fast_order.messenger_id, "
        . "fast_order.updated_status_time, fast_order.restaurant_id "
        . "FROM `fast_order` "
        . "LEFT JOIN order_status ON order_status.id = fast_order.status "
        . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
        . "WHERE fast_order.customer_id = '$cusid' "
        . "and fast_order.status = '9' "
        . "GROUP by fast_order.id ORDER BY fast_order.status ASC, fast_order.order_time DESC");


if ($orderRes->num_rows == 0) {
    ?>
    <tr>
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>                  
    </tr>
    <?php
} else {
    $i = 1;
    while ($orderData = $orderRes->fetch_assoc()) {

        $messid = $orderData["messenger_id"];
        $messengerNameRes = $con->query("select * from messenger where id = '$messid'");
        $messData = $messengerNameRes->fetch_assoc();
        $mesName = $messData["username"];
        ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $orderData["fast_id"] ?></td>    
            <td><?= $orderData["qty"] ?></td>
            <td><?= $orderData["name"] ?></td>
            <td><?= $orderData["updated_status_time"] ?></td>
            <td><?= $mesName ?></td>
            <td class="text-center">
                <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $orderData["fast_id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
             <td class="text-center">
                <button class="btn btn-success btn-xs fastReview" data-id="<?= $orderData["restaurant_id"] ?>" data-name="<?= $orderData["name"] ?>">
                    <span class="glyphicon glyphicon-edit"></span> 
                    รีวิว
                </button>
            </td>
        </tr>
        <?php
    }
}
?>

