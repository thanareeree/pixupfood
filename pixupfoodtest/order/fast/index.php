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

        <section id="fast_head">
            <div class="overlay">
                <div class="container text-center">
                    <h1>Fast Order</h1>
                    <h4>สั่งอาหารด่วน</h4>
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
                                        <i class="glyphicon glyphicon-folder-open"></i>
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
                            </div>
                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                <li>
                                    <button type="button" class="btn btn-lg btn-warning next-step">
                                        Continue
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
                                    <br>
                                </div>
                            </div>
                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                <li><button type="button" class="btn btn-lg btn-default prev-step">Previous</button></li>
                                <li><button type="button" class="btn btn-lg btn-warning next-step">Continue</button></li>
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
                                        $foodboxRes = $con->query("SELECT food_box.id, food_box.description, food_box.img_path FROM food_box");
                                        while ($foodboxData = $foodboxRes->fetch_assoc()) {
                                            ?>
                                            <div class="foodboxselect">
                                                <img class="menu_img" src="<?= $foodboxData["img_path"] ?>">
                                                <p><?= $foodboxData["description"] ?></p>
                                                <input type="radio" name="foodboxtype" class="foodbox" value="<?= $foodboxData["id"] ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row" style="text-align: center;">
                                        จำนวน : <input type="number" class="form-inline" id="boxamount" style="width:100px"> กล่อง
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline pull-right" style="margin-top: 20px;">
                                <li><button type="button" class="btn btn-lg btn-default prev-step">Previous</button></li>
                                <li><button type="button" class="btn btn-lg btn-warning next-step">Continue</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include '../../template/footer.php'; ?>
        <script src="/assets/js/fast_order.js" type="text/javascript"></script>
    </body>
</html>