<?php
include '../../dbconn.php';
$cusid = $_POST["cusid"];
$resid = $_POST["resid"];

$orderRes = $con->query("SELECT SUM(order_detail.quantity) as allqty "
        . "FROM `order_detail` WHERE customer_id = '$cusid' and restaurant_id ='$resid' and status = '0'");
$orderData = $orderRes->fetch_assoc();
$orderAllQty = $orderData["allqty"];

$orderDetailRes = $con->query("SELECT `id`, `quantity`, `price`, `set_type`, "
        . "`menu_id`, `created_time`, `status`,  `customer_id`,"
        . " `restaurant_id`"
        . " FROM `order_detail` "
        . "WHERE customer_id = '$cusid' and restaurant_id ='$resid' and status = '0' ");
$resNameRes = $con->query("select  deliveryfee"
        . " from restaurant "
        . "join mapping_delivery_type on mapping_delivery_type.restaurant_id = restaurant.id  "
        . " where id = '$resid'");
$resNameData = $resNameRes->fetch_assoc();

$promoRes = $con->query("select * from promotion "
        . "LEFT JOIN promotion_main ON promotion_main.id = promotion.promotion_main_id "
        . "where restaurant_id = '$resid' "
        . "and end_time >= date(now()) and start_time <= date(now()) and promotion_main.id = 1");


if ($promoRes->num_rows > 0) {
    $delivery = 0;
} else {
    $delivery = $resNameData["deliveryfee"];
}

$totalprice = 0;

$sumprice = 0;
$prepay = 0;
$diffprice = 0;

if ($orderDetailRes->num_rows == 0) {
    ?>
    <img src="/assets/images/New folder/shoplist_b_c.png" style="width: 150px; margin-left: 90px;">
    <h3 class="text-center">คุณยังไม่มีรายการสั่งซื้อ</h3>
    <?php
} else {
    ?>


    <table class="table table-hover" id="task-table">
        <thead>
            <tr>
                <th></th>
                <th>รายการอาหารที่เลือก</th>
                <th>ชุด</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="menuOrderList">

            <?php
            while ($orderDetailData = $orderDetailRes->fetch_assoc()) {

                $totalprice += $orderDetailData["price"] * $orderDetailData["quantity"];


                /* $menuid = $orderDetailData["menu_id"];
                  $menuid = "(" . $menuid . ")";

                  $resName = $con->query("SELECT menu.price, main_menu.name FROM menu "
                  . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                  . "WHERE menu.id IN $menuid");
                  $foodname = "";
                  $i = 0;
                  while ($dataName = $resName->fetch_assoc()) {

                  $foodname .= $dataName["name"];
                  $i++;
                  if ($i < $resName->num_rows) {
                  $foodname .= "+";
                  }
                  } */
                ?> 
                <tr>
                    <td>
                        <p class="remove_cart"  id="remove_cart<?= $orderDetailData["id"] ?>" style="color: red" data-toggle="tooltip" data-placement="top" title="ลบรายการอาหารนี้?">
                            <i class="glyphicon glyphicon-remove-sign"></i>
                        </p>
                    </td>
                    <td> 
                        <ul style="list-style: none; padding: 0;">
                            <span style="font-size: 14px; color: gray">(<?= $orderDetailData["price"] ?>&nbsp;ราคา/หน่วย)</span>
                            <?php
                            $menuid = $orderDetailData["menu_id"];
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
                    <td>
                        <div class="form-group">
                            <input type="number" id="qty<?= $orderDetailData["id"] ?>" class="qty form-control"  value="<?= $orderDetailData["quantity"] ?>" style="width: 60px">
                        </div>
                    </td> 
                    <td><?= $orderDetailData["price"] * $orderDetailData["quantity"] ?>&nbsp;บาท</td>

                </tr>
            <?php } ?>

        </tbody>
    </table>
    <div id="errorChangeQty"></div>
    <table class="table table-hover" id="task-table">
        <thead>
            <tr>
                <th>ราคาทั้งหมด</th>
                <th style="color: #FF9900"  ></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="priceOfOrder">
            <tr>
                <td>จำนวน: </td>
                <td style="color: #FF9900" ><?= $orderAllQty ?> </td>
                <td>ชุด</td>
            </tr>
            <tr>
                <td>ราคา: </td>
                <td style="color: #FF9900" ><?= $totalprice ?>
                    <input type="hidden" id="totalprice" value="<?= $totalprice ?>">
                </td>
                <td>บาท</td>
            </tr>
            <tr>
                <td>ค่ามัดจำ 20%: </td>
                <td style="color: #FF9900" ><?= $prepay = 0.2 * $totalprice ?>
                    <input type="hidden" id="showprepay" value="<?= $prepay = 0.2 * $totalprice ?>"> 
                </td>
                <td>บาท</td>
            </tr>
            <tr>
                <td>ค่าจัดส่ง: </td>
                <td style="color: #FF9900" >
                    <?php
                    if ($promoRes->num_rows > 0) {
                        echo 'ฟรี';
                    } else {
                        echo $delivery;
                    }
                    ?>
                    <input type="hidden" id="deliveryfee" value="<?= $delivery ?>">
                </td>
                <td>บาท</td>
            </tr>
            <tr>
                <td style="color: red" >ราคาส่วนที่เหลือ*</td>
                <td style="color: #FF9900" ><?= ($totalprice - $prepay) + $delivery ?>
                    <input type="hidden"id="sumprice" value="<?= ($totalprice - $prepay) + $delivery ?>">
                </td>
                <td>บาท</td>
            </tr>


        </tbody>
    </table>
    <hr style="border: solid 1px">
    <p>*ราคาส่วนที่เหลือนั้น ลูกค้าจะต้องชำระด้วยเงินสดหรือโอนเงินผ่านธนาคาร</p>

    <?php
}
?>