<?php
session_start();
include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$orderRes = $con->query("SELECT fast_order.id as fast_id, order_status.description,"
        . " fast_order.quantity as qty, restaurant.name, fast_order.main_menu_id "
        . "FROM `fast_order` "
        . "LEFT JOIN order_status ON order_status.id = fast_order.status "
        . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
        . "WHERE fast_order.customer_id = '$cusid' "
        . "and fast_order.status != '7' "
        . "GROUP by fast_order.id");
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
            <td><?= $i++; ?></td>
            <td><?= $orderData["fast_id"] ?></td>                         
            <td>
                <?php
                $menuid = $orderData["main_menu_id"];
                $menuid = "(" . $menuid . ")";
                $name = "";
                $resName = $con->query("SELECT  main_menu.name FROM main_menu WHERE main_menu.id IN $menuid");
                $count = 0;
                while ($food = $resName->fetch_assoc()) {

                    $name = $food["name"];
                    // $menustr .= $name;
                    $count++;
                    if ($count < $resName->num_rows) {
                        $name.="+";
                    }
                    echo $name;
                }
                ?>
            </td>
            <td><?= $orderData["qty"] ?></td>
            <td><?= $orderData["description"] ?></td>
            <td class="text-center"><button class="btn btn-info btn-xs" data-toggle="modal" data-target='#track' href="#track"><span class="glyphicon glyphicon-eye-open"></span> แสดง</button></td>
            <td class="text-center"><button class="btn btn-warning btn-xs" data-toggle="modal" data-target='#transf' href="#transf" disabled="disabled"><span class="glyphicon glyphicon-eye-open"></span> อัพโหลด</button></td>
        </tr>
        <?php
    }
}
?>

