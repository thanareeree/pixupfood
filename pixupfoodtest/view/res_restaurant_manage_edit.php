<?php
include '../api/islogin.php';
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant Setting Management</title>
        <?php include '../template/customer-title.php'; ?>

        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/res_restaurant_manage.css">
        <link rel="stylesheet" href="/assets/css/Maps.css">




    </head>
    <body>
        <?php
        $resid = $_SESSION["restdata"]["id"];
        $result = $con->query("select * from restaurant where id = '$resid' ");
        $resdata = $result->fetch_assoc();

        $deliveryRes = $con->query("SELECT delivery_type.id, delivery_type.description, "
                . "mapping_delivery_type.deliveryfee "
                . "FROM restaurant "
                . "LEFT JOIN mapping_delivery_type ON mapping_delivery_type.restaurant_id = restaurant.id "
                . "LEFT JOIN delivery_type ON delivery_type.id = mapping_delivery_type.delivery_type_id "
                . "WHERE restaurant.id = '$resid' ");
        $deliveryData = $deliveryRes->fetch_assoc();
        ?>
        <?php include '../template/restaurant-navbar.php'; ?>
        <form>
            <input type="hidden" id="resIdvalue" value="<?= $resid ?>">
        </form>
        <!-- start head -->
        <section id="RestaurantHeader">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= $resdata["name"] ?></h1>
                </div>
            </div>
        </section>
        <!-- end head-->

        <!-- Menu Bar-->
        <!--Menu Item-->
    <scetion id="menu">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_order.php">
                    <button type="button" id="orders" class="btn btn-default" >
                        <span class="glyphicon glyphicon-align-left" aria-hidden="true" ></span>
                        <div class="hidden-xs">รายการสั่งซื้อ</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_today.php">
                    <button type="button" id="today" class="btn btn-default">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">วันนี้</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_menulist.php">
                    <button type="button" id="menulist" class="btn btn-default" >
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <div class="hidden-xs">รายการอาหาร</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_calendar.php">
                    <button type="button" id="calendar" class="btn btn-default" >
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        <div class="hidden-xs">ปฏิทิน</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_edit.php">
                    <button type="button" id="editres" class="btn btn-warning">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">การตั้งค่า</div>
                    </button>
                </a>
            </div>
        </div>
    </scetion>
    <!--End Menu Item-->


    <section>
        <div class="container" style="margin-top: 50px;margin-bottom: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">ทั่วไป </a>
                                </li>
                                <li>
                                    <a href="#tab_default_2" data-toggle="tab"> เกี่ยวกับรายการสั่งซื้อ</a>
                                </li>
                                <li>
                                    <a href="#tab_default_3" data-toggle="tab">วิธีการชำระเงิน</a>
                                </li>
                                <li>
                                    <a href="#tab_default_4" data-toggle="tab"> พนักงานจัดส่ง</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    <div class="page-header"style="margin-top: 20px;">
                                        <span style="font-size: 40px">การตั้งค่า</span>
                                    </div>

                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">
                                                <div class="col-md-5">

                                                    <!-- สถานะร้านค้า------------------------------------------------------>
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            สถานะร้านค้า
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#StatusRes' href="#StatusRes">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="material-switch" style="margin-left: 27%">
                                                            <span style="font-size: 20px"> เปิดร้าน </span> &nbsp;
                                                            <input id="switchClose" name="someSwitchOption001" type="checkbox" value="<?= $resdata["close"] ?>"  <?= ($resdata["close"] == 1 ? 'checked' : '') ?>/>
                                                            <label for="switchClose" class="label-success"></label>
                                                            &nbsp;  <span style="font-size: 20px">ปิดร้าน</span>
                                                        </div><hr>
                                                        <p style="font-size: 20px">เวลาเปิด-ปิด: &nbsp;<?= ($resdata["opentime"] == "" ? '-' : $resdata["opentime"]) ?></p>
                                                    </div>

                                                    <!-- modal สถานะร้านค้า-->
                                                    <div class="modal fade" id="StatusRes" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h2 class="modal-title" id="myModalLabel" >สถานะร้านค้า</h2>
                                                                </div>
                                                                <form action="/restaurant/edit-opentime.php?resId=<?= $resid ?>" method="post">
                                                                    <div class="modal-body">
                                                                        <div>
                                                                            <label>
                                                                                <span style="font-size: 20px"> &nbsp;เวลาเปิดร้านในระบบอัตโนมัติ 
                                                                                    <input type="time" name="opentime"> ถึง <input type="time" name="closetime"> </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                        <button type="button" class="btn btn-primary">บันทึก</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ปิดmodal สถานะร้านค้า-->

                                                    <!-- จบสถานะร้านค้า-->

                                                    <!-- ร้านค้าหมายเลข ---------------------------------------------------------------------------------------------->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">ร้านค้าหมายเลข <span style="font-size: 30px; color: orange;"> <?= $resdata["id"] ?></span>
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#Resno' href="#Resno">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        &nbsp;   <span style="font-size: 20px">ชื่อร้าน: </span>
                                                        <span style="font-size: 20px; color: orange;"> <?= $resdata["name"] ?></span><br>
                                                        &nbsp;   <span style="font-size: 20px">ประเภทร้าน:</span>
                                                        <span style="font-size: 20px; color: orange;"> <?= ($resdata["restaurant_type"] == "" ? '-' : $resdata["restaurant_type"]) ?> </span><br>
                                                        &nbsp;   <span style="font-size: 20px">หน้าร้าน: </span>
                                                        <span style="font-size: 20px; color: orange;"> <?= ($resdata["has_restaurant"] == "" ? '-' : $resdata["has_restaurant"]) ?> </span><br>
                                                    </div>

                                                    <!-- modal ร้านค้าหมายเลข-->
                                                    <div class="modal fade" id="Resno" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px">ร้านค้าหมายเลข <span style="font-size: 30px; color: orange;"><?= $resdata["id"] ?></span></div></span>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-3">
                                                                                <span style="font-size: 25px">ชื่อร้าน: </span><br><br>
                                                                                <span style="font-size: 25px">ประเภทร้าน: </span><br><br>
                                                                                <span style="font-size: 25px">หน้าร้าน: </span>
                                                                            </div>

                                                                            <div class="col-md-9">
                                                                                <input type="text" style="width: 50%; margin-top: 3px;"><br><br>
                                                                                <span class="form-group">
                                                                                    <select class="form-control" id="sel1"style="width: 50%; margin-top: 4px;">
                                                                                        <option>อาหารตามสั่ง</option>
                                                                                        <option>อาหารคลีน</option>
                                                                                        <option>อาหารเจ</option>
                                                                                        <option>อาหารมังสวิรัต</option>
                                                                                        <option>อาหารเหนือ</option>
                                                                                        <option>อาหารอีสาน</option>
                                                                                        <option>อาหารใต้</option>
                                                                                        <option>ของหวาน/ของว่าง</option>
                                                                                    </select>
                                                                                </span><br>  
                                                                                <span class="form-group">
                                                                                    <select class="form-control" id="sel1"style="width: 50%; margin-top: 4px;">
                                                                                        <option>มี</option>
                                                                                        <option>ไม่มี</option>
                                                                                        <option>ปิดปรับปรุง</option>
                                                                                    </select>
                                                                                </span>   
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                    <button type="button" class="btn btn-primary">บันทึก</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- จบ modal ร้านค้าหมายเลข-->
                                                    <!-- จบร้านค้าหมายเลข -->


                                                    <!--- รูปโชว์ร้าน --->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            รูปภาพประจำร้าน
                                                        </div>
                                                        <div >
                                                            <img src="<?= ($resdata["img_path"] == "" ? '/assets/images/default-img360.png' : $resdata["img_path"]) ?>" style="max-width: 403px;max-height: 260px">
                                                        </div><hr>
                                                        <div id="updateImg" style="" >
                                                            <form action="/restaurant/edit-image-restaurant.php?id=<?= $resid ?>" method="post" enctype="multipart/form-data">
                                                                <span id="uploadtext" ></span>
                                                                <p align="center" ><button type="button" name="img" id="chooseimgbtn"  onClick="imagerest.click()" onMouseOut="uploadtext.value = imagerest.value" class="btn btn-primary btn-block" style="font-style:normal">เลือกรูป</button></p>
                                                                <input type="file" id="imagerest" name="imagerest" style="display:none" accept="image/jpeg,image/pjpeg,image/png"  />
                                                                <button type="submit" name="img" id="uploadimgbtn"   class="btn btn-success btn-block" style="font-style:normal;display: none">อัพเดตรูปภาพ</button>
                                                                <!--</form>--> 
                                                            </form>
                                                        </div>
                                                    </div>


                                                    <!-- ความน่าเชื่อถือ ------------------------------------------------------------------------------------------->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            ระดับความน่าเชื่อถือ
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#Turst' href="#Turst">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <?php
                                                                $level = $resdata["level"];
                                                                if ($level == "พื้นฐาน") {
                                                                    echo '<img src="/assets/images/ResClass/Standard.png">';
                                                                } else if ($level == "กลาง") {
                                                                    echo '<img src="/assets/images/ResClass/middle.png">';
                                                                } else if ($level == "สูง") {
                                                                    echo '<img src="/assets/images/ResClass/High.png">';
                                                                } else {
                                                                    echo '<img src="/assets/images/ResClass/Premium.png">';
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- modal ความน่าเชื่อถือ-->
                                                    <div class="modal fade" id="Turst" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px">ระดับความน่าเชื่อถือ</div></span>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <span style="font-size: 20px; color: red;">ระดับความน่าเชื่อถือของคุณขึ้นอาจอยู่กับ หลักฐานเอกสาร/จำนวนสาขา/ปีที่เปิดร้าน/จำนวนความผิดพลาดของรายการสั่งซื้อ/อื่นๆ 
                                                                        โปรดติดต่อผู้ดูและระบบเพื่อขอพิจารณาการเพิ่มระดับความน่าเชื่อถือ</span><hr>

                                                                    <span style="font-size: 25px; ">ระดับทั้งหมดที่มี</span><br>
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="padding-middle"><img src="/assets/images/ResClass/Standard.png"></div>
                                                                        <div class="col-md-3" style="padding-middle"><img src="/assets/images/ResClass/middle.png"></div>
                                                                        <div class="col-md-3" style="padding-middle"><img src="/assets/images/ResClass/High.png"></div>
                                                                        <div class="col-md-3" style="padding-middle"><img src="/assets/images/ResClass/Premium.png"></div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">

                                                                                <textarea style="font-size: 20px;" class="form-control" rows="5" id="Report" placeholder="พิมพ์ข้อความของคุณที่นี่..."></textarea>
                                                                            </div>
                                                                        </div> 
                                                                    </div>

                                                                    <label class="control-label">Select File</label>
                                                                    <div class="file-input file-input-new">
                                                                        <div class="file-preview ">
                                                                            <div class="close fileinput-remove">×</div>
                                                                            <div class="file-drop-disabled">
                                                                                <div class="file-preview-thumbnails"></div>
                                                                                <div class="clearfix"></div>    
                                                                                <div class="file-preview-status text-center text-success"></div>
                                                                                <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kv-upload-progress hide">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                                                                    0%
                                                                                </div>
                                                                            </div>                                              
                                                                        </div>
                                                                        <div class="input-group ">
                                                                            <div tabindex="500" class="form-control file-caption kv-fileinput-caption" style="height:38px;">
                                                                                <div class="file-caption-name" title=""></div>
                                                                            </div>
                                                                            <div class="input-group-btn">
                                                                                <button type="button" tabindex="500" title="Clear selected files" class="btn btn-default fileinput-remove fileinput-remove-button"><i class="glyphicon glyphicon-trash"></i> Remove</button>
                                                                                <button type="button" tabindex="500" title="Abort ongoing upload" class="btn btn-default hide fileinput-cancel fileinput-cancel-button"><i class="glyphicon glyphicon-ban-circle"></i> Cancel</button>
                                                                                <button type="submit" tabindex="500" title="Upload selected files" class="btn btn-default fileinput-upload fileinput-upload-button"><i class="glyphicon glyphicon-upload"></i> Upload</button>
                                                                                <div tabindex="500" class="btn btn-primary btn-file">
                                                                                    <i class="glyphicon glyphicon-folder-open"></i> &nbsp;Browse …
                                                                                    <input id="input-42" type="file" multiple="true" class="file-loading">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                    <button type="button" class="btn btn-primary">บันทึก</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- จบ modal ความน่าเชื่อถือ-->
                                                    <!-- จบความน่าเชื่อถือ -->

                                                    <!-- ติดต่อลูกค้า --------------------------------------------------------------------------------------------->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">ช่องทางการติดต่อของลูกค้า 
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#CusContact' href="#CusContact">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> <span style="font-size: 20px; color: orange">
                                                                            แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div> 
                                                        </div>
                                                        &nbsp;   <span class="glyphicon glyphicon-earphone">&nbsp</span><span style="font-size: 20px">โทรศัพท์: </span>
                                                        <span style="font-size: 20px; color: orange;"><?= $resdata["tel"] ?></span><br>
                                                        &nbsp;   <span class="glyphicon glyphicon-send">&nbsp</span><span style="font-size: 20px">อีเมล: </span>
                                                        <span style="font-size: 20px; color: orange;"> <?= $resdata["email"] ?></span>
                                                    </div>  

                                                    <!-- modal ติดต่อลูกค้า-->
                                                    <div class="modal fade" id="CusContact" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px">ช่องทางการติดต่อของลูกค้า</div></span>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-4">
                                                                                <span class="form-group">
                                                                                    <select class="form-control" id="ResContact">
                                                                                        <option>โทรศัพท์</option>
                                                                                        <option>อีเมล</option>
                                                                                        <option>แฟกซ์</option>
                                                                                        <option>โซเชียล</option>
                                                                                        <option>เว็บไซต์</option>

                                                                                    </select>
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-8"style="padding-left: 0px;">
                                                                                <input type="text" class="form-control" placeholder="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-1 pull-right" style="margin-right: 8px;">   
                                                                                <div class="round round-lg hollow orange">
                                                                                    <span class="glyphicon glyphicon-plus btn"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                    <button type="button" class="btn btn-primary">บันทึก</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- จบ modal ติดต่อลูกค้า-->
                                                    <!-- จบติดต่อลูกค้า -->
                                                </div>



                                                <div class="col-md-7">
                                                    <!-- ตำแหน่งที่ตั้ง ------------------------------------------------------------------------------>
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            อัพเดตตำแหน่งที่ตั้งปัจจุบัน
                                                        </div>
                                                        <article class="map">
                                                            <p><span style="font-size: 20px">การเชื่อมต่อเพื่อระบุตำแหน่ง:</span> <span id="geostatus" style="font-size: 20px; color:orange;">กำลังค้นหา...</span></p>
                                                        </article>
                                                    </div>

                                                    <div class="card card-content">
                                                        <span style="font-size: 18px;">*จำเป็นต้องอยู่ในบริเวณที่ตั้งร้านของท่าน เพื่อเป็นประโยชน์ในการค้นหาของลูกค้า</span>
                                                        <div class="card-action">
                                                            <p class="text-center">
                                                                <button type="button" class="btn-default">
                                                                    <span class="glyphicon glyphicon-refresh"style="font-size: 20px; color: orange"></span> 
                                                                    <span style="font-size: 20px; color: orange">อัพเดท</span>
                                                                </button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- จบตำแหน่งที่ตั้ง --> 

                                                    <!-- ตำแหน่งที่ตั้งที่บันทึก -->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">ที่อยู่ร้าน
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#Location' href="#Location">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <span style="font-size: 20px;"><?= $resdata["address"] ?></span>

                                                        <!-- modal ตำแหน่งที่ตั้งที่บันทึก-->
                                                        <div class="modal fade" id="Location" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px">รายละเอียดตำแน่งที่ตั้ง</div></span>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <form class="form-horizontal" role="form">
                                                                                    <fieldset>

                                                                                        <!-- Form Name -->


                                                                                        <!-- Text input-->
                                                                                        <div class="form-group">
                                                                                            <label class="col-sm-2 control-label" for="textinput">เลขที่/เลขห้อง</label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text" placeholder="หมายเลขห้อง/เลขที่" class="form-control">
                                                                                            </div>
                                                                                        </div>

                                                                                        <!-- Text input-->
                                                                                        <div class="form-group">
                                                                                            <label class="col-sm-2 control-label" for="textinput">อาคาร</label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text" placeholder="อาคาร" class="form-control">
                                                                                            </div>
                                                                                        </div>

                                                                                        <!-- Text input-->
                                                                                        <div class="form-group">
                                                                                            <label class="col-sm-2 control-label" for="textinput">ซอย/ถนน</label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text" placeholder="ซอย/ถนน" class="form-control">
                                                                                            </div>
                                                                                        </div>

                                                                                        <!-- Text input-->
                                                                                        <div class="form-group">
                                                                                            <label class="col-sm-2 control-label" for="textinput">เขต/อำเภอ</label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text" placeholder="เขต/อำเภอ" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label class="col-sm-2 control-label" for="textinput">แขวง/ตำบล</label>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text" placeholder="แขวง/ตำบล" class="form-control">
                                                                                            </div>
                                                                                        </div>

                                                                                        <!-- Text input-->
                                                                                        <div class="form-group">
                                                                                            <label class="col-sm-2 control-label" for="textinput">จังหวัด</label>
                                                                                            <div class="col-sm-4">
                                                                                                <select class="form-control" id="provincelist">
                                                                                                    <?php
                                                                                                    $res = $con->query("SELECT `id`, `name` FROM `province`");
                                                                                                    while ($data = $res->fetch_assoc()) {
                                                                                                        ?>

                                                                                                        <option value="<?= $data['name'] ?>"> <?= $data['name'] ?> </option>

                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                            </div>

                                                                                            <label class="col-sm-2 control-label" for="textinput">รหัสไปรษณีย์</label>
                                                                                            <div class="col-sm-4">
                                                                                                <input type="text" placeholder="รหัสไปรษณีย์" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                </form>
                                                                            </div><!-- /.col-lg-12 -->
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                            <button type="button" class="btn btn-primary">บันทึก</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- จบ modal ตำแหน่งที่ตั้งที่บันทึก-->


                                                    </div>
                                                    <!-- ตำแหน่งที่ตั้งที่บันทึก -->

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_default_2"><!--รายการสั่งซื้อ-->
                                    <div class="page-header"style="margin-top: 20px;">
                                        <span style="font-size: 40px">เกี่ยวกับรายการสั่งซื้อของลูกค้า</span>
                                    </div>

                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="card card-content" id="showdata_foodbox">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            รูปแบบกล่อง
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_foodbox">
                                                            <?php
                                                            $foodboxRes = $con->query("SELECT food_box.id "
                                                                    . "FROM mapping_food_box "
                                                                    . "LEFT JOIN food_box ON food_box.id = mapping_food_box.food_box_id "
                                                                    . "WHERE mapping_food_box.restaurant_id = '$resid' ");

                                                            $boxRes = $con->query("SELECT food_box.id, food_box.description FROM food_box ");
                                                            while ($boxData = $boxRes->fetch_assoc()) {
                                                                ?>
                                                                <div class="input-group col-md-6" style="margin: 10px 120px;"  >
                                                                    <input type="checkbox" name="foodbox[]" value="<?= $boxData["id"] ?>"><?= $boxData["description"] ?>
                                                                </div>
                                                            <?php } ?>
                                                            <span class="input-group" style="margin-left: 250px;">
                                                                <button class="btn btn-success" id="savebtn" type="button">บันทึก</button>
                                                            </span>
                                                        </form>
                                                    </div>
                                                    <div class="card card-content" id="showdata_limitbox">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            จำนวนกล่องที่สามารถรับรายการสั่งซื้อได้สูงสุด/วัน
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_limitbox">
                                                            <div class="input-group col-md-6" style="margin: 10px 120px;"  >
                                                                <?php if ($resdata["amount_box_limit"] == "") { ?>
                                                                    <div class="input-group col-md-12" id="edit-minimumbox">
                                                                        <input type="number" class="form-control" id="minimumbox"  value="<?= $resdata["amount_box_limit"] ?>" placeholder="จำนวนกล่อง">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                        </span>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div>
                                                                        <span style="font-size: 20px">จำนวนกล่อง: </span>
                                                                        <span style="font-size: 20px; color: orange;"><?= $resdata["amount_box_limit"] ?>&nbsp;</span>
                                                                        <span style="font-size: 20px">กล่อง</span><br>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="card card-content" id="showdata_minimumbox">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            จำนวนกล่องขั้นต่ำ/สั่งซื้อ
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_minimumbox">
                                                            <div class="input-group col-md-6" style="margin: 10px 120px;"  >
                                                                <?php if ($resdata["amount_box_minimum"] == "") { ?>
                                                                    <div class="input-group col-md-12" id="edit-minimumbox">
                                                                        <input type="number" class="form-control" id="minimumbox"  value="<?= $resdata["amount_box_minimum"] ?>" placeholder="จำนวนกล่อง">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                        </span>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div>
                                                                        <span style="font-size: 20px">จำนวนกล่อง: </span>
                                                                        <span style="font-size: 20px; color: orange;"><?= $resdata["amount_box_minimum"] ?>&nbsp;</span>
                                                                        <span style="font-size: 20px">กล่อง</span><br>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card card-content" id="showdata_deliveryfee">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            กำหนดค่าจัดส่ง
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_deliveryfee">
                                                            <div class="input-group col-md-6" style="margin: 10px 120px;"  >
                                                                <div id="showdata">
                                                                    <span style="font-size: 20px"><?= $deliveryData["description"] ?>: </span>
                                                                    <span style="font-size: 20px; color: orange;"><?= ($deliveryData["deliveryfee"] == "" ? '&nbsp;-' : $deliveryData["deliveryfee"]) ?>&nbsp;</span>
                                                                    <span style="font-size: 20px">บาท</span><br>
                                                                </div>
                                                            </div>
                                                            <div class="input-group col-md-6" style="margin: 10px 120px; display: none" id="edit-deliveryfee">
                                                                <input type="text" class="form-control" id="deliveryfee"  value="<?= $deliveryData["deliveryfee"] ?>" placeholder="จำนวนกล่อง">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-success" id="savebtn" type="submit">บันทึก</button>
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="tab_default_3"><!--การชำระเงิน-->
                                    <div class="page-header"style="margin-top: 20px;">
                                        <span style="font-size: 40px">เกี่ยวกับวิธีการชำระเงิน</span>
                                    </div>
                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card card-content" id="showdata_payment">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            รูปแบบการชำระเงิน
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_payment">
                                                            <?php
                                                            $resPaymentRes = $con->query("SELECT payment_type.id, payment_type.description "
                                                                    . "FROM restaurant "
                                                                    . "LEFT JOIN mapping_payment_type ON mapping_payment_type.restaurant_id = restaurant.id "
                                                                    . "LEFT JOIN payment_type ON payment_type.id = mapping_payment_type.payment_type_id"
                                                                    . " WHERE restaurant.id = '$resid' ");
                                                            $hasData = $resPaymentRes->fetch_assoc();


                                                            if ($hasData["id"] == "") {
                                                                $paymentRes = $con->query("SELECT payment_type.id, payment_type.description FROM payment_type");
                                                                while ($paymentData = $paymentRes->fetch_assoc()) {
                                                                    ?>
                                                                    <div class="input-group col-md-6" style="margin: 10px 120px;"  >
                                                                        <input type="checkbox" name="paymentData[]" value="<?= $paymentData["id"] ?>"><?= $paymentData["description"] ?>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                echo '<span class="input-group" style="margin-left: 250px;"><button class="btn btn-success" id="savebtn" type="submit">บันทึก</button></span>';
                                                            } else {
                                                                while ($resPaymentData = $resPaymentRes->fetch_assoc()) {
                                                                    ?>
                                                                    <div class=" col-md-6" style="margin: 10px 120px;"  >
                                                                        <p><?= $resPaymentData["description"] ?></p>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>


                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card card-content" id="showdat_bankaccount">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            ข้อมูลบัญชีธนาคาร
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a  href="#" id="editbtn">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> 
                                                                        <span style="font-size: 20px; color: orange">แก้ไข</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <form id="dataform_edit_bankaccount">
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ธนาคาร</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="ธนาคาร" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ชื่อบัญชี</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="ชื่อบัญชี" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" >
                                                                <label class="col-sm-2 control-label" for="textinput">เลขที่บัญชี</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="เลขที่บัญชี" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" >
                                                                <span class="input-group" style="margin-left: 250px;">
                                                                    <button class="btn btn-success" id="savebtn" type="button" style="    margin-left: 175px;">บันทึก</button>
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_default_4"><!--พนักงานส่ง-->
                                    <div class="page-header"style="margin-top: 20px;">
                                        <span style="font-size: 40px">ข้อมูลเกี่ยวกับพนักงานจัดส่ง</span>
                                    </div>
                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="card card-content" id="showdat_bankaccount">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            เพิ่มข้อมูลของพนักงานจัดส่ง
                                                            
                                                        </div>
                                                        <form id="dataform_edit_bankaccount">
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ชื่อ-สกุล</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="ชื่อ-สกุล" class="form-control">
                                                                </div>
                                                            </div>
                                                             <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">ชื่อ(English)*</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="ตัวอย่าง สมชาย-> Somchai" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 15px;">
                                                                <label class="col-sm-2 control-label" for="textinput">เบอร์โทรศัพท์</label>
                                                                <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                    <input type="text" placeholder="เบอร์โทรศัพท์" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" >
                                                                <span class="input-group" style="margin-left: 250px;">
                                                                    <button class="btn btn-success" id="savebtn" type="button" style="    margin-left: 260px;">บันทึก</button>
                                                                </span>
                                                            </div><hr>
                                                            <p>*ข้อมูลนี้จำเป็นเพราะจะต้องนำไปเป็น username ในการเข้าสู่ระบบตอนพนักงานนำสินค้าไปส่งลูกค้า </p><br>
                                                            <p>การใช้ Username ของพนักงานจัดส่ง คือ หมายเลขร้าน ตามด้วยชื่อ  </p><br>
                                                            <p>ตัวอย่าง Username คือ 12Somchai และ Password คือ เบอร์โทศัพท์ของพนักงานจัดส่ง </p>
                                                        </form>
                                                    </div>
                                                </div>
                                                 <div class="col-md-5">
                                                    <div class="card card-content" id="showdat_bankaccount">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            ข้อมูลข้อมูลของพนักงานจัดส่ง
                                                            
                                                        </div>
                                                        <p style="text-align: center;font-size: 20px">ยังไม่มีข้อมูล</p>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- start footer -->
    <?php include '../template/footer.php'; ?>
    <!--<script src="/assets/bootstrap-fileinput-master/js/fileinput.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/fileinput.min.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/fileinput_locale_LANG.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.min.js"></script>-->

    <script>
        $(document).ready(function () {
            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
                $(".tab").addClass("active"); // instead of this do the below 
                $(this).removeClass("btn-default").addClass("btn-warning");
            });

            $('#imagerest').on('change', function (e) {
                var filename = $('#imagerest').val();
                var fname = filename.substring(12);
                var name = "File: " + fname;
                $("#uploadtext").html(name);
                $("#chooseimgbtn").hide();
                $("#uploadimgbtn").show();
            });

            $("#switchClose").click(function (e) {
                $.ajax({
                    type: "POST",
                    url: "/restaurant/edit-close-restaurant.php",
                    data: {"resId": $("#resIdvalue").val(),
                        "close": $("#switchClose").val()},
                    dataType: "json",
                    success: function (data) {
                        $("#switchClose").removeAttr("checked");
                        if (data.result == "1") {
                            $("#switchClose").attr("checked");
                            document.location.reload();
                        } else if (data.result == "0") {
                            $("#switchClose").removeAttr("checked");
                            //document.location.reload();
                        } else {
                            alert("ไม่สามารถบันทึกข้อมูลได้\nError : " + data.error);
                        }
                    }
                });
            });
        });
    </script>

    <!--maps--> 
    <script>
        // Primary function for the Geo location app
        function success(position) {
            // create a simple variable for the ID
            var s = document.querySelector('#geostatus');

            if (s.className == 'success') {
                return;
            }

            // Replaces text with new message
            s.innerHTML = "พบตำแหน่งของคุณแล้ว!";
            // Adds new class to the ID status block
            s.className = 'success';

            // creates map wrapper for responsiveness
            var mapwrapper = document.createElement('div');
            mapwrapper.className = 'mapwrapper';

            // creates the block element at sets the width and height
            var mapcanvas = document.createElement('div');
            // Adds ID to the new div
            mapcanvas.id = 'mapcanvas';

            // Adds the new block element as the last thing within the article block
            document.querySelector('.map').appendChild(mapwrapper);

            // Adds the new block element as the last thing within the mapwrapper block
            document.querySelector('.mapwrapper').appendChild(mapcanvas);


            // creates a new variable 'latlng' off of the google maps object
            var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            // create new variable that contains options in key:value pairs
            var myOptions = {
                zoom: 15,
                center: latlng,
                // ROADMAP is set by default, other options are HYBRID, SATELLITE and TERRAIN
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            // creates the new 'map' variable using the google object
            // then using the 'mapcanvas' ID appending the options
            var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

            // creates new 'marker' variable
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: "You are here! (at least within a " + position.coords.accuracy + " meter radius)"
            });
        }

        // Function that displays the error message
        function error(msg) {

            // sets simple variable to the status ID
            var s = document.querySelector('#geostatus');
            // designates typ eof message and passes in value                         s.innerHTML = typeof msg == 'string' ? msg : "ไม่สามารถค้นหาตำแหน่งได้";
            s.className = 'fail';
        }


        // statement that tests for device functionality
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        } else {
            error('not supported');
        }

        var mapwrapper = document.createElement('div');
        mapwrapper.className = 'mapwrapper';

    </script>
</body>
</html>
