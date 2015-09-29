<?php
include '../../api/islogin.php';
include '../../dbconn.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pixupfood - Order</title>
        <?php include '../../template/customer-title.php'; ?>
        <link rel="stylesheet" href="/assets/css/fast_order.css">
    </head>
    <body>
        <?php
        $customerData = $_SESSION["userdata"];
        $orderMenu_id = @$_GET["menuId"];
        ?>
        <?php include '../../template/customer-navbar.php'; ?>

        <!-- start profile -->
        <section id="fast_head">
            <div class="overlay">
                <div class="container text-center">
                    <h1>Fast Order</h1>
                    <h4>สั่งอาหารด่วน</h4>
                </div>
            </div>
        </section>
        <!-- container -->
        <section id="fast_order">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active">
                                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-folder-open"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-picture"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="step4">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="step5">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step6" data-toggle="tab" aria-controls="complete" role="tab" title="step6">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="page-header">
                                                ขั้นตอนที่ 1 : เลือกกล่อง
                                            </div>
                                            <div class="row">
                                                <?php
                                                $foodboxRes = $con->query("SELECT food_box.id, food_box.description, food_box.img_path "
                                                        . "FROM food_box ");

                                                while ($foodboxData = $foodboxRes->fetch_assoc()) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <div class="thumbnail">
                                                            <a href="#"><img class="menu_img" src="<?= $foodboxData["img_path"] ?>"></a>
                                                            <div class="caption">

                                                                <p><?= $foodboxData["description"] ?></p>
                                                                <p style="text-align: right">
                                                                    <input type="radio" name="foodboxtype" class="foodboxtype" id="foodboxtype<?= $foodboxData["id"] ?>" value="<?= $foodboxData["id"] ?>">
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right" style="margin-top: 20px;">
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="page-header">
                                                ขั้นตอนที่ 2 : เลือกข้าว
                                            </div>
                                            <div class="row">
                                                <?php
                                                $riceListRes = $con->query("SELECT main_menu.name, main_menu.id FROM  main_menu WHERE main_menu.type = 'ชนิดข้าว'");

                                                while ($riceData = $riceListRes->fetch_assoc()) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <div class="thumbnail">
                                                            <a href="#"><img class="menu_img" src=""></a>
                                                            <div class="caption">
                                                                <h4><?= $riceData["name"] ?></h4>
                                                                <p style="text-align: right">
                                                                    <input type="radio" name="ricetype" class="ricetype" id="ricetype<?= $riceData["id"] ?>" value="<?= $riceData["name"] ?>">
                                                                    <input type="hidden" class="ricetypedata" id="ricetypedata<?= $riceData["id"] ?>" value="<?= $riceData["price"] ?>"> 

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right" style="margin-top: 20px;">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="page-header">
                                                ขั้นตอนที่ 3 : เลือกกับข้าว
                                            </div>
                                            <h4 style="color: #FF5F00">สามารถเลือกรายการได้ตามรูปแบบของกล่อง (ไม่เกิน 3 รายการ)</h4>


                                            <div class="row">
                                                <?php
                                                $foodListRes = $con->query("SELECT DISTINCT main_menu.id, menu.img_path,  main_menu.name as menuname, "
                                                        . "food_type.description as foodtype, main_menu.type, main_menu.img_path as img  "
                                                        . "FROM menu JOIN restaurant ON menu.restaurant_id = restaurant.id "
                                                        . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                        . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                        . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                        . "WHERE main_menu.type != 'เมนูเซต'"
                                                        . " GROUP BY main_menu.name ");

                                                while ($foddListData = $foodListRes->fetch_assoc()) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <div class="thumbnail">
                                                            <a href="#"><img class="menu_img" src="<?= $foddListData["img"] ?>" style="max-height: 101px;min-height: 101px"></a>
                                                            <div class="caption">
                                                                <h4><?= $foddListData["menuname"] ?></h4>

                                                                <p style="text-align: right">
                                                                    <input type="checkbox" name="foodlist[]" class="foodlist" id="foodlist<?= $foddListData["id"] ?>" value="<?= $foddListData["menuname"] ?>">

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                                ?>
                                            </div> <!--<hr class="hrs">-->


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="page-header">
                                                        เพิ่มเติม
                                                    </div>
                                                    <textarea rows="3" placeholder="หมายเหตุเพิ่มเติม เช่น ไม่เผ็ด ไม่ใส่ผัก" style="width: 100%"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right" style="margin-top: 20px;">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="page-header">
                                                ขั้นตอนที่ 4 : เลือกวัน เวลา และสถานที่จัดส่ง
                                            </div>
                                            <div>
                                                <h4>ส่งวันที่:     
                                                    <span id="datetext"></span><input type="date" name="delivery_date" required="">
                                                    <input type="text" name="date" id="datepick" style="display: none" >
                                                </h4>
                                            </div>
                                            <div>
                                                <h4>เวลา:<br>
                                                    <select name="delivery_time" id="delivery_time" class="col-md-3" >
                                                        <option value="0">--เวลาจัดส่ง--</option>
                                                        <option value="06:30:00">06:30 น.</option>
                                                        <option value="07:30:00">07:30 น.</option>
                                                        <option value="08:30:00">08:30 น.</option>
                                                        <option value="09:30:00">09:30 น.</option>
                                                        <option value="10:30:00">10:30 น.</option>
                                                        <option value="11:30:00">06:30 น.</option>
                                                        <option value="12:30:00">12:30 น.</option>
                                                        <option value="13:30:00">13:30 น.</option>
                                                        <option value="14:30:00">14:30 น.</option>
                                                        <option value="15:30:00">15:30 น.</option>
                                                        <option value="16:30:00">16:30 น.</option>
                                                        <option value="17:30:00">17:30 น.</option>
                                                        <option value="18:30:00">18:30 น.</option>
                                                    </select>
                                                </h4>
                                            </div><br>
                                            <h3>สถานที่จัดส่ง:</h3>
                                            <div class="content2">
                                                <table class="table table-hover" id="task-table">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="3">Address</th>
                                                            <th>Select</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $i = 1;

                                                        $shipAddressRes = $con->query("SELECT CONCAT(shippingAddress.address,' ประเภท',shippingAddress.type,'(', shippingAddress.address_naming,')') AS ship_address, shippingAddress.id,shippingAddress.address  FROM `shippingAddress` WHERE customer_id = '$cusid'");

                                                        while ($shipAddressData = $shipAddressRes->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td colspan="3"><?= ($shipAddressData['ship_address'] == "" ? $shipAddressData["address"] : $shipAddressData['ship_address']) ?></td>
                                                                <td><input type="radio"  name="shipAddress" value="<?= $shipAddressData["id"] ?>"> </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>
                                                        <tr id="showdata">

                                                        </tr>
                                                        <tr id="showerror">

                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div id="inbox" style="margin:15% 0 0 0;">
                                                        <div class="fab btn-group show-on-hover dropup" id="add_sa" data-toggle="modal" data-target="#add_address">
                                                            <button type="button" class="btn btn-danger glyphicon glyphicon-plus btn-io">
                                                                <span class="fa-stack fa-2x">
                                                                    <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
                                                                    <i class="fa fa-plus fa-stack-1x fa-inverse fab-primary"></i>
                                                                    <i class="fa fa-plus fa-stack-1x fa-inverse fab-secondary"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right" style="margin-top: 20px;">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step5">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="page-header">
                                                        ขั้นตอนที่ 5 : เลือกวิธีชำระเงิน
                                                    </div>
                                                </div>                                                                                             

                                                <?php
                                                $bankRes = $con->query("SELECT `id`, `accname`, `accNo`, `bank`, `restaurant_id` "
                                                        . "FROM `bank_account` WHERE restaurant_id = '$resid' ");


                                                $paymentRes = $con->query("SELECT payment_type.id, payment_type.description FROM payment_type ");
                                                while ($paymentData = $paymentRes->fetch_assoc()) {
                                                    ?>
                                                    <div class="input-group col-md-12" style="margin: 10px 120px;"  >
                                                        <input type="radio"  name="paymentData" value="<?= $paymentData["id"] ?>"><?= $paymentData["description"] ?>
                                                    </div>
                                                <?php } ?>
                                                <hr>
                                                <div>
                                                    *สามารถโอนเงินผ่านบัญชีธนาคาร&nbsp;&nbsp;<br>
                                                    <?php
                                                    while ($bankData = $bankRes->fetch_assoc()) {
                                                        ?>
                                                        <p>ชื่อบัญชี: &nbsp;<?= $bankData["accname"] ?>&nbsp;เลขที่บัญชี &nbsp;<?= $bankData["accNo"] ?>&nbsp;<?= $bankData["bank"] ?></p>

                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right" style="margin-top: 20px;">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step6">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="page-header">
                                                ขั้นตอนที่ 6 : เลือกร้านอาหาร
                                            </div>
                                            <div class="row">
                                                    <?php
                                                    $resfromMenuRes = $con->query("SELECT DISTINCT main_menu.id,  main_menu.name as menuname, menu.price,main_menu.type,"
                                                            . " restaurant.id as resid, restaurant.name as resname, restaurant.img_path "
                                                            . "FROM menu "
                                                            . "JOIN restaurant ON menu.restaurant_id = restaurant.id "
                                                            . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                            . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                            . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                            . "WHERE main_menu.id = '$menuSetId'");
                                                    while ($resData = $resfromMenuRes->fetch_assoc()) {
                                                        ?>
                                                        <div class="col-md-4">
                                                            <h1>ร้านป้าลมัย <input type="checkbox" name="sex" value="male"></h1><hr class="hrs">
                                                            <table class="table table-hover" id="task-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Order List</th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>เมนูที่เลือก: </td>
                                                                        <td>ข้าวผัดกระเพรา+หมูกระเทียม</td>
                                                                        <td>300 กล่อง</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ราคา: </td>
                                                                        <td>10000</td>
                                                                        <td>บาท</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ค่าจัดส่ง: </td>
                                                                        <td>100</td>
                                                                        <td>บาท</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ราคารวม: </td>
                                                                        <td>10100</td>
                                                                        <td>บาท</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    <?php } ?>

                                                <a href="#" >
                                                    <span class="pull-right" style="color: #0016b0;margin-right: 10px;">
                                                        more>>>
                                                    </span>
                                                </a>
                                            </div>   
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right" style="margin-top: 20px;">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Order</button></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-------modal add address------------------------------>
                <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="shipping_address">
                    <div class="modal-dialog" role="document"><img src="/assets/images/allnews/news03.jpg"
                                                                   <div class="modal-content">
                            <form action="/customer/ajax-address-shipping.php" id="addressform" name="addressform" method="post">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="shipping_address">เพิ่มที่จัดส่งสินค้า</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" value="<?= $cusid ?>" name="cusid">
                                    <label for="address">รายละเอียดที่จัดส่งสินค้า:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                    <div class="form-group">
                                        <textarea required class="form-control" placeholder="ที่จัดส่งสินค้า" rows="3"  name="address" id="address"></textarea>
                                    </div>
                                    <label for="addtype">ประเภทที่อยู่อาศัย:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                    <div class="form-group" >
                                        <select name="addtype" id="addtype" class="col-sm-12" required>
                                            <option value="อพาร์ทเมนท์">อพาร์ทเมนท์</option>
                                            <option value="สถานที่ราชการ">สถานที่ราชการ</option>
                                            <option value="มหาวิทยาลัย">มหาวิทยาลัย</option>
                                            <option value="โรงพยาบาล">โรงพยาบาล</option>
                                            <option value="โรงแรม">โรงแรม</option>
                                            <option value="บ้าน">บ้าน</option>
                                            <option value="ตลาด">ตลาด</option>
                                            <option value="โรงเรียน">โรงเรียน</option>
                                            <option value="ร้านค้า">ร้านค้า</option>
                                            <option value="วัด">วัด</option>
                                            <option value="อื่นๆ">อื่นๆ</option>
                                        </select>
                                    </div>
                                    <label for="addnaming">กรุณาใส่ข้อมูลระบุที่จัดส่งเพื่อความรวดเร็ว:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                    <div class="form-group">
                                        <input required class="form-control" placeholder="ชื่อเรียกที่จัดส่งเพื่อความรวดเร็ว"  name="addnaming" id="addnaming">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <input type="reset" class="btn btn-warning col-sm-3" name="resetbtn" value="Reset" >
                                        <input type="submit" class="btn btn-primary col-sm-3" name="addbtn"  value="Add" >
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        <?php include '../../template/footer.php'; ?>
    </body>
</html>