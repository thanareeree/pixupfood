<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include '../../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$fastOrderRes = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date,fast_order.delivery_time,"
        . " order_status.description, order_status.id, fast_order.shippingAddress_id,fast_order.customer_id ,"
        . " quantity as qty , customer.firstName, customer.lastName , fast_order.main_menu_id,"
        . "request_fast_order.priority, fast_order.order_time,customer.tel, restaurant.name, "
        . "fast_order.updated_status_time, fast_order.status "
        . "FROM `fast_order` "
        . "LEFT JOIN order_status ON order_status.id = fast_order.status "
        . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id"
        . " LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
        . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
        . "WHERE request_fast_order.restaurant_id = '$resid'"
        . "and fast_order.status <= '7' AND fast_order.status > 1 "
        . "ORDER BY fast_order.order_time DESC");

$i = 1;
if ($fastOrderRes->num_rows == 0) {
    ?>
    <input type="hidden" id="fastordercount" value="0">
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>
    <?php
} else {
    while ($fastOrderData = $fastOrderRes->fetch_assoc()) {
        $now = time();
        $ordertime = strtotime($fastOrderData["updated_status_time"]);
        $diff = $now - $ordertime;
        $orderid = $fastOrderData["fast_id"];
        $timeleft;

        if ($fastOrderData["status"] == 2) {
            if ($diff > (60 * 60 * 4)) {

                $con->query("UPDATE `fast_order` SET `status`='7',`updated_status_time`= now() WHERE id = '$orderid' ");
                if ($con->error == "") {

                    /* include '../../register/thsms.php';
                      $sms = new thsms();
                      $sms->username = 'thanaree';
                      $sms->password = '58c60d';

                      $b = $sms->send('0000', $fastOrderData["tel"], "เลขที่รายการ: " . $fastOrderData["fast_id"] . " \nถูกปฏิเสธรายการจากเนื่องจากลูกค้าไม่ได้ชำระค่ามัดจำสินค้าตามเวลาที่กำหนด".""." \nลูกค้าสามารถสั่งซื้ออาหารได้ที่ www.pixupfood.com");
                     */
                }
                continue;
            } else {
                $timeleft = (60 * 60 * 4) - $diff;
            }
        }
        ?>
        <tr <?= ($fastOrderData["status"] == 7 or $fastOrderData["status"] ==  6)? "class=\"danger\"":""?>>
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
            <td class="text-center"><?= $fastOrderData["delivery_date"] ?>&nbsp;<?= $fastOrderData["delivery_time"] ?> </td>
            <td style="text-align: center"><?= $fastOrderData["description"] ?></td>
            <td class="text-center">
                <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $fastOrderData["fast_id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
            <td class="text-center">
                <select class="form-control statusselect" id="statusselect"  data-id="<?= $fastOrderData["fast_id"] ?>">
                    <?php
                    $stataus_now_id = $fastOrderData["status"];
                    $statusid = $stataus_now_id + 1;
                    if ($stataus_now_id == 7 || $stataus_now_id == 6 || $stataus_now_id == 5 ) {
                        $res = $con->query("SELECT * FROM `order_status` WHERE id = '$stataus_now_id' ");
                    } else {
                        $res = $con->query("SELECT * FROM `order_status` WHERE id >= '$stataus_now_id' and id <= '$statusid'");
                    }
                    if ($stataus_now_id <= $statusid) {
                        while ($data = $res->fetch_assoc()) {
                            ?>
                            <option value=<?= $data["id"] ?> ><?= $data["description"] ?></option>;
                            <?php
                        }
                        ?>

                    <?php }
                    ?> 
                </select>
            </td>
            <td class="text-center"style="color: red" ><?= ($fastOrderData["status"] == 6) ? "ขอยกเลิกรายการ" : "" ?></td>
        </tr>
        <?php
    }
}
