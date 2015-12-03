<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include '../../dbconn.php';
$resid = $_SESSION["restdata"]["id"];

$type = $_POST["type"];

$orderDetailRes = "";
if ($type == 'prepay') {
    $orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, delivery_date, status "
            . "FROM normal_order "
            . "WHERE status = 2 AND restaurant_id = '$resid' "
            . "UNION "
            . "select concat('F') as orderType, id, delivery_date, status "
            . "FROM fast_order WHERE status = 2 AND restaurant_id = '$resid' "
            . "ORDER BY delivery_date , id");
} else if ($type == 'all') {

    $orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, delivery_date, status "
            . "FROM normal_order "
            . "WHERE status < 6  AND status > 1 AND restaurant_id = '$resid' "
            . "UNION "
            . "select concat('F') as orderType, id, delivery_date, status "
            . "FROM fast_order WHERE status < 6  AND status > 1  AND restaurant_id = '$resid' "
            . "ORDER BY delivery_date , id");
} else if ($type == "int") {
    $orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, delivery_date, status "
            . "FROM normal_order "
            . "WHERE status = 3 AND restaurant_id = '$resid' "
            . "UNION "
            . "select concat('F') as orderType, id, delivery_date, status "
            . "FROM fast_order "
            . "WHERE status = 3 AND restaurant_id = '$resid' "
            . "ORDER BY delivery_date , id");
} else if ($type == "diffpay") {
    $orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, delivery_date, status "
            . "FROM normal_order "
            . "WHERE status = 4 AND restaurant_id = '$resid' "
            . "UNION "
            . "select concat('F') as orderType, id, delivery_date, status "
            . "FROM fast_order "
            . "WHERE status = 4 AND restaurant_id = '$resid' "
            . "ORDER BY delivery_date , id");
} else if ($type == "deli") {
    $orderNowAllRes = $con->query("SELECT concat('N') as orderType , id, delivery_date, status "
            . "FROM normal_order "
            . "WHERE status = 5 AND restaurant_id = '$resid' "
            . "UNION "
            . "select concat('F') as orderType, id, delivery_date, status "
            . "FROM fast_order "
            . "WHERE status = 5 AND restaurant_id = '$resid' "
            . "ORDER BY delivery_date , id");
}





if ($orderNowAllRes->num_rows == 0) {
    ?>
    <input type="hidden" id="fastordercount" value="0">
    <tr><td colspan="10" class="warning" style="text-align: center;"><h4>ยังไม่มีรายการ</h4></td></tr>
    <?php
} else {
    while ($orderIdAllData = $orderNowAllRes->fetch_assoc()) {
        $order_type = $orderIdAllData["orderType"];
        $orderIdAll = $orderIdAllData["id"];


        if ($order_type == 'F') {
            $fastOrderRes = $con->query("SELECT fast_order.id as fast_id, fast_order.delivery_date,"
                    . "fast_order.delivery_time, order_status.description, order_status.id, fast_order.order_no, "
                    . "fast_order.shippingAddress_id,fast_order.customer_id ,quantity as qty , shippingAddress.full_address, "
                    . "customer.firstName, customer.lastName , fast_order.main_menu_id,"
                    . "request_fast_order.priority, fast_order.order_time,customer.tel, "
                    . "restaurant.name, fast_order.updated_status_time, fast_order.status, fast_order.payment_id "
                    . "FROM `fast_order`LEFT JOIN order_status ON order_status.id = fast_order.status "
                    . "LEFT JOIN restaurant ON restaurant.id = fast_order.restaurant_id "
                    . "LEFT JOIN request_fast_order ON request_fast_order.fast_id = fast_order.id "
                    . "LEFT JOIN customer ON customer.id = fast_order.customer_id "
                    . "LEFT JOIN shippingAddress ON shippingAddress.id = fast_order.shippingAddress_id "
                    . "WHERE fast_order.id = '$orderIdAll' AND request_fast_order.restaurant_id = '$resid' "
                    . "AND request_fast_order.accepted = 1");
            while ($fastOrderData = $fastOrderRes->fetch_assoc()) {
                $noo = sprintf("%07d", $fastOrderData["fast_id"]);
                $now = time();
                $ordertime = strtotime($fastOrderData["updated_status_time"]);
                $diff = $now - $ordertime;
                $orderid = $fastOrderData["fast_id"];
                $timeleft;

                $qtyOrder = $fastOrderData["qty"];
                $date = $fastOrderData["delivery_date"];

                $limiRes = $con->query("SELECT * FROM `limit_box_daily` WHERE restaurant_id = '$resid' and daily_date = '$date' ");
                $limitData = $limiRes->fetch_assoc();
                $qtyDaily = $limitData["qty"];

                $diffQty = $qtyDaily - $qtyOrder;

                if ($fastOrderData["status"] == 2) {
                    if ($diff > (60 * 60 * 4)) {

                        $con->query("UPDATE `fast_order` SET `status`='8',`updated_status_time`= now() WHERE id = '$orderid' ");
                        if ($con->error == "") {
                            $con->query("UPDATE `limit_box_daily` SET qty = '$diffQty'  where restaurant_id = '$resid' and daily_date = '$date'");
                           /* include '../../register/thsms.php';
                            $sms = new thsms();
                            $sms->username = 'thanaree';
                            $sms->password = '58c60d';

                            $b = $sms->send('0000', $fastOrderData["tel"], "หมายเลขคำสั่งซื้อ: " . $fastOrderData["order_no"]
                                    . " \nถูกยกเลิกรายการจากเนื่องจากลูกค้าไม่ได้ชำระค่ามัดจำสินค้าตามเวลาที่กำหนด"
                                    . " \nลูกค้าสามารถสั่งซื้ออาหารได้ที่ pixupfood.com");*/
                        }
                        //continue;
                    } else {
                        $timeleft = (60 * 60 * 4) - $diff;
                    }
                } else if ($fastOrderData["status"] == 4 && $fastOrderData["payment_id"] == 2) {
                    $checkRes = $con->query("SELECT * FROM `transfer` WHERE type = 'f2' and order_id = '$orderIdAll'");
                    if ($checkRes->num_rows == 0) {
                        $unPayRes = $con->query("SELECT * FROM fast_order WHERE fast_order.restaurant_id = '$resid' "
                                . "AND fast_order.id = '$orderIdAll' AND fast_order.delivery_date < DATE(NOW())");
                        if ($unPayRes->num_rows > 0) {
                            $con->query("UPDATE `fast_order` SET `status`='8',`updated_status_time`= now() WHERE id = '$orderid' ");
                            $con->query("UPDATE `limit_box_daily` SET qty = '$diffQty'  where restaurant_id = '$resid' and daily_date = '$date'");
                            /*   include '../../register/thsms.php';
                              $sms = new thsms();
                              $sms->username = 'thanaree';
                              $sms->password = '58c60d';

                              $b = $sms->send('0000', $fastOrderData["tel"], "หมายเลขคำสั่งซื้อ: " . $fastOrderData["order_no"]
                              . " \nถูกยกเลิกรายการจากเนื่องจากลูกค้าไม่ได้ชำระค่าสินค้าในส่วนที่เหลือ"
                              . " \nลูกค้าสามารถสั่งซื้ออาหารได้ที่ pixupfood.com"); */
                        }
                    }
                } else if ($fastOrderData["status"] == 5) {
                    $unPayRes = $con->query("SELECT * FROM fast_order WHERE fast_order.restaurant_id = '$resid' "
                            . "AND fast_order.id = '$orderid' AND fast_order.delivery_date < DATE(NOW())");
                    if ($unPayRes->num_rows > 0) {
                        $con->query("UPDATE `fast_order` SET `status`='8',`updated_status_time`= now() WHERE id = '$orderid' ");
                        $con->query("UPDATE `limit_box_daily` SET qty = '$diffQty'  where restaurant_id = '$resid' and daily_date = '$date'");
                    }
                }
                ?>
                <tr <?= ($fastOrderData["status"] == 7 or $fastOrderData["status"] == 6) ? "class=\"danger\"" : "" ?>>

                    <td class="text-center"><?= $fastOrderData["order_no"] ?></td>                
                   <!-- <td class="text-center">1</td>-->
                    <td style="text-align: center"><?= $fastOrderData["qty"] ?></td>
                    <td><div style="width: 300px"><?= $fastOrderData["full_address"] ?></div></td>
                    <td class="text-center"><?= $fastOrderData["delivery_date"] ?>&nbsp;<?= $fastOrderData["delivery_time"] ?> </td>
                    <td style="text-align: center"><?= $fastOrderData["description"] ?></td>
                    <td class="text-center">
                        <button class="btn btn-info btn-xs fastOrderView" data-id="<?= $fastOrderData["fast_id"] ?>" data-no="<?= $fastOrderData["order_no"] ?>" >
                            <span class="glyphicon glyphicon-eye-open"></span> 
                            แสดง
                        </button>
                    </td>
                    <td class="text-center">
                        <select class="form-control faststatusselect" id="statusselect"  data-id="<?= $fastOrderData["fast_id"] ?>">
                            <?php
                            $stataus_now_id = $fastOrderData["status"];
                            $statusid = $stataus_now_id + 1;
                            if ($stataus_now_id == 7 || $stataus_now_id == 6 || $stataus_now_id == 5) {
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
        } else {
            $normalOrderRes = $con->query("SELECT normal_order.id as order_id, normal_order.order_time,delivery_date,"
                    . " delivery_time, total_nofee,prepay, normal_order.status, normal_order.shippingAddress_id, "
                    . "normal_order.customer_id , COUNT(order_detail.id) as foodlist, normal_order.order_no, "
                    . "SUM(order_detail.quantity) as qty , customer.firstName, "
                    . "customer.lastName, customer.tel, shippingAddress.full_address, order_status.description,"
                    . " normal_order.updated_status_time, normal_order.payment_id "
                    . "FROM `normal_order` "
                    . "LEFT JOIN order_detail ON order_detail.order_id = normal_order.id "
                    . "LEFT JOIN customer ON customer.id = normal_order.customer_id "
                    . "LEFT JOIN order_status ON order_status.id = normal_order.status "
                    . "LEFT JOIN shippingAddress ON shippingAddress.id = normal_order.shippingAddress_id "
                    . "WHERE normal_order.id = '$orderIdAll' "
                    . "GROUP BY normal_order.id "
                    . "ORDER BY normal_order.delivery_date , normal_order.id");

            while ($normalOrderData = $normalOrderRes->fetch_assoc()) {
                $now = time();
                $ordertime = strtotime($normalOrderData["updated_status_time"]);
                $diff = $now - $ordertime;
                $orderid = $normalOrderData["order_id"];
                $timeleft;

                $qtyOrder = $normalOrderData["qty"];
                $date = $normalOrderData["delivery_date"];

                $limiRes = $con->query("SELECT * FROM `limit_box_daily` WHERE restaurant_id = '$resid' and daily_date = '$date' ");
                $limitData = $limiRes->fetch_assoc();
                $qtyDaily = $limitData["qty"];
                $diffQty = $qtyDaily - $qtyOrder;

                if ($normalOrderData["status"] == 2) {
                    if ($diff > (60 * 60 * 4)) {

                        $con->query("UPDATE `normal_order` SET `status`='8',`updated_status_time`= now() WHERE id = '$orderid' ");
                        if ($con->error == "") {
                            $con->query("UPDATE `limit_box_daily` SET qty = '$diffQty'  where restaurant_id = '$resid' and daily_date = '$date'");
                            include '../../register/thsms.php';
                            $sms = new thsms();
                            $sms->username = 'thanaree';
                            $sms->password = '58c60d';

                            $b = $sms->send('0000', $normalOrderData["tel"], "หมายเลขคำสั่งซื้อ: " . $normalOrderData["order_no"]
                                    . " \nถูกยกเลิกรายการจากเนื่องจากลูกค้าไม่ได้ชำระค่ามัดจำสินค้าตามเวลาที่กำหนด"
                                    . " \nลูกค้าสามารถสั่งซื้ออาหารได้ที่ pixupfood.com");
                        }
                        // continue;
                    } else {
                        $timeleft = (60 * 60 * 4) - $diff;
                    }
                } else if ($normalOrderData["status"] == 4 && $normalOrderData["payment_id"] == 2) {
                    $checkRes = $con->query("SELECT * FROM `transfer` WHERE order_id = '$orderid' AND type='n2'");
                    if ($checkRes->num_rows == 0) {
                        $unPayRes = $con->query("SELECT * FROM normal_order WHERE normal_order.restaurant_id = '$resid' "
                                . "AND normal_order.id = '$orderid' AND normal_order.delivery_date < DATE(NOW())");
                        if ($unPayRes->num_rows > 0) {
                            $con->query("UPDATE `normal_order` SET `status`='8',`updated_status_time`= now() WHERE id = '$orderid' ");
                            $con->query("UPDATE `limit_box_daily` SET qty = '$diffQty'  where restaurant_id = '$resid' and daily_date = '$date'");
                            /* include '../../register/thsms.php';
                              $sms = new thsms();
                              $sms->username = 'thanaree';
                              $sms->password = '58c60d';
                              $b = $sms->send('0000', $normalOrderData["tel"], "หมายเลขคำสั่งซื้อ: " . $normalOrderData["order_no"]
                              . " \nถูกยกเลิกรายการจากเนื่องจากลูกค้าไม่ได้ชำระค่าสินค้าในส่วนที่เหลือ"
                              . " \nลูกค้าสามารถสั่งซื้ออาหารได้ที่ pixupfood.com"); */
                        }
                    }
                } else if ($normalOrderData["status"] == 5) {
                    $unPayRes = $con->query("SELECT * FROM normal_order WHERE normal_order.restaurant_id = '$resid' "
                            . "AND normal_order.id = '$orderid' AND normal_order.delivery_date < DATE(NOW())");
                    if ($unPayRes->num_rows > 0) {
                        $con->query("UPDATE `normal_order` SET `status`='8',`updated_status_time`= now() WHERE id = '$orderid' ");
                        $con->query("UPDATE `limit_box_daily` SET qty = '$diffQty'  where restaurant_id = '$resid' and daily_date = '$date'");
                    }
                }
                ?>
                <tr>

                    <td class="text-center"><?= $normalOrderData["order_no"] ?></td>
                    <!--<td class="text-center"><?= $normalOrderData["foodlist"] ?></td>-->
                    <td style="text-align: center"><?= $normalOrderData["qty"] ?></td>
                    <td><div style="width: 300px"><?= $normalOrderData["full_address"] ?></div></td>
                    <td class="text-center"><?= $normalOrderData["delivery_date"] ?>&nbsp;<?= $normalOrderData["delivery_time"] ?> </td>
                    <td style="text-align: center"><?= $normalOrderData["description"] ?></td>
                    <td class="text-center">
                        <button class="btn btn-info btn-xs normalOrderView" data-id="<?= $normalOrderData["order_id"] ?>" data-no="<?= $normalOrderData["order_no"] ?>"  >
                            <span class="glyphicon glyphicon-eye-open"></span> 
                            แสดง
                        </button>
                    </td>
                    <td class="text-center">  
                        <select class="form-control nowstatusselect" id="statusselect"  data-id="<?= $normalOrderData["order_id"] ?>">
                            <?php
                            $stataus_now_id = $normalOrderData["status"];
                            $statusid = $stataus_now_id + 1;
                            if ($stataus_now_id == 7 || $stataus_now_id == 6 || $stataus_now_id == 5) {
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
                    <td class="text-center"style="color: red" ><?= ($normalOrderData["status"] == 6) ? "ขอยกเลิกรายการ" : "" ?></td>
                </tr>
                <?php
            }
        }
    }
}
