<?php
session_start();
include '../dbconn.php';
$resid = $_SESSION["restdata"]["id"];
$order_id = $_POST["id"];
$resNameRes = $con->query("select  deliveryfee"
        . " from restaurant "
        . "join mapping_delivery_type on mapping_delivery_type.restaurant_id = restaurant.id  "
        . " where id = '$resid'");
$delifeeData = $resNameRes->fetch_assoc();

$orderRes = $con->query("SELECT * FROM `normal_order` LEFT JOIN customer ON customer.id = normal_order.customer_id WHERE normal_order.id ='$order_id'");
$orderData = $orderRes->fetch_assoc();

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
?>

<div class="modal-body">

    <div class="row" style="margin-top: 0px;">
        <div class="col-md-12">
            <div class="col-md-7">
                <div class="card">
                    <?php
                    if ($statusid == 7) {
                        ?>
                        <div class="card-content">
                            <span style="font-size: 20px">สถานะของรายการ: </span>
                            <span style="font-size: 20px; color: orange;"> ปฏิเสธรายการ </span><br>
                            <span style="font-size: 20px">ปฏิเสธรายการโดย: </span>
                            <span style="font-size: 20px; color: orange;"> <?= $_SESSION["restdata"]["name"] ?> </span><br>
                            <span style="font-size: 20px">ปฏิเสธรายการวันที่: </span>
                            <span style="font-size: 20px; color: orange;"><?= substr($orderData["updated_status_time"], 0, 11) ?></span><br>
                            <span style="font-size: 20px">ปฏิเสธรายการเวลา: </span>
                            <span style="font-size: 20px; color: orange;"> <?= substr($orderData["updated_status_time"], 11, 5) ?> &nbsp;น. </span><br>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="card-content">
                            <span style="font-size: 20px">สถานะของรายการ: </span>
                            <span style="font-size: 20px; color: orange;"> <?= $statusData["description"] ?></span><br>
                            <?php if($orderData["status"] > 1) { ?>

                                <span style="font-size: 20px">ตอบรับรายการวันที่: </span>
                                <span style="font-size: 20px; color: orange;"> <?= substr($orderData["updated_status_time"], 0, 11) ?></span><br>
                                <span style="font-size: 20px">ตอบรับรายการเวลา: </span>
                                <span style="font-size: 20px; color: orange;"> <?= substr($orderData["updated_status_time"], 11, 5) ?>&nbsp;น.</span><br>
                            <?php } ?>
                        </div>
                        <?php
                    }
                    ?>


                </div>
                <?php ?>

                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">หมายเลขสมาชิกลูกค้า: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $orderData["id"] ?> </span><br>

                        <span style="font-size: 20px">ชื่อ: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $orderData["firstName"] ?>&nbsp;<?= $orderData["lastName"] ?> </span><br>

                        <span style="font-size: 20px">โทรศัพท์: </span>
                        <span style="font-size: 20px; color: orange;"><?= $orderData["tel"] ?> </span>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <?php
                    if ($statusid == 9) {
                        ?>
                        <div class="card-content">
                            <span style="font-size: 20px">จัดส่งสินค้าโดย: </span><br>
                            <span style="font-size: 20px; color: orange;">108suchart สุชาติ ปานขำ</span><br>
                            <span style="font-size: 20px">โทรศัพท์: </span><br>
                            <span style="font-size: 20px; color: orange;">0812345678</span><br>

                            <span style="font-size: 20px">ส่งสินค้าถึงวันที่: </span><br>
                            <span style="font-size: 20px; color: orange;"><?= substr($orderData["updated_status_time"], 0, 11) ?></span><br>

                            <span style="font-size: 20px">ส่งสินค้าถึงเวลา: </span><br>
                            <span style="font-size: 20px; color: orange;">  <?= substr($orderData["updated_status_time"], 11, 5) ?>&nbsp;น. </span><br>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <div class="card">
                    <div class="card-content">

                        <span style="font-size: 20px">วันที่ลูกค้านัดรับสินค้า: </span>
                        <span style="font-size: 20px; color: orange;"> <?= $orderData["delivery_date"] ?></span><br>
                        <span style="font-size: 20px">เวลาที่ลูกค้านัดรับสินค้า: </span>
                        <span style="font-size: 20px; color: orange;"> <?= substr($orderData["delivery_time"], 0, 5) ?>&nbsp;น.  </span><br>

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
                                        <!--<tr class="warning">
                                            <td>ส่วนลด10% 1D23A5</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center">1</td>
                                            <td style="text-align: center">-160.00</td>
                                        </tr>-->
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
                                            <td style="text-align: right"><?= $delifeeData["deliveryfee"] ?></td>
                                        </tr>
                                        <tr class="danger">              
                                            <td>ราคารวมทั้งหมด</td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: right"><?= $orderData["total_nofee"] - $orderDetailData["prepay"] ?></td>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">เพิ่มเติม </span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <span style="font-size: 15px; color: red;">
                            <?php
                            while ($orderDetailData = $orderDetailRes->fetch_assoc()) {
                                $moretext = $orderDetailData["moretext"];
                                echo "<p>" . $moretext . "</p><br>";
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <span style="font-size: 20px">การชำระเงิน </span>
                        <hr style="margin-top: 5px;margin-bottom: 10px;">
                        <span style="font-size: 15px"> โอนเงินมัดจำผ่านธนาคาร: <br><span style="font-size: 15px; color: orange;"> กสิกรไทย เลขที่ 12-1231212-1 <br> 400.00 บาท</span> </span> &nbsp; 

                        <a href="#" class="btn btn-warning btn-xs "data-toggle="modal" data-target='.pop-up-2' href=".pop-up-2" style="margin-left: 90px;">แสดงสลิป</a><br>

                        <span style="font-size: 15px"> ชำระเงินด้วยเงินสด: <br><span style="font-size: 15px; color: red;"> ต้องชำระเพิ่ม ณ ที่รับสินค้า 1040.00 บาท </span> </span> &nbsp; 


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
