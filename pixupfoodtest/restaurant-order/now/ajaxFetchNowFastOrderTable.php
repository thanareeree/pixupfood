<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include '../../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$fastOrderRes = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date,"
        . " fast_order.delivery_time, order_status.description, order_status.id, fast_order.shippingAddress_id,"
        . " fast_order.customer_id , quantity as qty , customer.firstName, customer.lastName , fast_order.main_menu_id,"
        . " request_fast_order.priority, fast_order.order_time,customer.tel, restaurant.name "
        . "FROM `fast_order` "
        . "LEFT JOIN order_status ON order_status.id = fast_order.status "
        . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
        . "LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
        . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
        . "WHERE request_fast_order.restaurant_id = '14'"
        . " and fast_order.status != '7' "
        . "AND fast_order.status > 1 "
        . "and fast_order.restaurant_id IS NULL ORDER BY fast_order.order_time DESC");

$i = 1;
if ($fastOrderRes->num_rows == 0) {
    ?>
    <input type="hidden" id="fastordercount" value="0">
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>
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
            <td style="text-align: center"><td style="text-align: center"><?= $fastOrderData["description"] ?></td></td>
            <td class="text-center">
                <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $fastOrderData["fast_id"] ?>" >
                    <span class="glyphicon glyphicon-eye-open"></span> 
                    แสดง
                </button>
            </td>
            <td class="text-center">
                <select class="form-control" id="statusselect">
                    <?php
                    $res = $con->query("SELECT * FROM `order_status` WHERE id = 2 or id = 5 or id = 8 or id = 4");
                    $stataus_now_id = $fastOrderData["status"];
                    while ($data = $res->fetch_assoc()) {
                        $statusid = $data["id"];
                        if($stataus_now_id <= $statusid){
                            echo "<option value=\"".$data["id"]."\">".$data["description"]."</option>";
                        }
                        ?>
                      
                    <?php }
                    ?> 
                </select>
            </td>
            <td class="text-center"> </td>
        </tr>
        <?php
    }
}

/*function printTime($timeleft) {
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
?>*/