<?php
date_default_timezone_set("Asia/Bangkok");
include '../dbconn.php';
$resid = @$_POST["resid"];

$fastOrderRes = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date, "
        . "fast_order.delivery_time, order_status.description,fast_order.shippingAddress_id, "
        . "fast_order.customer_id , quantity as qty , customer.firstName, customer.lastName , "
        . "fast_order.main_menu_id, request_fast_order.priority, fast_order.order_time,"
        . "customer.tel, restaurant.name "
        . "FROM `fast_order` "
        . "LEFT JOIN order_status ON order_status.id = fast_order.status"
        . " LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
        . "LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
        . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
        . "WHERE request_fast_order.restaurant_id = '$resid' "
        . "and fast_order.status = '1' "
        . "and fast_order.restaurant_id IS NULL "
        . "ORDER BY fast_order.order_time DESC");

$i = 1;
if ($fastOrderRes->num_rows == 0) {
    ?>
    <input type="hidden" id="fastordercount" value="0">
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการใหม่</h4></td></tr>
    <?php
} else {
    while ($fastOrderData = $fastOrderRes->fetch_assoc()) {
        $now = time();
        $ordertime = strtotime($fastOrderData["order_time"]);
        $diff = $now - $ordertime;
        //echo "order at : " . $fastOrderData["order_time"];
        //echo "\nnow : " . date("Y-m-d H:i:s");
        //echo "\ndiff : " . ($diff / 60) . "\n";
        $timeleft;
        $fast_id = $fastOrderData["fast_id"];
        $pri = $fastOrderData["priority"];
        if ($pri == 1) {
            if ($diff > (60 * 15)) {
                //echo "pri1: skip";
                continue;
            } else {
                $timeleft = (60 * 15) - $diff;
            }
        } else if ($pri == 2) {
            if ($diff < (60 * 15) | $diff > (60 * 30)) {
                //echo "pri2: skip";
                continue;
            } else {
                $timeleft = (60 * 30) - $diff;
            }
        } else if ($pri == 3) {
            if ($diff < (60 * 30) | $diff > (60 * 45)) {
                $con->query("UPDATE `fast_order` SET `status`='7',`updated_status_time`= now(),`restaurant_id`= '$resid' WHERE id= '$fast_id'");
                if ($con->error == "") {

                   /*include '../register/thsms.php';
                    $sms = new thsms();
                    $sms->username = 'thanaree';
                    $sms->password = '58c60d';

                    $b = $sms->send('0000', $fastOrderData["tel"], "เลขที่รายการ(สั่งด่วน): " . $fastOrderData["fast_id"] . "\n ไม่มีร้านใดตอบรับรายการ"." "."\nลูกค้าสามารถสั่งซื้ออาหารได้ที่ www.pixupfood.com");
                   */ 
                }
                continue;
            } else {
                $timeleft = (60 * 45) - $diff;
            }
        }
        ?>
        <tr>
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
            <td style="text-align: center"><span class="timeleft" data-second="<?= $timeleft ?>"><?= printTime($timeleft); ?></span></td>
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
        <?php
    }
    if ($i == 1) {
        ?>
        <input type="hidden" id="fastordercount" value="0">
        <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการใหม่</h4></td></tr>
        <?php
    } else {
        ?>
        <input type="hidden" id="fastordercount" value="<?= $i - 1 ?>">
        <?php
    }
}

function printTime($timeleft) {
    $output = "";
    $hour = (gmdate("H", $timeleft) + 0);
    $min = (gmdate("i", $timeleft) + 0);
    $sec = gmdate("s", $timeleft);
    if ($sec < 10 & $timeleft < (60)) {
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