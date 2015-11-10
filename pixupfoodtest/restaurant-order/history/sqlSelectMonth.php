<?php
if ($order_type == 'F') {

    $fastOrderRes = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date, "
            . "fast_order.delivery_time, order_status.description, order_status.id, fast_order.shippingAddress_id,"
            . " fast_order.customer_id , quantity as qty , customer.firstName, customer.lastName , "
            . "fast_order.main_menu_id, request_fast_order.priority, fast_order.order_time,customer.tel,"
            . " restaurant.name, fast_order.updated_status_time, fast_order.messenger_id, fast_order.order_no "
            . "FROM `fast_order` "
            . "LEFT JOIN order_status ON order_status.id = fast_order.status "
            . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
            . "LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
            . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
            . "WHERE fast_order.id = '$orderIdAll'"
            . "GROUP by fast_order.id "
            . "ORDER BY fast_order.order_time DESC");
    while ($fastOrderData = $fastOrderRes->fetch_assoc()) {
        ?>
        <tr>

            <td><?= $fastOrderData["order_no"] ?></td>                         
            <td><?= $fastOrderData["firstName"] . '&nbsp;' . $fastOrderData["lastName"] ?></td>
            <td class="text-center">1</td>
            <td style="text-align: center"><?= $fastOrderData["qty"] ?></td>
            <td class="text-center"><?= substr($fastOrderData["updated_status_time"], 0, 11) ?>&nbsp;<?= substr($fastOrderData["updated_status_time"], 11, 5) ?>&nbsp;น. </td>
            <td class="text-center"> 
                <?php
                $messid = $fastOrderData["messenger_id"];
                $messengerNameRes = $con->query("select * from messenger where id = '$messid'");
                $messData = $messengerNameRes->fetch_assoc();
                echo $messData["username"];
                ?>
            </td>
            <td style="text-align: center"><?= $fastOrderData["description"] ?></td>
            <td class="text-center">
                <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $fastOrderData["fast_id"] ?>" data-no="<?= $fastOrderData["order_no"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>

        </tr>
        <?php
    }
} else {
    $normalOrderRes = $con->query("SELECT normal_order.id as order_id, normal_order.order_time,delivery_date, "
            . "delivery_time, total_nofee,prepay, normal_order.status, normal_order.shippingAddress_id,"
            . " normal_order.customer_id , COUNT(order_detail.id) as foodlist, SUM(order_detail.quantity) as qty , "
            . "customer.firstName, customer.lastName, customer.tel, order_status.description, normal_order.updated_status_time,"
            . "normal_order.messenger_id, normal_order.order_no  "
            . "FROM `normal_order` "
            . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
            . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
            . "LEFT JOIN order_status ON order_status.id = normal_order.status"
            . " WHERE normal_order.id = '$orderIdAll'  "
            . "GROUP BY normal_order.id "
            . "ORDER BY normal_order.order_time DESC");
    while ($normalOrderData = $normalOrderRes->fetch_assoc()) {
        ?>
        <tr >

            <td><?= $normalOrderData["order_no"] ?></td>                         
            <td><?= $normalOrderData["firstName"] . '&nbsp;' . $normalOrderData["lastName"] ?></td>
            <td class="text-center"><?= $normalOrderData["foodlist"] ?></td>
            <td style="text-align: center"><?= $normalOrderData["qty"] ?></td>
            <td class="text-center"><?= substr($normalOrderData["updated_status_time"], 0, 11) ?>&nbsp;<?= substr($normalOrderData["updated_status_time"], 11, 5) ?>&nbsp;น.</td>
            <td class="text-center"> 
                <?php
                $messid = $normalOrderData["messenger_id"];
                $messengerNameRes = $con->query("select * from messenger where id = '$messid'");
                $messData = $messengerNameRes->fetch_assoc();
                echo $messData["username"];
                ?>
            </td>
            <td style="text-align: center"><?= $normalOrderData["description"] ?></td>
            <td class="text-center">
                <button class="btn btn-info btn-xs normalOrderView" data-id="<?= $normalOrderData["order_id"] ?>" data-no="<?= $normalOrderData["order_no"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>


        </tr>
        <?php
    }
}