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
        <link rel="stylesheet" href="/assets/css/customer-comment.css">
        <link rel="stylesheet" href="/assets/css/check-radio.css">
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
        </style>


    </head>
    <body>
        <?php
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
                . "left join mapping_delivery_type on mapping_delivery_type.restaurant_id = restaurant.id  "
                . " where id = '$resid'");
        $resNameData = $resNameRes->fetch_assoc();
        ?>
        <?php include '../template/customer-navbar.php'; ?>
        <input type="hidden" value="<?= $resNameData["amount_box_limit"] ?>" id="getAmount_box_limit" >
        <input type="hidden" value="<?= $cusid ?>" class="getCusId" >
          <input type="hidden" value="<?= $resid ?>" class="getResId" >
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

                                            <li role="presentation" class="active">
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
                                            <li role="presentation" class="disabled">
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

                                        <!-- เลือกกล่อง -------------------------------------------------------------->
                                        <div class="tab-pane active" role="tabpanel" id="step1">

                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header">
                                                        ขั้นตอนที่ 1 : เลือกกล่องและจำนวนกล่อง 
                                                        <span style="color: gray; font-size: 20px;">(ขั้นต่ำ&nbsp;<?= $resNameData["amount_box_minimum"] ?>&nbsp;ชุด/รายการอาหาร)</span>
                                                    </div>
                                                    <div class="row" style="width:650px; margin:0 auto; padding-bottom:30px;">
                                                        <?php
                                                        $foodboxRes = $con->query("SELECT food_box.id, food_box.description, food_box.img_path,  "
                                                                . "mapping_food_box.restaurant_id as resid "
                                                                . "FROM mapping_food_box "
                                                                . "LEFT JOIN food_box ON food_box.id = mapping_food_box.food_box_id "
                                                                . "WHERE mapping_food_box.restaurant_id = '$resid' ");

                                                        while ($foodboxData = $foodboxRes->fetch_assoc()) {
                                                            ?>
                                                            <div class="foodboxselect">
                                                                <img class="menu_img" src="<?= $foodboxData["img_path"] ?>">
                                                                <p st><?= $foodboxData["description"] ?></p>
                                                                <input type="radio" name="foodboxtype" class="foodbox" value="<?= $foodboxData["id"] ?>">
                                                            </div>

                                                        <?php } ?>
                                                    </div><br><br>
                                                    <div class="row" style="text-align: center;font-size: 20px">
                                                        จำนวน : <input type="number" class="form-inline" min="1"  max="<?= $resNameData["amount_box_limit"] ?>" id="boxamount" style="width:100px"> ชุด 
                                                        <br><br>
                                                    </div>
                                                    <div id="errorStep1"></div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                                <li><button type="button" class="btn btn-warning next-step" >ดำเนินการต่อ <span class="glyphicon glyphicon glyphicon-chevron-right"></span></button></li>
                                            </ul>

                                        </div>

                                        <!-- เลือกชนิดข้าวข้าว -------------------------------------------------------------->
                                        <div class="tab-pane" role="tabpanel" id="step2">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header">
                                                        ขั้นตอนที่ 2 : เลือกข้าว
                                                    </div>
                                                    <div class="row">
                                                        <?php
                                                        $riceListRes = $con->query("SELECT main_menu.name, menu.price , menu.img_path,menu.id, main_menu.img_path as img  "
                                                                . "FROM `menu` LEFT JOIN main_menu on main_menu.id = menu.main_menu_id "
                                                                . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE main_menu.type = 'ชนิดข้าว' and menu.status = 0 "
                                                                . "and menu.restaurant_id = '$resid'");

                                                        if ($riceListRes->num_rows == 0) {
                                                            ?>
                                                            <div class="col-md-12" >
                                                                <div class="alert alert-warning " style="margin-bottom: 150px" role="alert">
                                                                    <h4 class="text-center">ยังไม่มีรายการ</h4>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            while ($riceData = $riceListRes->fetch_assoc()) {
                                                                ?>
                                                                <div class="col-md-3" id="ricedatalist">
                                                                    <div class="thumbnail riceselect">
                                                                        <div class="caption ">
                                                                            <img class="menu_img" src="<?= ($riceData["img_path"] == "") ? $riceData["img"] : $riceData["img_path"] ?>">
                                                                            <h4><?= $riceData["name"] ?></h4>
                                                                            <p><?= $riceData["price"] ?>&nbsp;บาท</p>
                                                                            <p style="text-align: right">
                                                                                <input type="radio" name="ricetype" class="rice" value="<?= $riceData["id"] ?>">
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                        } ?>
                                                        <div id="norice" style="background-color:rgba(255,255,255,0.6); text-align: center; position: absolute; left:0; top:0; width:100%; height:300px;">
                                                            <h1 style="font-size:100px; margin-top:50px;"><span class="glyphicon glyphicon-ok-circle"></span></h1>
                                                            <h2>กรุณาไปขั้นตอนถัดไป</h2>
                                                        </div>
                                                    </div>
                                                    <div id="errorStep2"></div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                <li><button type="button" class="btn btn-default prev-step" id="prevstep2"> <span class="glyphicon glyphicon glyphicon-chevron-left"></span>ย้อนกลับ</button></li>
                                                <li><button type="button" class="btn btn-warning next-step " >ดำเนินการต่อ <span class="glyphicon glyphicon glyphicon-chevron-right"></span></button></li>
                                            </ul>
                                        </div>


                                        <div class="tab-pane" role="tabpanel" id="step3" >
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header">
                                                        ขั้นตอนที่ 3 : เลือกรายการอาหาร
                                                    </div>
                                                    <h3 style="color: #FF5F00; margin-left:15px;">รูปแบบของกล่องท่านสามารถเลือกได้ไม่เกิน <span id="showcount"></span> รายการ</h3>
                                                    <div class="row" id="showfood">
                                                    </div> <!--<hr class="hrs">-->
                                                    <div class="row">
                                                        <div id="showMoretext" style="display: none">
                                                            <div class="col-md-12">
                                                                <div class="page-header">
                                                                    เพิ่มเติม
                                                                </div>
                                                                <textarea id="moretext" rows="3" placeholder="หมายเหตุเพิ่มเติม เช่น ไม่เผ็ด ไม่ใส่ผัก" style="width: 100%"></textarea>
                                                            </div>
                                                        </div>
                                                        <div id="addMenuSuccess" style="background-color:rgba(255,255,255,0.6); text-align: center; position: absolute; left:0; top:0; width:100%; height:100%;">
                                                            <h1 style="font-size:100px; margin-top:150px;"><span class="glyphicon glyphicon-ok-circle"></span></h1>
                                                            <h2>บันทึกรายการอาหารเรียบร้อยเเล้ว</h2>
                                                            <button type="button" class="btn btn-danger " id="addNewOrder" <?= ( $resNameData["close"] == "0") ? "" : " data-toggle=\"tooltip\" " ?>  class="tooltip-r" data-placement="top" title="วันนี้ร้านปิดรับออเดอร์ชั่วคราว สามารถเพิ่มรายการอาหารเก็บไว้ในตะกร้าได้" > <span class=" glyphicon glyphicon-plus-sign"></span>&nbsp;สั่งซื้อต่อไป</button>
                                                        </div>
                                                    </div>
                                                    <div id="errorStep3" style="    margin-top: 20px;"></div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                <li><button type="button" class="btn btn-default prev-step" id="prevstep3"> <span class="glyphicon  glyphicon-chevron-left"></span>ย้อนกลับ</button></li>
                                                <li><button type="button" class="btn btn-success " id="add_order"  ><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;เพิ่มรายการ</button></li>
                                                <li>
                                                    <a href="/view/cus_order_shoplist.php?resId=<?= $resid ?>">
                                                        <button type="button" class="btn btn-warning next-step " id="checkout" style="display: none" >
                                                            ดำเนินการต่อ 
                                                            <span class="glyphicon  glyphicon-chevron-right"></span>
                                                        </button>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="list-inline"  style="margin-top: 20px">
                                                <li><button type="button" class="btn btn-danger " id="addNewOrder" style="display: none"> <span class=" glyphicon glyphicon-plus-sign"></span>&nbsp;สั่งซื้อต่อไป</button></li>

                                            </ul>
                                        </div>


                                        <div class="tab-pane" role="tabpanel" id="step4">
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
                                                <li><button type="button" class="btn btn-default prev-step"> <span class="glyphicon glyphicon glyphicon-chevron-left"></span>ย้อนกลับ</button></li>
                                                <li><button type="button" class="btn btn-warning next-step " id="nextstep4">ดำเนินการต่อ <span class="glyphicon glyphicon glyphicon-chevron-right"></span></button></li>
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
                                                                <h3>เวลาจัดส่ง :</h3>
                                                                <select name="delivery_time" id="delivery_time" class="form-control" >
                                                                    <option value="0" disabled selected>--เวลาจัดส่ง--</option>
                                                                    <option value="06:30:00">06:30 น.</option>
                                                                    <option value="07:30:00">07:30 น.</option>
                                                                    <option value="08:30:00">08:30 น.</option>
                                                                    <option value="09:30:00">09:30 น.</option>
                                                                    <option value="10:30:00">10:30 น.</option>
                                                                    <option value="11:30:00">11:30 น.</option>
                                                                    <option value="12:30:00">12:30 น.</option>
                                                                    <option value="13:30:00">13:30 น.</option>
                                                                    <option value="14:30:00">14:30 น.</option>
                                                                    <option value="15:30:00">15:30 น.</option>
                                                                    <option value="16:30:00">16:30 น.</option>
                                                                    <option value="17:30:00">17:30 น.</option>
                                                                    <option value="18:30:00">18:30 น.</option>
                                                                </select>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="errorStep5"></div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                <li><button type="button" class="btn btn-default prev-step"> <span class="glyphicon glyphicon glyphicon-chevron-left"></span>ย้อนกลับ</button></li>
                                                <li><button type="button" class="btn btn-warning next-step " id="nextstep5">ดำเนินการต่อ <span class="glyphicon glyphicon glyphicon-chevron-right"></span></button></li>
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
                                                    while ($paymentData = $paymentRes->fetch_assoc()) {
                                                        ?>
                                                        <div class="input-group col-md-12" style="margin: 10px 120px;"  >
                                                            <input type="radio"  name="paymentData" value="<?= $paymentData["id"] ?>"><?= $paymentData["description"] ?>
                                                        </div>
<?php } ?>
                                                    <hr>
                                                    <div >
                                                        *สามารถโอนเงินผ่านบัญชีธนาคาร&nbsp;&nbsp;<br>
                                                        <?php
                                                        while ($bankData = $bankRes->fetch_assoc()) {
                                                            ?>
                                                            <p>ชื่อบัญชี: &nbsp;<?= $bankData["accname"] ?>&nbsp;เลขที่บัญชี &nbsp;<?= $bankData["accNo"] ?>&nbsp;<?= $bankData["bank"] ?></p>

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
                        </div><br>

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
                        <h4 class="modal-title">สั่งสำเร็จแล้ว T^T</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert">
                            <p> 
                                SMS ตอบรับรายการสั่งซื้อจะส่งกลับมาภายในเวลา....สามารถ &nbsp; <a href="/view/cus_customer_profile.php" class="alert-link">ตรวจสอบสถานะสินค้า</a>&nbsp;ได้ทีลิ้งนี้ <br>
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
        <script src="/assets/js/normal_order.js"></script>

    </body>
</html>
