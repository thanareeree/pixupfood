<?php
session_start();
include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$orderRes = $con->query("SELECT fast_order.id as fast_id, order_status.description, order_status.id as status_id,"
        . " fast_order.quantity as qty, restaurant.name, fast_order.main_menu_id, fast_order.order_no "
        . "FROM `fast_order` "
        . "LEFT JOIN order_status ON order_status.id = fast_order.status "
        . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
        . "WHERE fast_order.customer_id = '$cusid' "
        . "and fast_order.status != '9' "
        . "GROUP by fast_order.id ORDER BY fast_order.status ASC, fast_order.order_time DESC");
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
        <tr <?= ($orderData["status_id"] == "1"  ) ? "class=\"warning\"" : "" ?>>
           <!-- <td><?= $i++; ?></td>-->
            <td class="text-center"><?= $orderData["order_no"] ?></td>                         
            <td class="text-center">
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
            <td class="text-center"><?= $orderData["qty"] ?></td>
            <td class="text-center"><?= $orderData["description"] ?></td>
            <td class="text-center">
                <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $orderData["fast_id"] ?>" data-no='<?= $orderData["order_no"] ?>' ><span class="glyphicon glyphicon-eye-open"></span> แสดง</button>
            </td>
            <td class="text-center">
                <button class="btn btn-warning btn-xs uploadSlip1" data-id="<?= $orderData["fast_id"] ?>" <?= ($orderData["status_id"] == "2")? "": "disabled"?> <?= ($orderData["status_id"] == "4")? "style=\"display: none\"": ""?>>
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    อัพโหลด
                </button>
                <button class="btn btn-warning btn-xs uploadSlip2" data-id="<?= $orderData["fast_id"] ?>" <?= ($orderData["status_id"] == "4")? "": "style=\"display: none\""?>  >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    อัพโหลด
                </button>
            </td>
        </tr>
        <?php
    }
}
?>

