<?php
include '../dbconn.php';
include '../api/islogin.php';
?>

<html>
    <head>
        <title>Pixupfood - Restaurant View</title>

        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/restaurant_view.css">

        <link href='/assets/css/fullcalendar.css' rel='stylesheet' />
        <link href='/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
        <link rel="stylesheet" href="/assets/css/normal_order.css">
        <link rel="stylesheet" href="/assets/css/check-radio.css">
        <link rel="stylesheet" href="/assets/css/customer-comment.css">
        <style>
            #restaurant_view .menu_img{
                width: 100%;
                max-width: 100%;
                height: 100px;
            }
            #showcalendar a span {
                color: #ffffff;
                font-size: 12.5px;
            }
            #addressoverlay {
                background-color: rgba(255,255,255,0.2);
                width: 100%;
                height: 650px;
                position: absolute;
                top: 160px;
                left: 0;
                z-index: 10;
            }
        </style>


    </head>
    <body>
        <?php
        $orderMenu_id = @$_GET["menuId"];
        $menusetRes = $con->query("SELECT menu.id,  main_menu.name as menusetname, menu.price,main_menu.type,"
                . " restaurant.id as resid, restaurant.name as resname, restaurant.img_path "
                . "FROM menu "
                . "JOIN restaurant ON menu.restaurant_id = restaurant.id "
                . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                . "WHERE menu.id = '$orderMenu_id'");
        $menusetData = $menusetRes->fetch_assoc();
        print_r($menusetData);

        $cusid = $_SESSION["userdata"]["id"];
        $customerRes = $con->query("select customer.id, customer.firstName, customer.lastName,"
                . " customer.email, customer.tel, customer.address   "
                . "from customer "
                . "where id = '$cusid' ");
        $customerData = $customerRes->fetch_assoc();

        $orderMenu_id = @$_GET["menuId"];
        $resid = @$_GET["resId"];
        $resNameRes = $con->query("select `name`, `email`, `tel`,`detail`, `img_path`, `star`, `address`,"
                . " `opentime`, `amount_box_minimum`, `amount_box_limit`, `has_restaurant`, `restaurant_type`"
                . ", deliveryfee, close"
                . " from restaurant "
                . "join mapping_delivery_type on mapping_delivery_type.restaurant_id = restaurant.id  "
                . " where id = '$resid'");
        $resNameData = $resNameRes->fetch_assoc();
        ?>
        <?php include '../template/customer-navbar.php'; ?>
        <input type="hidden" value="<?= $resid ?>" class="getResId" >
        <input type="hidden" value="<?= $cusid ?>" class="getCusId" >
        <input type="hidden" value="<?= $resNameData["amount_box_minimum"] ?>" class="getBoxMinimum" >
        <!-- edit head -->
        <section id="restaurant_view_head">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= ($resNameData["name"] == "" ? $resNameData["name"] : $resNameData["name"]) ?></h1>
                    <div class="row lead">
                        <?php include '../customer-view-restaurant/star-head.php'; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- edit body -->
        <section id="restaurant_view">
            <div class="container">
                <?php
                $close = $resNameData["close"];
                if ($close == '1') {
                    ?>
                    <div class="alert alert-info" role="alert">
                        <p style="font-size: 16px"> 
                            <i class="glyphicon glyphicon-info-sign"></i> &nbsp; ปิดรับออเดอร์ชั่วคราว
                        </p>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <p style="font-size: 16px"><b>สถานที่จัดส่งสินค้า:</b> &nbsp;
                            <?php
                            $placeRes = $con->query("SELECT data_district.district_name "
                                    . "FROM data_district "
                                    . "RIGHT JOIN delivery_place ON delivery_place.district_id = data_district.district_id "
                                    . "WHERE delivery_place.restaurant_id = '$resid'");
                            $place = "";
                            $i = 0;
                            if ($placeRes->num_rows == 0) {
                                echo 'ทุกพื้นที่';
                            } else {
                                while ($placeData = $placeRes->fetch_assoc()) {
                                    $place = $placeData["district_name"];
                                    $i++;
                                    if ($i < $placeRes->num_rows) {
                                        $place .= "," . " ";
                                    }
                                    echo $place;
                                }
                            }
                            ?>
                        </p>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-md-8">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" ><a href="/view/cus_restaurant_view_news.php?resId=<?= $resid ?>" >ข่าวประกาศ</a></li>
                            <li role="presentation"><a href="/view/cus_restaurant_view_promotion.php?resId=<?= $resid ?>" >โปรโมชั่น</a></li>
                            <li role="presentation" class="active"><a href="/view/cus_restaurant_view.php?resId=<?= $resid ?>&menuId<?= $orderMenu_id ?>" >สั่งอาหาร</a></li>
                            <li role="presentation"><a href="/view/cus_restaurant_view_info.php?resId=<?= $resid ?>" >ข้อมูลร้าน</a></li>
                            <li role="presentation"><a href="/view/cus_restaurant_view_comment.php?resId=<?= $resid ?>" >รีวิว / คอมเม้นท์</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Order -->
                            <div role="tabpanel" class="tab-pane active" id="order">
                                <div class="wizard">
                                    <div class="wizard-inner">
                                        <div class="connecting-line"></div>
                                          <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="disabled">
                                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-th-list"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li role="presentation" class="disabled">
                                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-ok"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-ok"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="active">
                                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-map-marker"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-calendar"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step6" data-toggle="tab" aria-controls="step6" role="tab" title="Step 6">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-credit-card"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="block" style="position: absolute; top:0; left:0; width:100%; height:100px; background-color:rgba(0,0,0,0); z-index:2;"></div>
                                    </div>


                                    <div class="tab-content">
                                        <div class="tab-pane active" role="tabpanel" id="step4">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="row">
                                                        <div class="page-header" style="margin-left:16px;">
                                                            ขั้นตอนที่ 4 : เลือกสถานที่จัดส่ง
                                                        </div>

                                                        <div class="col-sm-12" id="addressoverlay"></div>

                                                        <div class="col-sm-9">
                                                            ที่อยู่ที่บันทึกไว้ : 
                                                            <select class="form-control" id="oldaddress">
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <button id="addaddressbtn" class="btn btn-warning" style="margin-top:20px">
                                                                <span class="glyphicon glyphicon-plus"></span> 
                                                                เพิ่มที่อยู่ใหม่
                                                            </button>
                                                            <button id="oldaddressbtn" class="btn btn-warning" style="margin-top:20px; display:none;">
                                                                <span class="glyphicon glyphicon-remove"></span> 
                                                                ใช้ที่อยู่เก่า
                                                            </button>
                                                        </div>

                                                        <div class="col-sm-12"><br></div>

                                                        <div class="col-sm-9">
                                                            ชื่อสถานที่ / จุดสังเกต : 
                                                            <input class="form-control" placeholder="กรอกจุดสังเกต เช่น ชื่อสถานที่ อาคาร" name="address" id="addresstxt">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            ประเภทสถานที่ : 
                                                            <select class="form-control" id="addresstype">
                                                                <option value="0" selected disabled>เลือกประเภท</option>
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
                                                        <div class="col-sm-9">
                                                            <textarea  class="form-control" disabled="" placeholder="กรุณาลากวางมุดตรงที่อยู่ของคุณก่อนแก้ไขข้อมูลให้ถูกต้อง" rows="3" id="addressinput" name="addressinput" style="margin: 0;"></textarea>
                                                        </div>
                                                        <div class='col-sm-12'>
                                                            <div class="address">
                                                                <div id='showaddress' class='col-sm-6'>
                                                                    ลากและวางหมุดตรงที่อยู่ในการจัดส่งของคุณ
                                                                </div>
                                                                <div class='col-sm-6' style="text-align: right;">
                                                                    <button id="getlocationbtn" class="btn btn-warning" style="display:none;">
                                                                        <span class="glyphicon glyphicon-map-marker"></span>
                                                                        ดึงตำแหน่งปัจจุบันของคุณ
                                                                    </button>
                                                                    <button id="savenewaddressbtn" class="btn btn-success" style="display: none;">
                                                                        <span class="glyphicon glyphicon-ok-circle"></span>
                                                                        บันทึกที่อยู่
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div id="map"></div>
                                                        </div>
                                                    </div>
                                                    <div id="errorStep4"></div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                <li>
                                                    <button type="button" class="btn btn-warning next-step " id="nextstep4" <?= ( $resNameData["close"] == "0") ? "" : " disabled" ?>>
                                                        ดำเนินการต่อ 
                                                        <span class="glyphicon glyphicon glyphicon-chevron-right"></span>
                                                    </button>
                                                </li>
                                            </ul>
                                            <ul class="list-inline"  style="margin-top: 20px">
                                                <li>
                                                    <a href="/view/cus_restaurant_view.php?resId=<?= $resid ?>">
                                                        <button type="button" class="btn btn-danger " id="addNewOrder" <?= ( $resNameData["close"] == "0") ? "" : " data-toggle=\"tooltip\" " ?>  class="tooltip-r" data-placement="top" title="วันนี้ร้านปิดรับออเดอร์ชั่วคราว สามารถเพิ่มรายการอาหารเก็บไว้ในตะกร้าได้"> 
                                                            <span class=" glyphicon glyphicon-plus-sign"></span>&nbsp;สั่งซื้อต่อไป
                                                        </button>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>                                   

                                        <div class="tab-pane" role="tabpanel" id="step5">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="row">
                                                        <div class="page-header" style="margin-left:16px;">
                                                            ขั้นตอนที่ 5 : เลือกวัน เวลาจัดส่ง
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-5">
                                                                <h3>ส่งวันที่ :</h3>
                                                                <div id="calendar" ></div>
                                                            </div>
                                                            <div class="col-sm-7">
                                                                <?php include '../api/delivery-time-range.php';?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="errorStep5"></div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                <li><button type="button" class="btn btn-default prev-step"> <span class="glyphicon glyphicon glyphicon-chevron-left"></span>ย้อนกลับ</button></li>
                                                <li><button type="button" class="btn btn-warning next-step nextStep5" id="nextstep5">ดำเนินการต่อ <span class="glyphicon glyphicon glyphicon-chevron-right"></span></button></li>
                                            </ul>
                                        </div>                                   


                                        <div class="tab-pane" role="tabpanel" id="step6">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header">
                                                        ขั้นตอนที่ 6 : เลือกวิธีชำระเงิน
                                                    </div>

                                                    <?php
                                                    $bankRes = $con->query("SELECT `id`, `accname`, `accNo`, `bank`, `restaurant_id` "
                                                            . "FROM `bank_account` WHERE restaurant_id = '$resid' ");

                                                    $resPaymentRes = $con->query("select payment_type.id, payment_type.description "
                                                            . "FROM mapping_payment_type "
                                                            . "LEFT JOIN payment_type ON mapping_payment_type.payment_type_id = payment_type.id "
                                                            . "where mapping_payment_type.restaurant_id = '$resid' ");
                                                    $paymentRes = $con->query("SELECT payment_type.id, payment_type.description FROM payment_type ");
                                                    while ($paymentData = $resPaymentRes->fetch_assoc()) {
                                                        ?>
                                                        <div class="input-group col-md-12" style="margin: 10px 120px;"  >
                                                            <label class="Form-label--tick">
                                                                <input type="radio" class=" Form-label-radio"  name="paymentData" value="<?= $paymentData["id"] ?>">
                                                                <span class="Form-label-text" style="font-size: 16px"><?= $paymentData["description"] ?><span style="color: red">*</span></span>
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                                    <hr><h4><i class="glyphicon glyphicon-tags"></i>&nbsp;&nbsp;โปรโมชั่นร้านตอนนี้</h4>
                                                    <?php
                                                    $res = $con->query("select * from promotion "
                                                            . "LEFT JOIN promotion_main ON promotion_main.id = promotion.promotion_main_id "
                                                            . "where restaurant_id = '$resid' and end_time >= date(now()) and start_time <= date(now()) "
                                                            . "order by created_time DESC");

                                                    while ($data = $res->fetch_assoc()) {
                                                        ?>
                                                        <div class="alert alert-info" role="alert">
                                                            <p style="font-size: 14px;"><b><?= $data["name"] ?>:</b>&nbsp;<?= $data["description"] ?></p>
                                                            <p style="font-size: 14px;">
                                                                <b>เริ่ม:</b>&nbsp;<?= $data["start_time"] ?>&nbsp;&nbsp;
                                                                <b>หมดเขต:</b>&nbsp;<?= $data["end_time"] ?>
                                                            </p>
                                                        </div>
                                                    <?php } ?>

                                                    <hr>
                                                    <div>
                                                        <p style="color: red">*เรียกเก็บค่ามัดจำ 20% และต้องชำระค่ามัดจำภายใน 4 ชั่วโมงหลังจากร้านตอบรับรายการ</p>
                                                        *สามารถโอนเงินผ่านบัญชีธนาคาร&nbsp;&nbsp;<br>
                                                        <?php
                                                        while ($bankData = $bankRes->fetch_assoc()) {
                                                            ?>
                                                            ชื่อบัญชี: &nbsp;<?= $bankData["accname"] ?>&nbsp;เลขที่บัญชี &nbsp;<?= $bankData["accNo"] ?>&nbsp;<?= $bankData["bank"] ?><br>

                                                        <?php } ?>

                                                    </div>
                                                    <div id="errorStep6"></div>
                                                </div>
                                            </div>

                                            <ul class="list-inline pull-right" style="margin-top: 20px">
                                                <li><button type="button" class="btn btn-default prev-step" id="prevstep4" > <span class="glyphicon glyphicon glyphicon-chevron-left"></span>ย้อนกลับ</button></li>

                                                <li><button type="button" class="btn btn-warning " id="cancel_orderbtn"  >ยกเลิก</button></li>
                                                <li><button type="button" class="btn btn-danger " id="confirm_orderbtn" >ยืนยันการสั่ง</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--</form>-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" id="showcalendar">
                            <div class="card-content">
                                <div class="page-header" style="color: #FF9900 ; font-size: 26px">
                                    รับรายการสั่งซื้อได้สูงสุด &nbsp;<?= $resNameData["amount_box_limit"] ?>&nbsp;ชุด/วัน
                                </div>
                                <div class="calendar" style="color: #FF9900"></div>
                            </div>  
                        </div>
                        <br>

                        <div class="card" id="orderdetail">
                            <div class="card-content">
                                <div class="page-header" style="color: #FF9900">
                                    รายการสั่งซื้อ
                                </div>
                                <div id="showOrderDetail">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section> 
        <div id="saveOrderSuccessModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">การสั่งซื้อสำเร็จเรียบร้อย</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert">
                            <p>
                                SMS ตอบรับรายการสั่งซื้อจะส่งกลับมาภายใน 24 ชั่วโมง และสามารถ &nbsp; <a href="/view/cus_customer_profile.php" class="alert-link">ตรวจสอบสถานะสินค้า</a>&nbsp;ได้ทีลิ้งนี้ <br>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/view/cus_restaurant_view.php?resId=<?= $resid ?>"><button type="button" class="btn btn-default">ปิด</button></a>
                        <a href="/view/cus_customer_profile.php" ><button type="button" class="btn btn-success" >ตกลง</button></a>
                    </div>
                </div>

            </div>
        </div>

        <?php include '../template/footer.php'; ?>
        <script src="/assets/js/order-shoplist.js"></script>

    </body>
</html>
