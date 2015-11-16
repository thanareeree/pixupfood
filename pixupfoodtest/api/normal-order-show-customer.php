<?php
session_start();
include '../dbconn.php';

$order_id = $_POST["id"];


$orderRes = $con->query("SELECT * FROM `normal_order` LEFT JOIN customer ON customer.id = normal_order.customer_id WHERE normal_order.id ='$order_id'");
$orderData = $orderRes->fetch_assoc();
$resid = $orderData["restaurant_id"];
$resNameRes = $con->query("select  deliveryfee, restaurant.name"
        . " from restaurant "
        . "join mapping_delivery_type on mapping_delivery_type.restaurant_id = restaurant.id  "
        . " where restaurant.id = '$resid'");
$delifeeData = $resNameRes->fetch_assoc();

$shipAddressRes = $con->query("SELECT shippingAddress.address_naming, shippingAddress.type, "
        . "shippingAddress.full_address "
        . "FROM `normal_order` "
        . "LEFT JOIN shippingAddress ON shippingAddress.id = normal_order.shippingAddress_id "
        . "WHERE normal_order.id ='$order_id'");
$shipAddressData = $shipAddressRes->fetch_assoc();

$orderDetailRes = $con->query("SELECT * FROM `order_detail` WHERE order_detail.order_id = '$order_id'");

$statusRes = $con->query("SELECT order_status.id, order_status.description "
        . "FROM `normal_order` "
        . "LEFT JOIN order_status ON order_status.id = normal_order.status "
        . "WHERE normal_order.id = '$order_id'");
$statusData = $statusRes->fetch_assoc();
$statusid = $statusData["id"];

$slip_pathRes = $con->query("SELECT * FROM `transfer` WHERE order_id = '$order_id' AND type = 'n1'");
$slip1Data = $slip_pathRes->fetch_assoc();

$slip2res = $con->query("SELECT * FROM `transfer` WHERE order_id = '$order_id' AND type = 'n2'");
$slip2Data = $slip2res->fetch_assoc();


$messid = $orderData["messenger_id"];
$messengerNameRes = $con->query("select * from messenger where id = '$messid'");
$messData = $messengerNameRes->fetch_assoc();


$promoRes = $con->query("SELECT * FROM `promotion_use` WHERE order_id = '$order_id' and order_type = 'n'");
if ($promoRes->num_rows > 0) {
    $delivery = 0;
} else {
    $delivery = $delifeeData["deliveryfee"];
}
?>

<div class="modal-body">

    <div class="row" style="margin-top: 0px;">
        <div class="col-md-12">
            <?php if ($statusid == 2) {
                ?>
                <div class="col-md-12">
                    <div class="alert alert-danger" style="font-size: 18px" role="alert"> 
                        กรุณาโอนเงินค่ามัดจำสินค้าภายในเวลา 4 ชั่วโมง หลังจากร้านตอบรับรายการแล้ว <br>
                        และกรุณาแจ้งหลักฐานการโอนเงินไปยังร้านค้าตรวจสอบข้อมูล<br>
                        สามารถโอนไปที่บัญชี >><br>
                        <?php
                        $bankRes = $con->query("SELECT `id`, `accname`, `accNo`, `bank`, `restaurant_id` "
                                . "FROM `bank_account` WHERE restaurant_id = '$resid' ");
                        while ($bankData = $bankRes->fetch_assoc()) {
                            ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="info_res">ชื่อบัญชี: &nbsp;<?= $bankData["accname"] ?>&nbsp;เลขที่บัญชี &nbsp;<?= $bankData["accNo"] ?>&nbsp;<?= $bankData["bank"] ?></span><br>

                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if ($statusid == 4 && $orderData["payment_id"] == 2) {
                ?>
                <div class="col-md-12">
                    <div class="alert alert-danger" style="font-size: 18px"  role="alert">
                        กรุณาโอนเงินในส่วนที่เหลือและแจ้งหลักฐานการโอนเงินไปยังร้านค้าตรวจสอบข้อมูล<br>
                        สามารถโอนไปที่บัญชี >><br>
                        <?php
                        $bankRes = $con->query("SELECT `id`, `accname`, `accNo`, `bank`, `restaurant_id` "
                                . "FROM `bank_account` WHERE restaurant_id = '$resid' ");
                        while ($bankData = $bankRes->fetch_assoc()) {
                            ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="info_res">ชื่อบัญชี: &nbsp;<?= $bankData["accname"] ?>&nbsp;เลขที่บัญชี &nbsp;<?= $bankData["accNo"] ?>&nbsp;<?= $bankData["bank"] ?></span><br>

                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-7">
                <div class="card">
                    <?php
                    if ($statusid == 7) {
                        ?>
                        <div class="card-content">
                            <span style="font-size: 20px">สถานะของรายการ: </span>
                            <span style="font-size: 20px; color: orange;"> ปฏิเสธรายการ </span><br>
                            <span style="font-size: 20px">ปฏิเสธรายการโดย: </span>
                            <span style="font-size: 20px; color: orange;"> <?= $delifeeData["name"] ?> </span><br>
                            <span style="font-size: 20px">ปฏิเสธรายการวันที่: </span>
                            <span style="font-size: 20px; color: orange;"><?= substr($orderData["updated_status_time"], 0, 11) ?></span><br>
                            <span style="font-size: 20px">ปฏิเสธรายการเวลา: </span>
                            <span style="font-size: 20px; color: orange;"> <?= substr($orderData["updated_status_time"], 11, 5) ?> &nbsp;น. </span><br>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="card-content">
                            <?php if ($statusid == 1) { ?>
                                <span style="font-size: 20px">สถานะของรายการ: </span>
                                <span style="font-size: 20px; color: orange;"> <?= $statusData["description"] ?></span><br>
                                <span style="font-size: 20px">รอตอบรับรายการจากร้าน: </span>
                                <span style="font-size: 20px; color: orange;"> <?= $delifeeData["name"] ?>  </span><br>
                                <span style="font-size: 20px">วันที่สั่ง: </span>
                                <span style="font-size: 20px; color: orange;"> <?= substr($orderData["updated_status_time"], 0, 11) ?></span><br>
                                <span style="font-size: 20px">เวลาที่สั่ง: </span>
                                <span style="font-size: 20px; color: orange;"> <?= substr($orderData["updated_status_time"], 11, 5) ?>&nbsp;น.</span><br>

                            <?php } else {
                                ?>
                                <span style="font-size: 20px">สถานะของรายการ: </span>
                                <span style="font-size: 20px; color: orange;"> <?= $statusData["description"] ?></span><br>
                                <span style="font-size: 20px">ตอบรับรายการโดย: </span>
                                <span style="font-size: 20px; color: orange;"> <?= $delifeeData["name"] ?>  </span><br>
                                <span style="font-size: 20px">อัพเดตรายการวันที่: </span>
                                <span style="font-size: 20px; color: orange;"> <?= substr($orderData["updated_status_time"], 0, 11) ?></span><br>
                                <span style="font-size: 20px">อัพเดตรายการเวลา: </span>
                                <span style="font-size: 20px; color: orange;"> <?= substr($orderData["updated_status_time"], 11, 5) ?>&nbsp;น.</span><br>
                            <?php }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <?php
                    if ($statusid == 9) {
                        ?>
                        <div class="card-content">
                            <span style="font-size: 20px">จัดส่งสินค้าโดย: </span>
                            <span style="font-size: 20px; color: orange;"><?= $messData["name"] ?></span><br>
                            <span style="font-size: 20px">โทรศัพท์: </span>
                            <span style="font-size: 20px; color: orange;"><?= $messData["tel"] ?></span><br>

                            <span style="font-size: 20px">ส่งสินค้าถึงวันที่: </span>
                            <span style="font-size: 20px; color: orange;"><?= substr($orderData["updated_status_time"], 0, 11) ?></span><br>

                            <span style="font-size: 20px">ส่งสินค้าถึงเวลา: </span>
                            <span style="font-size: 20px; color: orange;">  <?= substr($orderData["updated_status_time"], 11, 5) ?>&nbsp;น. </span><br>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($statusid == 5) {
                        ?>
                        <div class="card-content">
                            <span style="font-size: 20px">จัดส่งสินค้าโดย: </span>
                            <span style="font-size: 20px; color: orange;"><?= $messData["name"] ?></span><br>
                            <span style="font-size: 20px">โทรศัพท์: </span>
                            <span style="font-size: 20px; color: orange;"><?= $messData["tel"] ?></span><br>

                        </div>
                        <?php
                    }
                    ?>

                </div>
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">วันที่นัดรับสินค้า: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $orderData["delivery_date"] ?></span><br>
                        <span style="font-size: 20px">เวลาที่นัดรับสินค้า: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $orderData["delivery_time"] ?>  </span><br>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">สถานที่ส่งสินค้า </span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <span style="font-size: 17px"><b>ที่อยู่:</b> &nbsp;<?= $shipAddressData["full_address"] ?></span><br>
                        <span style="font-size: 17px"><b>จุดสังเกต:</b> &nbsp;<?= $shipAddressData["address_naming"] ?>&nbsp;(<?= $shipAddressData["type"] ?>)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">รายการสินค้า </span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-list-search">
                                    <thead>
                                        <tr>
                                            <th>รายการ</th>
                                            <th style="text-align: center">ราคาต่อหน่วย/บาท</th>
                                            <th style="text-align: center">จำนวน</th>
                                            <th style="text-align: right">ราคารวม/บาท</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table table-condensed table-hover">
                                        <?php while ($orderDetailData = $orderDetailRes->fetch_assoc()) { ?>
                                            <tr>    
                                                <td>
                                                    <?php
                                                    $menuid = $orderDetailData["menu_id"];
                                                    $menuid = "(" . $menuid . ")";
                                                    $name = "";
                                                    $resName = $con->query("SELECT main_menu.name FROM menu LEFT JOIN main_menu ON menu.main_menu_id = main_menu.id WHERE menu.id IN $menuid");
                                                    $count = 0;
                                                    $price = 0;
                                                    while ($food = $resName->fetch_assoc()) {
                                                        $price += $orderDetailData["price"];
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
                                                <td style="text-align: center"><?= $price ?></td>
                                                <td style="text-align: center"><?= $orderDetailData["quantity"] ?></td>
                                                <td style="text-align: right"><?= $price * $orderDetailData["quantity"] ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>
                                                <span style="font-size: 20px">เพิ่มเติม: </span>
                                                <span style="font-size: 15px; color: red;">
                                                    <?php
                                                    while ($orderDetailData = $orderDetailRes->fetch_assoc()) {
                                                        $moretext = $orderDetailData["moretext"];
                                                        echo "<p>" . $moretext . "</p><br>";
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>   

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ราคาทั้งหมด</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table table-condensed table-hover">
                                        <tr class="success">
                                            <td>ราคารวม</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: right"><?= $orderData["total_nofee"] ?></td>
                                        </tr>
                                        <tr class="warning">
                                            <td>ค่ามัดจำ 20%</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: right"><?= $orderData["prepay"] ?></td>
                                        </tr>
                                        <tr>    
                                            <td>ค่าจัดส่ง</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: right">
                                                <?php
                                                if ($promoRes->num_rows > 0) {
                                                    echo 'ฟรี';
                                                } else {
                                                    echo $delivery;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="danger">              
                                            <td>ราคาในส่วนที่เหลือ (รวมค่าจัดส่ง)</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: right"><?= ($orderData["total_nofee"] - $orderData["prepay"]) + $delivery ?></td>
                                        </tr>
                                    </tbody>
                                </table>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 5px;">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">ชำระเงินด้วย:  &nbsp;
                            <?php
                            if ($orderData["payment_id"] == 2) {
                                echo 'โอนเงินผ่านธนาคาร';
                            } else {
                                echo 'เงินสดเมื่อได้รับสินค้า';
                            }
                            ?>
                        </span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <span style="font-size: 18px"> โอนเงินค่ามัดจำผ่าน: <span style="font-size: 18px; color: orange;"><?= ($slip1Data["detail"]) != null ? $slip1Data["detail"] : "ยังไม่มีการแจ้งข้อมูล" ?> </span> </span>
                        <br><br>
                        <span style="font-size: 20px">รูปภาพหลักฐานการโอน</span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <span style="font-size: 15px; color: red;">
                            <?php
                            $path1 = $slip1Data["slip_path"];
                            if ($slip_pathRes->num_rows == 0) {
                                echo 'ยังไม่มีการแจ้งข้อมูล';
                            } else if ($path1 != null) {
                                echo "<img src=\"" . $path1 . " \">";
                            } else {
                                echo 'ไม่มีการอัพโหลดรูปสลิปการโอนเงิน';
                            }
                            ?>

                        </span>
                    </div>
                </div>
            </div>
        </div> <?php if ($orderData["payment_id"] == 2 ) { ?>
        <div class="col-md-12">
            <div class="col-md-12">
               
                    <div class="card">
                        <div class="card-content">
                            <span style="font-size: 20px">ชำระเงินด้วยการโอนเงินผ่านธนาคาร: &nbsp;</span>
                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                            <span style="font-size: 18px"> โอนเงินผ่านธนาคาร: <span style="font-size: 18px; color: orange;"><?= ($slip2Data["detail"]) != null ? $slip1Data["detail"] : "ยังไม่มีการแจ้งข้อมูล" ?> </span> </span>
                            <br><br>
                            <span style="font-size: 20px">รูปภาพหลักฐานการโอน </span>
                            <hr style="margin-top: 5px;margin-bottom: 10px;">
                            <span style="font-size: 15px; color: red;">
                                <?php
                                $path = $slip2Data["slip_path"];
                                if ($slip2res->num_rows == 0) {
                                    echo 'ยังไม่มีการแจ้งข้อมูล';
                                } else if ($path != null) {
                                    echo "<img src=\"" . $path . " \">";
                                } else {
                                    echo 'ไม่มีการอัพโหลดรูปสลิปการโอนเงิน';
                                }
                                ?>

                            </span>
                        </div>
                    </div>
                
            </div>
        </div>
            <?php } ?>
    </div>
    <hr style="margin-top: 50">
    <button <?= ($statusid > 5) ? "style=\"margin-left: 810\"" : "style=\"margin-left: 680\"" ?>  type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
    <button <?= ($statusid > 5) ? "style=\"display: none\"" : "style=\"margin-left: 20;" ?> type="button" class="btn btn-danger cancelNormalOrderBtn" id="cancelNormalOrderBtn">ขอยกเลิกรายการ</button>
</div>


