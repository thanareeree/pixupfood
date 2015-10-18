<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include '../../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$normalOrderRes = $con->query("SELECT normal_order.id as order_id, normal_order.order_time,delivery_date, "
        . "delivery_time, total_nofee,prepay, normal_order.status, normal_order.shippingAddress_id,"
        . " normal_order.customer_id , COUNT(order_detail.id) as foodlist, SUM(order_detail.quantity) as qty , "
        . "customer.firstName, customer.lastName, customer.tel, order_status.description, normal_order.updated_status_time "
        . "FROM `normal_order` "
        . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
        . "LEFT JOIN order_status ON order_status.id = normal_order.status"
        . " WHERE normal_order.restaurant_id = '$resid' and normal_order.status > 1 AND normal_order.status <= 7 "
        . "GROUP BY normal_order.id "
        . "ORDER BY normal_order.order_time DESC");
$i = 1;



if ($normalOrderRes->num_rows == 0) {
    ?>
    <input type="hidden" id="normalordercount" value="0">
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>
    <?php
} else {
    while ($normalOrderData = $normalOrderRes->fetch_assoc()) {
        $now = time();
         $ordertime = strtotime($normalOrderData["updated_status_time"]);
            $diff = $now - $ordertime;
            $orderid = $normalOrderData["order_id"];
             $timeleft;
             
        if ($normalOrderData["status"] == 2) {
            if ($diff > (60 * 60 * 4)) {
                
             $con->query("UPDATE `normal_order` SET `status`='7',`updated_status_time`= now() WHERE id = '$orderid' ");
                if ($con->error == "") {

                   /*include '../../register/thsms.php';
                    $sms = new thsms();
                    $sms->username = 'thanaree';
                    $sms->password = '58c60d';

                    $b = $sms->send('0000', $normalOrderData["tel"], "เลขที่รายการ: " . $normalOrderData["order_id"] . " \nถูกปฏิเสธรายการจากเนื่องจากลูกค้าไม่ได้ชำระค่ามัดจำสินค้าตามเวลาที่กำหนด".""." \nลูกค้าสามารถสั่งซื้ออาหารได้ที่ www.pixupfood.com");
              */
                    } 
                continue;
            } else {
                $timeleft = (60 * 60 * 4) - $diff;
            }
        }
        ?>
    <tr <?= ($normalOrderData["status"] == 7 or $normalOrderData["status"] ==  6)? "class=\"danger\"":""?>>
            <td><?= $i++; ?></td>
            <td><?= $normalOrderData["order_id"] ?></td>                         
            <td><?= $normalOrderData["firstName"] . '&nbsp;' . $normalOrderData["lastName"] ?></td>
            <td class="text-center"><?= $normalOrderData["foodlist"] ?></td>
            <td style="text-align: center"><?= $normalOrderData["qty"] ?></td>
            <td class="text-center"><?= $normalOrderData["delivery_date"] ?>&nbsp;<?= $normalOrderData["delivery_time"] ?> </td>
            <td style="text-align: center"><?= $normalOrderData["description"] ?></td>
            <td class="text-center">
                <button class="btn btn-info btn-xs normalOrderView" data-id="<?= $normalOrderData["order_id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
            <td class="text-center">  
                <select class="form-control statusselect" id="statusselect"  data-id="<?= $normalOrderData["order_id"] ?>">
                    <?php
                    $stataus_now_id = $normalOrderData["status"];
                    $statusid = $stataus_now_id + 1;
                    if($stataus_now_id == 7 || $stataus_now_id == 6 || $stataus_now_id == 5){
                          $res = $con->query("SELECT * FROM `order_status` WHERE id = '$stataus_now_id' ");
                    }else{
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
            <td class="text-center"style="color: red" ><?= ($normalOrderData["status"] == 6) ? "ขอยกเลิกรายการ" : "" ?></td>
        </tr>
        <?php
    }
}
