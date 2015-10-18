<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include '../../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$fastOrderRes = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date, "
        . "fast_order.delivery_time, order_status.description, order_status.id, fast_order.shippingAddress_id,"
        . " fast_order.customer_id , quantity as qty , customer.firstName, customer.lastName , "
        . "fast_order.main_menu_id, request_fast_order.priority, fast_order.order_time,customer.tel,"
        . " restaurant.name, fast_order.updated_status_time, fast_order.messenger_id "
        . "FROM `fast_order` "
        . "LEFT JOIN order_status ON order_status.id = fast_order.status "
        . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
        . "LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
        . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
        . "WHERE fast_order.restaurant_id = '$resid'"
        . "and fast_order.status = 9 "
        . "GROUP by fast_order.id "
        . "ORDER BY fast_order.order_time DESC");


$i = 1;
if ($fastOrderRes->num_rows == 0) {
    ?>
    <input type="hidden" id="fastordercount" value="0">
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>
    <?php
} else {
    while ($fastOrderData = $fastOrderRes->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $fastOrderData["fast_id"] ?></td>                         
            <td><?= $fastOrderData["firstName"] . '&nbsp;' . $fastOrderData["lastName"] ?></td>
            <td class="text-center">
                <?php
                $menuid = $fastOrderData["main_menu_id"];
                $menuid = "(" . $menuid . ")";
                $name = "";

                $resName = $con->query("SELECT  main_menu.name FROM main_menu WHERE main_menu.id IN $menuid");
                $count = 0;
                while ($food = $resName->fetch_assoc()) {

                    $name = $food["name"];
                    $count++;
                    if ($count < $resName->num_rows) {
                        $name.="+";
                    }
                    echo $name;
                }
                ?>
            </td>
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
                <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $fastOrderData["fast_id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>

        </tr>
        <?php
    }
}
