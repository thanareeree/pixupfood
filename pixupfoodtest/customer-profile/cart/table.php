<?php
session_start();
include '../../dbconn.php';
$cusid = $_SESSION["userdata"]["id"];
$detailRes = $con->query("SELECT order_detail.id, order_detail.quantity, "
        . "`price`, `set_type`, `menu_id`,`moretext`, order_detail.created_time,"
        . " order_detail.status, `order_id`, `customer_id`, `restaurant_id`,"
        . " restaurant.name as resname "
        . "FROM `order_detail` "
        . "left join restaurant on restaurant.id = order_detail.restaurant_id"
        . " WHERE customer_id = '$cusid' and status = '0'"
        . "order by restaurant.name");
if ($detailRes->num_rows == 0) {
    ?>
    <tr>
         <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการใหม่</h4></td></tr>                  
    </tr>
    <?php
} else {

    $i = 1;
    while ($detailData = $detailRes->fetch_assoc()) {
        
        ?>
        <tr>
            <td><?= $i++;?></td>                        
            <td>
                <ul style="list-style: none; padding: 0;">
                    <?php
                    $menuid = $detailData["menu_id"];
                    $menuid = "(" . $menuid . ")";

                    $resName = $con->query("SELECT menu.price, main_menu.name FROM menu "
                            . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                            . "WHERE menu.id IN $menuid");

                    while ($dataName = $resName->fetch_assoc()) {

                        echo '<li>' . $dataName["name"] . '</li>';
                    }
                    ?>
                </ul>
            </td>
            <td><?= $detailData["resname"]?></td>
            <td><?= $detailData["quantity"]?></td>
            <td ><a href="/view/cus_order_shoplist.php?resId=<?= $detailData["restaurant_id"]?>" class="btn btn-success btn-xs sendOrder" style="font-size: 13px;font-weight: normal" ><span class="glyphicon glyphicon-check"></span> สั่ง</a></td>
            <td ><p class="btn btn-danger btn-xs" style="font-size: 13px;font-weight: normal" ><span class="glyphicon glyphicon-trash"></span> นำออก</p></td>
        </tr>
        <?php
    }
}
?>

