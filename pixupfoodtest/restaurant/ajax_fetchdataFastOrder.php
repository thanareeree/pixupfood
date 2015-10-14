<?php
include '../dbconn.php';
$resid = @$_POST["resid"];

$fastOrderRes = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date, "
        . "fast_order.delivery_time, order_status.description,fast_order.shippingAddress_id, "
        . "fast_order.customer_id , quantity as qty , customer.firstName, customer.lastName , "
        . "fast_order.main_menu_id "
        . "FROM `fast_order` "
        . "LEFT JOIN order_status ON order_status.id = fast_order.status"
        . " LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
        . "LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
        . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
        . "WHERE request_fast_order.restaurant_id = '$resid' "
        . "AND request_fast_order.priority = '1' "
        . "and fast_order.status != '7' "
        . "ORDER BY fast_order.order_time DESC");
$i = 1;
if ($fastOrderRes->num_rows == 0) {
    ?>
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการใหม่</h4></td></tr>
    <?php
} else {
    while ($fastOrderData = $fastOrderRes->fetch_assoc()) {
        ?>
        <tr >
            <td style="text-align: center"><?= $i++; ?></td>
            <td><?= $fastOrderData["fast_id"] ?></td>                         
            <td><?= $fastOrderData["firstName"] . '&nbsp;' . $fastOrderData["lastName"] ?></td>
            <td>
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
            <td><?= $fastOrderData["delivery_date"] ?>&nbsp;<?= $fastOrderData["delivery_time"] ?> </td>
            <td style="text-align: center">----- </td>
            <td class="text-center">
                <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $fastOrderData["fast_id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
            <td class="text-center">
                <button class="btn btn-success btn-xs acceptFastOrder" data-id="<?= $fastOrderData["fast_id"] ?>">
                    <span class="glyphicon glyphicon-check"></span> 
                    รับ
                </button>
            </td>
            <td class="text-center">
                <button class="btn btn-danger btn-xs ignoreFastOrder" data-id="<?= $fastOrderData["fast_id"] ?>">
                    <span class="glyphicon glyphicon-trash"></span> 
                    ปฏิเสธ
                </button>
            </td>
        </tr>
    <?php }
}
?>
