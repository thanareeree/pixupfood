<?php
session_start();
include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];

$orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, updated_status_time, status "
        . "FROM normal_order WHERE status = 9 AND customer_id = '$cusid' "
        . "UNION "
        . "select concat('F') as orderType, id, updated_status_time, status "
        . "FROM fast_order WHERE status = 9 AND customer_id = '$cusid' "
        . "ORDER BY updated_status_time DESC, id");




$orderRes = $con->query("SELECT fast_order.id as fast_id, order_status.description, order_status.id as status_id,"
        . " fast_order.quantity as qty, restaurant.name, fast_order.main_menu_id, fast_order.messenger_id, "
        . "fast_order.updated_status_time, fast_order.restaurant_id "
        . "FROM `fast_order` "
        . "LEFT JOIN order_status ON order_status.id = fast_order.status "
        . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
        . "WHERE fast_order.customer_id = '$cusid' "
        . "and fast_order.status = '9' "
        . "GROUP by fast_order.id ORDER BY fast_order.status ASC, fast_order.order_time DESC");


if ($orderNowAllRes->num_rows == 0) {
    ?>
    <tr>
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>                  
    </tr>
    <?php
} else {
    $i = 1;
    while ($orderIdAllData = $orderNowAllRes->fetch_assoc()) {
        $order_type = $orderIdAllData["orderType"];
        $orderIdAll = $orderIdAllData["id"];

        if ($order_type == 'F') {

            $orderRes = $con->query("SELECT fast_order.id as fast_id, order_status.description, order_status.id as status_id,"
                    . " fast_order.quantity as qty, restaurant.name, fast_order.main_menu_id, fast_order.messenger_id, "
                    . "fast_order.updated_status_time, fast_order.restaurant_id, fast_order.order_no "
                    . "FROM `fast_order` "
                    . "LEFT JOIN order_status ON order_status.id = fast_order.status "
                    . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
                    . "WHERE fast_order.id = '$orderIdAll' "
                    . "GROUP by fast_order.id ORDER BY fast_order.status ASC, fast_order.order_time DESC");
            while ($orderData = $orderRes->fetch_assoc()) {

                $messid = $orderData["messenger_id"];
                $messengerNameRes = $con->query("select * from messenger where id = '$messid'");
                $messData = $messengerNameRes->fetch_assoc();
                $mesName = $messData["username"];
                ?>
                <tr>
                   <!-- <td><?= $i++; ?></td>-->
                    <td class="text-center"><?= $orderData["order_no"] ?></td>    
                    <td class="text-center"><?= $orderData["qty"] ?></td>
                    <td><?= $orderData["name"] ?></td>
                    <td class="text-center"><?= $orderData["updated_status_time"] ?>&nbsp;น.</td>
                    <!--<td class="text-center"><?= $mesName ?></td>-->
                    <td class="text-center">
                        <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $orderData["fast_id"] ?>" data-no='<?= $orderData["order_no"] ?>' >
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
        } else {
            $orderRes = $con->query(" SELECT normal_order.id as order_id, normal_order.updated_status_time, "
                    . "restaurant.name, SUM(order_detail.quantity) as qty , normal_order.messenger_id,"
                    . " normal_order.restaurant_id, normal_order.order_no "
                    . "FROM `normal_order` "
                    . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                    . "LEFT JOIN customer ON customer.id = normal_order.customer_id"
                    . " LEFT JOIN order_status ON order_status.id = normal_order.status "
                    . "LEFT JOIN restaurant ON restaurant.id = normal_order.restaurant_id "
                    . "WHERE normal_order.id = '$orderIdAll' "
                    . "GROUP BY normal_order.id ORDER BY normal_order.status ASC, normal_order.order_time DESC");
            while ($orderData = $orderRes->fetch_assoc()) {

                $messid = $orderData["messenger_id"];
                $messengerNameRes = $con->query("select * from messenger where id = '$messid'");
                $messData = $messengerNameRes->fetch_assoc();
                $mesName = $messData["username"];
                ?>
                <tr>
                   <!-- <td><?= $i++; ?></td>-->
                    <td class="text-center"><?= $orderData["order_no"] ?></td>    
                    <td class="text-center"><?= $orderData["qty"] ?></td>
                    <td><?= $orderData["name"] ?></td>
                    <td class="text-center"><?= $orderData["updated_status_time"] ?>&nbsp;น.</td>
                    <!--<td><?= $mesName ?></td>-->
                    <td class="text-center">
                        <button class="btn btn-info btn-xs normalOrderView" data-id="<?= $orderData["order_id"] ?>" data-no='<?= $orderData["order_no"] ?>'>
                            <span class="glyphicon glyphicon-eye-open"></span> 
                            แสดง
                        </button>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-success btn-xs normalReview" data-id="<?= $orderData["restaurant_id"] ?>" data-name="<?= $orderData["name"] ?>">
                            <span class="glyphicon glyphicon-edit"></span> 
                            รีวิว
                        </button>
                    </td>
                </tr>
                <?php
            }
        }
    }
}
?>

