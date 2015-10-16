<?php
date_default_timezone_set("Asia/Bangkok");
include '../dbconn.php';
$resid = @$_POST["resid"];
$normalOrderRes = $con->query("SELECT normal_order.id as order_id, normal_order.order_time, "
        . "delivery_date, delivery_time, total_nofee,prepay, normal_order.status,"
        . " normal_order.shippingAddress_id, normal_order.customer_id , COUNT(order_detail.id) as foodlist, "
        . "SUM(order_detail.quantity) as qty , customer.firstName, customer.lastName, customer.tel "
        . "FROM `normal_order` "
        . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
        . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
        . "WHERE normal_order.restaurant_id = '$resid' and normal_order.status = '1' "
        . "GROUP BY normal_order.id "
        . "ORDER BY normal_order.order_time DESC");
$i = 1;



if ($normalOrderRes->num_rows == 0) {
    ?>
    <input type="hidden" id="normalordercount" value="0">
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการใหม่</h4></td></tr>
    <?php
} else {
    while ($normalOrderData = $normalOrderRes->fetch_assoc()) {
        $now = time();
        $ordertime = strtotime($normalOrderData["order_time"]);
        $diff = $now - $ordertime;
        $orderid = $normalOrderData["order_id"];
        //echo "order at : " . $fastOrderData["order_time"];
        //echo "\nnow : " . date("Y-m-d H:i:s");
        //echo "\ndiff : " . ($diff / 60) . "\n";
        $timeleft;
        if ($diff > (60 * 60 * 24)) {
            $con->query("UPDATE `normal_order` SET `status`='7',`updated_status_time`= now() WHERE id = '$orderid' ");
            if ($con->error == "") {

               /* include '../register/thsms.php';
                $sms = new thsms();
                $sms->username = 'thanaree';
                $sms->password = '58c60d';

                $b = $sms->send('0000', $normalOrderData["tel"], "เลขที่รายการ: " . $normalOrderData["order_id"] . " ถูกปฏิเสธรายการจาก ลูกค้าสามารถสั่งซื้ออาหารได้ที่ https://pixupfood.com");
               
                */
            }
            continue;
        } else {
            $timeleft = (60 * 60 * 24) - $diff;
        }
        ?>
        <tr >
            <td style="text-align: center"><?= $i++; ?></td>
            <td><?= $normalOrderData["order_id"] ?></td>                         
            <td><?= $normalOrderData["firstName"] . '&nbsp;' . $normalOrderData["lastName"] ?></td>
            <td><?= $normalOrderData["foodlist"] ?></td>
            <td style="text-align: center"><?= $normalOrderData["qty"] ?></td>
            <td><?= $normalOrderData["delivery_date"] ?>&nbsp;<?= $normalOrderData["delivery_time"] ?> </td>
            <td style="text-align: center">
                <span class="timeleft" data-second="<?= $timeleft ?>"><?= printTime($timeleft); ?></span>
            </td>
            <td class="text-center">
                <button class="btn btn-info btn-xs normalOrderView" data-id="<?= $normalOrderData["order_id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
            <td class="text-center">
                <button class="btn btn-success btn-xs acceptNormalOrder" data-id="<?= $normalOrderData["order_id"] ?>">
                    <span class="glyphicon glyphicon-check"></span> 
                    รับ
                </button>
            </td>
            <td class="text-center">
                <button class="btn btn-danger btn-xs ignoreNormalData" data-id="<?= $normalOrderData["order_id"] ?>">
                    <span class="glyphicon glyphicon-trash"></span> 
                    ปฏิเสธ
                </button>
            </td>
        </tr>
        <?php
    }
    if ($i == 1) {
        ?>
        <input type="hidden" id="normalordercount" value="0">
        <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการใหม่</h4></td></tr>
        <?php
    } else {
        ?>
        <input type="hidden" id="normalordercount" value="<?= $i - 1 ?>">
        <?php
    }
}

function printTime($timeleft) {
    $output = "";
    $hour = (gmdate("H", $timeleft) + 0);
    $min = (gmdate("i", $timeleft) + 0);
    $sec = gmdate("s", $timeleft);
    if ($sec < 10 & $timeleft > (60)) {
        $sec = $sec + 0;
    }
    if ($timeleft > (60 * 60)) {
        $output .= $hour . ":";
    }
    if ($timeleft > (60)) {
        $output .= $min . ":";
    }
    $output .= $sec;
    return $output;
}
?>