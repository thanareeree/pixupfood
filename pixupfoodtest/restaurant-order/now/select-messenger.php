<?php
session_start();
include '../../dbconn.php';

$messid = $_POST["messselect"];

$resid = $_SESSION["restdata"]["id"];

$orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, delivery_date, status "
        . "FROM normal_order "
        . "WHERE status = 5 AND restaurant_id = '$resid' and messenger_id = '$messid' "
        . "UNION "
        . "select concat('F') as orderType, id, delivery_date, status "
        . "FROM fast_order "
        . "WHERE status = 5 AND restaurant_id = '$resid' and messenger_id = '$messid'"
        . "ORDER BY delivery_date , id");



if ($orderNowAllRes->num_rows == 0) {
    ?>
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>
    <?php
} else {
    while ($orderIdAllData = $orderNowAllRes->fetch_assoc()) {
        $order_type = $orderIdAllData["orderType"];
        $orderIdAll = $orderIdAllData["id"];


        if ($order_type == 'F') {
            $fastOrderRes = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date,"
                    . "fast_order.delivery_time, order_status.description, order_status.id, fast_order.order_no, "
                    . "fast_order.shippingAddress_id,fast_order.customer_id ,quantity as qty , shippingAddress.full_address, "
                    . "customer.firstName, customer.lastName , fast_order.main_menu_id,"
                    . "request_fast_order.priority, fast_order.order_time,customer.tel, fast_order.messenger_id, "
                    . "restaurant.name, fast_order.updated_status_time, fast_order.status "
                    . "FROM `fast_order`LEFT JOIN order_status ON order_status.id = fast_order.status "
                    . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
                    . "LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
                    . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
                    . "LEFT JOIN shippingAddress ON shippingAddress.id = fast_order.shippingAddress_id "
                    . "WHERE fast_order.id = '$orderIdAll' ");
            while ($fastOrderData = $fastOrderRes->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $fastOrderData["order_no"] . $con->error ?></td>
                    <td><div style="width: 200px"><?= $fastOrderData["full_address"] ?></div></td>
                    <td class="text-center"><?= $fastOrderData["delivery_date"] ?>&nbsp;<?= substr($fastOrderData["delivery_time"], 0, 5) ?>&nbsp;น. </td>
                </tr>

                <?php
            }
        } else {
            $normalOrderRes = $con->query("SELECT normal_order.id as order_id, normal_order.order_time,delivery_date,"
                    . " delivery_time, total_nofee,prepay, normal_order.status, normal_order.shippingAddress_id, "
                    . "normal_order.customer_id , COUNT(order_detail.id) as foodlist, normal_order.order_no, "
                    . "SUM(order_detail.quantity) as qty , customer.firstName,customer.lastName, customer.tel, "
                    . "shippingAddress.full_address, order_status.description, normal_order.updated_status_time ,"
                    . " normal_order.messenger_id "
                    . "FROM `normal_order` "
                    . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                    . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
                    . "LEFT JOIN order_status ON order_status.id = normal_order.status "
                    . "LEFT JOIN shippingAddress ON shippingAddress.id = normal_order.shippingAddress_id "
                    . "WHERE normal_order.id = '$orderIdAll' "
                    . "GROUP BY normal_order.id ORDER BY normal_order.delivery_date , normal_order.id");

            while ($normalOrderData = $normalOrderRes->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $normalOrderData["order_no"] ?></td>
                    <td><div style="width: 200px"><?= $normalOrderData["full_address"] ?></div></td>
                    <td class="text-center"><?= $normalOrderData["delivery_date"] ?>&nbsp;<?= substr($normalOrderData["delivery_time"], 0, 5) ?>&nbsp;น. </td>

                </tr>

                <?php
            }
        }
    }
}


