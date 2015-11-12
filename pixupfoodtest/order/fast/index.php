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
        <link rel="stylesheet" href="/assets/css/bootstrap-toggle.min.css">
        <link rel="stylesheet" href="/assets/css/check-radio.css">
    </head>
    <body>
        <?php
        $customerData = $_SESSION["userdata"];
        $orderMenu_id = @$_GET["menuSetId"];
        ?>
        <?php include '../../template/customer-navbar.php'; ?>

        <section id="fast_head">
            <div class="overlay">
                <div class="container text-center">
                   <!-- <h1><b style="color: #FF5F00">Pixup<span style="color: black">Fast</span></b> </h1>-->
                    <h1 ><b style="color: #FF5F00">Pixup</b>Fast</h1>
                    <h4>ก้าวให้เร็วขึ้นกับ PixupFast</h4>

                </div>
            </div>
        </section>
        <section id="fast_order">
            <div class="container">
                <div class="wizard">
                    <div class="wizard-inner">
                        <div class="connecting-line"></div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-map-marker"></i>
                                    </span>
                                </a>
                            </li>

                            <li role="presentation" class="disabled">
                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-th-list"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-ok"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-ok"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" class="disabled">
                                <a href="#step6" data-toggle="tab" aria-controls="complete" role="tab" title="Step 6">
                                    <span class="round-tab">
                                        <i class="glyphicon glyphicon-ok"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="block" style="position: absolute; top:0; left:0; width:100%; height:100px; background-color:rgba(0,0,0,0); z-index:2;"></div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <div class="card">
                                <div class="card-content" style="height:750px;">
                                    <div class="page-header" style="margin-left:16px;">
                                        ขั้นตอนที่ 1 : ระบุตำแหน่งที่อยู่จัดส่ง
                                    </div>
                                    <div id="addressoverlay"></div>

                                    <div class="col-sm-10">
                                        ที่อยู่ที่บันทึกไว้ : 
                                        <select class="form-control" id="oldaddress">
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
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

                                    <div class="col-sm-10">
                                        ชื่อสถานที่ / จุดสังเกต : 
                                        <input class="form-control" placeholder="กรอกจุดสังเกต เช่น ชื่อสถานที่ อาคาร" name="address" id="addresstxt">
                                    </div>
                                    <div class="col-sm-2">
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
                                            <div id='showaddress' class='col-sm-8'>
                                                ลากและวางหมุดตรงที่อยู่ในการจัดส่งของคุณ
                                            </div>
                                            <div class='col-sm-4' style="text-align: right;">
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
                                <div id="errorStep1"></div>
                            </div>
                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                <li>
                                    <button type="button" class="btn btn-lg btn-warning next-step">
                                        ดำเนินการต่อ
                                        <span class="glyphicon glyphicon glyphicon-chevron-right"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>




                        <div class="tab-pane" role="tabpanel" id="step2">
                            <div class="card">
                                <div class="card-content" style="height:550px;">
                                    <div class="page-header" style="margin-left:16px;">
                                        ขั้นตอนที่ 2 : เลือกวัน เวลา ที่จัดส่ง
                                    </div>
                                    <div class="col-sm-5">
                                        <h3>ส่งวันที่ :</h3>
                                        <div id="calendar"></div>
                                    </div>
                                    <div class="col-sm-7">
                                        <?php include '../../api/delivery-time-range.php'; ?>
                                    </div>
                                    <br>
                                </div>
                                <div id="errorStep2"></div>
                            </div>
                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                <li>
                                    <button type="button" class="btn btn-lg btn-default prev-step">
                                        <span class="glyphicon glyphicon glyphicon-chevron-left"></span>
                                        ย้อนกลับ
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-lg btn-warning next-step">
                                        ดำเนินการต่อ
                                        <span class="glyphicon glyphicon glyphicon-chevron-right"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>




                        <div class="tab-pane" role="tabpanel" id="step3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="page-header" style="margin-left:16px;">
                                        ขั้นตอนที่ 3 : เลือกชนิดกล่อง และจำนวน
                                    </div>
                                    <div class="row" style="width:650px; margin:0 auto; padding-bottom:30px;">
                                        <?php
                                        $menuRes = $con->query("SELECT * FROM `main_menu` WHERE main_menu.id = '$orderMenu_id' AND type = 'อาหารจานเดียว'");
                                        $box = 0;
                                        if ($menuRes->num_rows > 0) {
                                            $box++;
                                        }
                                        $foodboxRes = $con->query("SELECT food_box.id, food_box.description, food_box.img_path FROM food_box where type = '1'");

                                        while ($foodboxData = $foodboxRes->fetch_assoc()) {
                                            ?>
                                            <div class="foodboxselect <?= ($box > 0 && $foodboxData["id"] == 4) ? "selected" : "" ?>">
                                                <img class="menu_img" src="<?= $foodboxData["img_path"] ?>">
                                                <p><?= $foodboxData["description"] ?></p>
                                                <input type="radio" name="foodboxtype" class="foodbox" <?= ($box > 0) ? "checked" : "" ?> value="<?= $foodboxData["id"] ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row" style="text-align: center;">
                                        จำนวน : <input type="number" class="form-inline" id="boxamount" style="width:100px"> ชุด
                                        <br><br>
                                    </div>
                                </div>
                                <div id="errorStep3"></div>
                            </div>
                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                <li>
                                    <button type="button" class="btn btn-lg btn-default prev-step">
                                        <span class="glyphicon glyphicon glyphicon-chevron-left"></span>
                                        ย้อนกลับ
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-lg btn-warning next-step">
                                        ดำเนินการต่อ
                                        <span class="glyphicon glyphicon glyphicon-chevron-right"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>



                        <div class="tab-pane" role="tabpanel" id="step4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="page-header" style="margin-left:16px;">
                                        ขั้นตอนที่ 4 : เลือกข้าว
                                    </div>
                                    <div class="row" style="width:650px; margin:0 auto; padding-bottom:30px;">
                                        <?php
                                        $riceListRes = $con->query("SELECT main_menu.name, main_menu.id FROM  main_menu WHERE main_menu.type = 'ชนิดข้าว'");
                                        while ($riceData = $riceListRes->fetch_assoc()) {
                                            ?>
                                            <div class="riceselect">
                                                <h4><?= $riceData["name"] ?></h4>
                                                <input type="radio" name="ricetype" class="rice" value="<?= $riceData["id"] ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div id="norice" style="background-color:rgba(255,255,255,0.6); text-align: center; position: absolute; left:0; top:0; width:100%; height:300px;">
                                        <h1 style="font-size:100px; margin-top:50px;"><span class="glyphicon glyphicon-ok-circle"></span></h1>
                                        <h2>คุณได้เลือกอาหารจานเดียว กรุณาไปขั้นตอนถัดไป</h2>
                                    </div>
                                </div>
                                <div id="errorStep4"></div>
                            </div>
                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                <li>
                                    <button type="button" class="btn btn-lg btn-default prev-step">
                                        <span class="glyphicon glyphicon glyphicon-chevron-left"></span>
                                        ย้อนกลับ
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-lg btn-warning next-step">
                                        ดำเนินการต่อ
                                        <span class="glyphicon glyphicon glyphicon-chevron-right"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>



                        <div class="tab-pane" role="tabpanel" id="step5">
                            <div class="card">
                                <div class="card-content">
                                    <div class="page-header" style="margin-left:16px;">
                                        ขั้นตอนที่ 5 : เลือกกับข้าว
                                    </div>
                                    <h4 style="color: #FF5F00; margin-left:15px;">รูปแบบของกล่องท่านสามารถเลือกได้ไม่เกิน <span id="showcount"></span> รายการ</h4>
                                    <div class="row" id="showfood">
                                    </div> <!--<hr class="hrs">-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="page-header">
                                                เพิ่มเติม
                                            </div>
                                            <textarea id="moretext" rows="3" placeholder="หมายเหตุเพิ่มเติม เช่น ไม่เผ็ด ไม่ใส่ผัก" style="width: 100%"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div id="errorStep5"></div>
                            </div>
                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                <li>
                                    <button type="button" class="btn btn-lg btn-default prev-step">
                                        <span class="glyphicon glyphicon glyphicon-chevron-left"></span>
                                        ย้อนกลับ
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-lg btn-warning next-step">
                                        ดำเนินการต่อ
                                        <span class="glyphicon glyphicon glyphicon-chevron-right"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>



                        <div class="tab-pane" role="tabpanel" id="step6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="page-header" style="margin-left:16px;">
                                        ขั้นตอนที่ 6 : ร้านอาหารใกล้เคียง 3 ร้าน
                                    </div>
                                    <div style="margin-bottom: 30px">
                                        <small style="color: red;font-size: 16px;margin-left:16px;">**ระบบจะส่งคำขอไปยังร้านอาหารที่ถูกเลือก ต้องเลือกอย่างน้อย 1 ร้าน หากมีการเลือกมากกว่า 1 ร้าน ระบบจะส่งคำขอไปยังร้านที่เลือกพร้อมกัน</small>
                                    </div>
                                    <div class="row" id="showrest">
                                    </div>   
                                </div>
                                <div id="errorStep6"></div>
                            </div>
                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                <li>
                                    <button type="button" class="btn btn-lg btn-default prev-step">
                                        <span class="glyphicon glyphicon glyphicon-chevron-left"></span>
                                        ย้อนกลับ
                                    </button>
                                </li>
                                <li>
                                    <button type="button" id="placeorderbtn" class="btn btn-lg btn-warning next-step">
                                        ดำเนินการต่อ
                                        <span class="glyphicon glyphicon glyphicon-chevron-right"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <div id="paymentmodal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เลือกวิธีชำระเงิน</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $paymentRes = $con->query("SELECT payment_type.id, payment_type.description FROM payment_type ");
                        while ($paymentData = $paymentRes->fetch_assoc()) {
                            ?>
                            <div class="input-group col-md-12" style="margin: 10px 80px;"  >
                                <label class="Form-label--tick">
                                    <input type="radio" class=" Form-label-radio"  name="paymentData" value="<?= $paymentData["id"] ?>">
                                    <span class="Form-label-text" style="font-size: 16px"><?= $paymentData["description"] ?></span>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ย้อนกลับ</button>
                        <button type="button" class="btn btn-danger" id="confirmorderbtn">สั่งซื้อ</button>
                    </div>
                </div>

            </div>
        </div>

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
                                SMS ตอบรับรายการสั่งซื้อจะส่งกลับมาภายใน 15 นาที และสามารถ &nbsp; <a href="/view/cus_customer_profile.php" class="alert-link">ตรวจสอบสถานะสินค้า</a>&nbsp;ได้ทีลิ้งนี้ <br>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/view/cus_customer_profile.php" ><button type="button" class="btn btn-success" >ตกลง</button></a>
                    </div>
                </div>

            </div>
        </div>


        <?php include '../../template/footer.php'; ?>
        <script src="/assets/js/bootstrap-toggle.min.js"></script>
        <script src="/assets/js/fast_order.js" type="text/javascript"></script>
    </body>
</html>