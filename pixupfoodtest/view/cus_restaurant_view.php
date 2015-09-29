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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/css/normal_order.css">

        <style>
            #restaurant_view .fb-image-profile
            {
                margin: -160px 45px 10px 80px;
                z-index: 9;
                width: 13%;
                height: 175px;
                border-radius:50%;
            }
            #restaurant_view .menu_img{
                width: 100%;
                max-width: 100%;
                height: 100px;
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
                . ", deliveryfee"
                . " from restaurant "
                . "join mapping_delivery_type on mapping_delivery_type.restaurant_id = restaurant.id  "
                . " where id = '$resid'");
        $resNameData = $resNameRes->fetch_assoc();
        ?>
        <?php include '../template/customer-navbar.php'; ?>
        <input type="hidden" value="<?= $resid ?>" class="getResId" >
        <!-- edit head -->
        <section id="restaurant_view_head">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= ($menusetData["resname"] == "" ? $resNameData["name"] : $menusetData["resname"]) ?></h1>
                    <div class="row lead">
                        <div id="stars-existing" class="starrr" data-rating='4'></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- edit body -->
        <section id="restaurant_view">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">ข่าวประกาศ</a></li>
                            <li role="presentation"><a href="#promo" aria-controls="promo" role="tab" data-toggle="tab">โปรโมชั่น</a></li>
                            <li role="presentation"><a href="#order" aria-controls="order" role="tab" data-toggle="tab">สั่งอาหาร</a></li>
                            <li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">ข้อมูลร้าน</a></li>
                            <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">รีวิว / คอมเม้นท์</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="news">
                                <br><div class="row">
                                    <div class="col-md-3">
                                        <section id="pinBoot">
                                            <article class="white-panel"><img src="/assets/images/res_resall/menuedit/FriedEgg.jpg" alt="">
                                                <h4><a href="#">เมนูใหม่</a></h4>
                                                <p>ทางร้านของเราได้เพิ่มเมนูอาหารใหม่ นั่นก็คือ สปาเก็ดดี้ไวท์ซอท สั่งได้แล้ววันนี้</p>
                                            </article>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <!-- Promotion -->
                            <div role="tabpanel" class="tab-pane" id="promo">
                                <br><div class="row">
                                    <section id="pinBootpromo">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <section id="pinBoot">
                                                    <article class="white-panel"><img src="/assets/images/sixStep/step5.png" alt="">
                                                        <h4><a href="#">ฟรีค่าจัดส่ง</a></h4>
                                                        <p>1 เดือนเท่านั้น</p>
                                                    </article>
                                                </section>
                                            </div>
                                            <!--<div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>     -->                    
                                        </div>
                                    </section>
                                </div>
                            </div>


                            <!-- Order -->
                            <div role="tabpanel" class="tab-pane" id="order">
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
                                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-picture"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-picture"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <form action="/customer/order-request-save.php?cusId<?= $cusid ?>&resId<?= $resid ?>" method="post" id="normalOrderForm">
                                    <input type="hidden" name="selectMenuFromCustomer" value="<?= $orderMenu_id ?>" >
                                    <div class="tab-content">

                                        <!-- เลือกกล่อง -------------------------------------------------------------->
                                        <div class="tab-pane active" role="tabpanel" id="step1">

                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header">
                                                        ขั้นตอนที่ 1 : เลือกกล่องและจำนวนกล่อง
                                                    </div>
                                                    <div class="row">
                                                        <?php
                                                        $foodboxRes = $con->query("SELECT food_box.id, food_box.description, food_box.img_path,  "
                                                                . "mapping_food_box.restaurant_id as resid "
                                                                . "FROM mapping_food_box "
                                                                . "LEFT JOIN food_box ON food_box.id = mapping_food_box.food_box_id "
                                                                . "WHERE mapping_food_box.restaurant_id = '$resid' ");

                                                        while ($foodboxData = $foodboxRes->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="thumbnail">
                                                                    <a href="#"><img class="menu_img" src="<?= $foodboxData["img_path"] ?>"></a>
                                                                    <div class="caption">

                                                                        <p><?= $foodboxData["description"] ?></p>
                                                                        <p style="text-align: right">
                                                                            <input type="radio" name="foodboxtype" class="foodboxtype" id="foodboxtype<?= $foodboxData["id"] ?>" value="<?= $foodboxData["id"] ?>">
                                                                            <input type="hidden" class="boxtypedata" name="boxtype<?= $foodboxData["id"] ?>" value="<?= $foodboxData["description"] ?>">
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>
                                                    <div >
                                                        <h4>จำนวนกล่อง: &nbsp;<input type="number" name="boxamount" id="boxamount"  ></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                                <li><button type="button" class="btn btn-primary next-step" id="nextStep1">continue</button></li>
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
                                                                . "WHERE main_menu.type = 'ชนิดข้าว' "
                                                                . "and menu.restaurant_id = '$resid'");

                                                        while ($riceData = $riceListRes->fetch_assoc()) {
                                                            ?>
                                                        <div class="col-md-3" id="ricedatalist">
                                                                <div class="thumbnail">
                                                                    <a href="#"><img class="menu_img" src="<?= ($riceData["img_path"] == "") ? $riceData["img"] : $riceData["img_path"] ?>"></a>
                                                                    <div class="caption">
                                                                        <h4><?= $riceData["name"] ?></h4>
                                                                        <p><?= $riceData["price"] ?>&nbsp;</p>
                                                                        <p style="text-align: right">
                                                                            <input type="radio" name="ricetype" class="ricetype" id="ricetype<?= $riceData["id"] ?>" value="<?= $riceData["name"] ?>">
                                                                            <input type="hidden" class="ricetypedata" id="ricetypedata<?= $riceData["id"] ?>" value="<?= $riceData["price"] ?>"> 

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-md-12" id="skip" style="display: none">
                                                              <h3>ข้ามขั้นตอนนี้</h3>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                <li><button type="button" class="btn btn-default prev-step" id="prevstep2">Previous</button></li>
                                                <li><button type="button" class="btn btn-primary next-step" id="nextStep2"> continue</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step3" >
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header">
                                                        ขั้นตอนที่ 3 : เลือกรายการอาหาร
                                                    </div>
                                                    <h3>สามารถเลือกรายการได้ตามรูปแบบของกล่อง (ไม่เกิน 3 รายการ)</h3>
                                                    <div class="row" id="foodListdata">
                                                        <?php
                                                        $foodListRes = $con->query("SELECT DISTINCT main_menu.name, menu.price, menu.img_path, menu.id, main_menu.img_path as img   "
                                                                . "FROM `menu` LEFT JOIN main_menu on main_menu.id = menu.main_menu_id "
                                                                . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE main_menu.type = 'กับข้าว' "
                                                                . "and menu.restaurant_id = '$resid'");

                                                        while ($foddListData = $foodListRes->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="thumbnail">
                                                                    <a href="#"><img class="menu_img" src="<?= ($foddListData["img_path"] == "") ? $foddListData["img"] : $foddListData["img_path"] ?>"></a>
                                                                    <div class="caption">
                                                                        <h4><?= $foddListData["name"] ?></h4>
                                                                        <p><?= $foddListData["price"] ?>&nbsp;</p>
                                                                        <p style="text-align: right">
                                                                            <input type="checkbox" name="foodlist[]" class="foodlist" id="foodlist<?= $foddListData["id"] ?>" value="<?= $foddListData["name"] ?>">
                                                                            <input type="hidden" name="foodprice[]" class="foodprice" id="foodprice<?= $foddListData["id"] ?>" value="<?= $foddListData["price"] ?>">
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                     <div class="row" style="display: none" id="singleMenuList">
                                                        <?php
                                                        $foodListRes = $con->query("SELECT  main_menu.name, menu.price, menu.img_path, menu.id, main_menu.img_path as img   "
                                                                . "FROM `menu` LEFT JOIN main_menu on main_menu.id = menu.main_menu_id "
                                                                . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                . "WHERE main_menu.type = 'อาหารจานเดียว'"
                                                                . "and menu.restaurant_id = '$resid'");

                                                        while ($foddListData = $foodListRes->fetch_assoc()) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="thumbnail">
                                                                    <a href="#"><img class="menu_img" src="<?= ($foddListData["img_path"] == "") ? $foddListData["img"] : $foddListData["img_path"] ?>"></a>
                                                                    <div class="caption">
                                                                        <h4><?= $foddListData["name"] ?></h4>
                                                                        <p><?= $foddListData["price"] ?>&nbsp;</p>
                                                                        <p style="text-align: right">
                                                                            <input type="checkbox" name="foodlist[]" class="foodlist" id="foodlist<?= $foddListData["id"] ?>" value="<?= $foddListData["name"] ?>">
                                                                            <input type="hidden" name="foodprice[]" class="foodprice" id="foodprice<?= $foddListData["id"] ?>" value="<?= $foddListData["price"] ?>">
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?php
                                                        }
                                                        ?>
                                                    </div> <!--<hr class="hrs">--><!--<hr class="hrs">-->
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <li><button type="button" class="btn btn-primary btn-info-full next-step" id="nextStep3"> continue</button></li>
                                            </ul>
                                        </div>


                                        <div class="tab-pane" role="tabpanel" id="step4">
                                            <div class="card">
                                                <div class="card-content" style="height:750px;">
                                                    <div class="page-header" style="margin-left:16px;">
                                                        ขั้นตอนที่ 4 : เลือกวัน เวลา และสถานที่จัดส่ง
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-5">
                                                            <h3>ส่งวันที่ :</h3>
                                                           <!-- <div id="calendar_datepick"></div>-->
                                                           <input type="date">
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
                                                        </div>
                                                    </div>
                                                    <div id="addressoverlay"></div>

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
                                            </div>
                                            <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <li><button type="button" class="btn btn-primary next-step nextStep4" id="hidecalendarbtn"> continue</button></li>
                                            </ul>
                                        </div>                                   



                                        <div class="tab-pane" role="tabpanel" id="step5">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="page-header">
                                                        ขั้นตอนที่ 5 : เลือกวิธีชำระเงิน
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
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right" style="margin-top: 20px">
                                                <li><button type="submit" class="btn btn-primary next-step" >Order</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                            <!-- ข้อมูลร้าน -->
                            <div role="tabpanel" class="tab-pane" id="info">
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="page-header">
                                                    <h3>ข้อมูลทั่วไป</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-commenting "></i> เกี่ยวกับร้าน</span><br>
                                                                <span class="info_res"><?= $resNameData["detail"] ?></span>
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-clock-o "></i> ชั่วโมงการจัดส่ง</span><br>
                                                                <table style="margin: 5px 0 0 90px;width: 440px">
                                                                    <tbody class="info_res">
                                                                        <tr>
                                                                            <td> วันจันทร์ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันอังคาร </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันพุธ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันพฤหัสบดี </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันศุกร์ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันเสาร์ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันอาทิตย์ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-map-marker "></i> ที่ตั้งร้าน</span><br>
                                                                <span class="info_res"><?= $resNameData["address"] ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-bell "></i> วัน/เวลาทำการ</span><br>
                                                                <span class="info_res"> จันทร์ - อาทิตย์ </span><br>
                                                                <span class="info_res"> <?= $resNameData["opentime"] ?> </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-users "></i> สั่งขั้นต่ำ</span><br>
                                                                <span class="info_res"> <?= $resNameData["amount_box_minimum"] ?> กล่อง </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-motorcycle "></i> ค่าจัดส่ง</span><br>
                                                                <span class="info_res"> <?= $resNameData["deliveryfee"] ?> บาท </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-clock-o "></i> ถึงมือประมาณ</span><br>
                                                                <span class="info_res"> 1 ชั่วโมง </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-money "></i> รูปแบบการชำระเงิน</span><br>
                                                                <span class="info_res"> เงินสดเมื่อได้รับอาหาร </span><br>
                                                                <span class="info_res"> โอนเงินผ่านบัญชีธนาคาร </span><br>
                                                                <span style="font-size: 12px; margin: 5px 0 0 30px; color: red"> *ค่ามัดจำ 20%ต่อหนึ่งรายการ </span>
                                                            </div>
                                                        </div><hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- review -->
                            <div role="tabpanel" class="tab-pane" id="review">
                                <br><div class="row">
                                    <div class="col-md-12">
                                        <h3 class="page-header" style="margin: 0 0 10px 0;">คอมเม้นต์จากลูกค้า</h3>
                                        <section class="comment-list">
                                            <!-- Comment1 -->
                                            <article class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <figure class="thumbnail">
                                                        <img class="img-responsive" src="/assets/images/default-avatar.jpg"  />
                                                        <figcaption class="text-center">มานี</figcaption> <!-- ชื่อจริง -->
                                                    </figure>
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="panel panel-default arrow left">
                                                        <div class="panel-body">
                                                            <header class="text-left">
                                                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                            </header>
                                                            <div class="comment-post">
                                                                <p>
                                                                    อร่อยมากๆ ค่ะ ><
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                            <!-- Comment2 -->
                                            <article class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <figure class="thumbnail">
                                                        <img class="img-responsive" src="/assets/images/default-avatar.jpg" />
                                                        <figcaption class="text-center">มานะ</figcaption>
                                                    </figure>
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="panel panel-default arrow left">
                                                        <div class="panel-body">
                                                            <header class="text-left">
                                                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                            </header>
                                                            <div class="comment-post">
                                                                <p>
                                                                    เมนูข้าวผัดร้านนี้อร่อยมากครับ !!
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                            <!-- Comment3 -->
                                            <article class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <figure class="thumbnail">
                                                        <img class="img-responsive"src="/assets/images/default-avatar.jpg"  />
                                                        <figcaption class="text-center">ปิติ</figcaption>
                                                    </figure>
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="panel panel-default arrow left">
                                                        <div class="panel-body">
                                                            <header class="text-left">
                                                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                            </header>
                                                            <div class="comment-post">
                                                                <p>
                                                                    คนส่งอาหารมาช้าไปหน่อยครับ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                            <!-- Comment4 -->
                                            <article class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <figure class="thumbnail">
                                                        <img class="img-responsive" src="/assets/images/default-avatar.jpg" />
                                                        <figcaption class="text-center">ชูใจ</figcaption>
                                                    </figure>
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="panel panel-default arrow left">
                                                        <div class="panel-body">
                                                            <header class="text-left">
                                                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                            </header>
                                                            <div class="comment-post">
                                                                <p>
                                                                    ผัดกระเพราเค็มไปนิดนึงค่ะ แต่บริการดี มั่นใจได้ค่ะ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </section>
                                    </div>
                                </div>
                                <!-- คอมเม้นลูกค้าเขียน -->
                                <hr class="hrs">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form>
                                            <div class="card">
                                                <div class="card-content" style="padding: 10px 10px 0 10px">
                                                    <textarea class="form-control input-sm " type="textarea" id="recom" placeholder="เขียนข้อความของคุณที่นี่" rows="5"></textarea><br>
                                                </div>
                                            </div>
                                            <div class="pull-right" style="margin: 10px 0 0 0">
                                                <button class="btn btn-primary" type="submit" value="ส่งข้อความ">ส่งข้อความ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" id="showcalendar">
                            <div class="card-content">
                                <div id="calendar" style="color: #FF9900"></div>
                            </div>  
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-content">
                                <div class="page-header" style="color: #FF9900">
                                    Order & Price
                                </div>
                                <div>

                                    <table class="table table-hover" id="task-table">
                                        <thead>
                                            <tr>
                                                <th>รายการอาหารที่เลือก</th>
                                                <th ></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="menuOrderList">
                                            <tr>
                                                <td> </td>
                                                <td style="color: #FF9900"></td>
                                                <td>บาท</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-md-6" style="text-align: left;font-size: 16px; font: bold">จำนวน</div>
                                    <div class="form-group col-md-4" style="margin-top: -8;    margin-left: -50;">
                                        <input type="number" name="amountbox" id="amountbox" class="form-control" value="">
                                    </div>

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
                                                <td>ราคา: </td>
                                                <td style="color: #FF9900" id="showqty"></td>
                                                <td>บาท</td>
                                            </tr>
                                            <tr>
                                                <td>ค่าจัดส่ง: </td>
                                                <td style="color: #FF9900"><?= $resNameData["deliveryfee"] ?></td>
                                                <td>บาท</td>
                                            </tr>
                                            <tr>
                                                <td>ราคารวม: </td>
                                                <td style="color: #FF9900" id="showtotal"></td>
                                                <td>บาท</td>
                                            </tr>
                                            <tr>
                                                <td>ค่ามัดจำ 20%: </td>
                                                <td style="color: #FF9900" id="showprepay"></td>
                                                <td>บาท</td>
                                            </tr>
                                            <tr>
                                                <td style="color: red" id="totalprice">ราคาส่วนที่เหลือ*</td>
                                                <td  id="totalprice" style="color: #FF9900"></td>
                                                <td>บาท</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <hr style="border: solid 1px">
                                    <p>*ราคาส่วนที่เหลือนั้น ลูกค้าจะต้องชำระด้วยเงินสดเมื่อได้รับสินค้า</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>
        <script src="/assets/js/normal_order.js"></script>
    </body>
</html>
