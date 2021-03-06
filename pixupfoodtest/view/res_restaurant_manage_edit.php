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
        <style>

            .address{
                background: #ff8100;
                color:white;
                font-weight: 400;
                padding:10px;
                border-radius: 5px;
                margin-top:10px;
                margin-bottom: 30px;
                font-size:16px;
                line-height: 40px;
                height:57px;
            }
        </style>



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
                        <div class="hidden-xs">ตารางการจัดส่งสินค้า</div>
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
                                    <a href="/view/res_restaurant_manage_edit.php" >ทั่วไป </a>
                                </li>
                                <li >
                                    <a href="/view/res_manage_edit_order.php" > เกี่ยวกับรายการสั่งซื้อ</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_payment.php" >วิธีการชำระเงิน</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_deliveryplace.php" >พื้นที่จัดส่งสินค้า</a>
                                </li>
                                <li>
                                    <a href="/view/res_manage_edit_messenger.php" > พนักงานจัดส่ง</a>
                                </li>
                                <li >
                                    <a href="/view/res_manage_edit_promotion.php" >โปรโมชั่น</a>
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
                                                            <input id="switchClose" name="someSwitchOption001" type="checkbox" <?= ($resdata["close"] == 1 ? 'checked' : '') ?>/>
                                                            <label for="switchClose" class="label-success"></label>
                                                            &nbsp;  <span style="font-size: 20px">ปิดร้าน*</span><br><br>

                                                        </div> <hr>
                                                        <p style="font-size: 20px;">เวลาเปิด-ปิด(รับรายการสั่งซื้อ):<span style="color: #FF9900"> &nbsp;<?= ($resdata["opentime"] == "" ? '-' : $resdata["opentime"]) ?></span></p>
                                                        <hr>
                                                        <span style="color: red">*กรณีวันที่ไม่สามารถรับรายการสั่งซื้อได้ อาทิ วันหยุดพักผ่อน</span>
                                                    </div>




                                                    <!-- modal สถานะร้านค้า-->
                                                    <div class="modal fade" id="StatusRes" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="/restaurant/edit-opentime.php?resId=<?= $resid ?>" method="post">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h2 class="modal-title" id="myModalLabel" >สถานะร้านค้า</h2>
                                                                    </div>

                                                                    <div class="modal-body">

                                                                        <div class="form-group col-sm-12" >
                                                                            <label class="col-sm-2 control-label" for="textinput">เวลาเปิด:</label>
                                                                            <div class="col-sm-4" style="margin-bottom: 15px;">
                                                                                <input required="" type="time" class="form-control col-md-3" name="opentime" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-sm-12" >
                                                                            <label class="col-sm-2 control-label" for="textinput">เวลาปิด:</label>
                                                                            <div class="col-sm-4" style="margin-bottom: 15px;">
                                                                                <input required=""type="time" class="form-control" name="closetime">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                        <button type="submit" class="btn btn-primary">บันทึก</button>
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

                                                        <?php
                                                        if ($resdata["has_restaurant"] == 1) {
                                                            $restype = "มี";
                                                        } else {
                                                            $restype = "ไม่มี";
                                                        }
                                                        ?>

                                                        &nbsp;   <span style="font-size: 20px">ชื่อร้าน: </span>
                                                        <span style="font-size: 20px; color: orange;"> <?= $resdata["name"] ?></span><br>
                                                        &nbsp;   <span style="font-size: 20px">ประเภทร้าน:</span>
                                                        <span style="font-size: 20px; color: orange;"> <?= ($resdata["restaurant_type"] == "" ? '-' : $resdata["restaurant_type"]) ?> </span><br>
                                                        &nbsp;   <span style="font-size: 20px">หน้าร้าน: </span>
                                                        <span style="font-size: 20px; color: orange;"> <?= ($resdata["has_restaurant"] == "" ? '-' : $restype) ?> </span><br>
                                                    </div>

                                                    <!-- modal ร้านค้าหมายเลข-->
                                                    <div class="modal fade" id="Resno" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="post" action="/restaurant/edit-info-res.php?resId=<?= $resid ?>">
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
                                                                                    <input type="text" style="width: 50%; margin-top: 3px;" name="resname" value="<?= $resdata["name"] ?>"><br><br>
                                                                                    <span class="form-group">
                                                                                        <select class="form-control" id="restaurant_type" name="restaurant_type"style="width: 50%; margin-top: 4px;" <?= ($resdata["restaurant_type"] == "") ? '' : $resdata["restaurant_type"] ?>>
                                                                                            <option value="อาหารตามสั่ง">อาหารตามสั่ง</option>
                                                                                            <option value="อาหารคลีน">อาหารคลีน</option>
                                                                                            <option value="อาหารเจ">อาหารเจ</option>
                                                                                            <option value="อาหารมังสวิรัต">อาหารมังสวิรัต</option>
                                                                                            <option value="อาหารเหนือ">อาหารเหนือ</option>
                                                                                            <option value="อาหารอีสาน">อาหารอีสาน</option>
                                                                                            <option value="อาหารใต้">อาหารใต้</option>
                                                                                        </select>
                                                                                    </span><br>  
                                                                                    <span class="form-group">

                                                                                        <select class="form-control" style="width: 50%; margin-top: 4px;" id="has_rest" name="has_rest" <?= ($resdata["has_restaurant"] == "") ? '' : $resdata["has_restaurant"] ?>>
                                                                                            <option value="1">มี</option>
                                                                                            <option value="0">ไม่มี</option>

                                                                                        </select>
                                                                                    </span>   
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                                                    </div>
                                                                </form>
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
                                                    <!-- <div class="card card-content">
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
                                                    /* $level = $resdata["level"];
                                                      if ($level == "พื้นฐาน") {
                                                      echo '<img src="/assets/images/ResClass/Standard.png">';
                                                      } else if ($level == "กลาง") {
                                                      echo '<img src="/assets/images/ResClass/middle.png">';
                                                      } else if ($level == "สูง") {
                                                      echo '<img src="/assets/images/ResClass/High.png">';
                                                      } else {
                                                      echo '<img src="/assets/images/ResClass/Premium.png">';
                                                      } */
                                                    ?>
                                                             </div>
                                                         </div>
                                                     </div>-->

                                                    <!-- modal ความน่าเชื่อถือ-->
                                                    <!--<div class="modal fade" id="Turst" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
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
                                                     </div>-->
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
                                                                <form action="/restaurant-setting/edit-tel-email.php" method="post">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group" style="margin-bottom: 15px;">
                                                                                    <label class="col-sm-2 control-label" for="textinput">โทรศัพท์</label>
                                                                                    <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                                        <input type="text" placeholder="โทรศัพท์" class="form-control" id="tel" name="tel" required="" value="<?= $resdata["tel"] ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group" style="margin-bottom: 15px;">
                                                                                    <label class="col-sm-2 control-label" for="textinput">อีเมล</label>
                                                                                    <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                                        <input type="text" placeholder="อีเมล" class="form-control" id="email" name="email" required="" value="<?= $resdata["email"] ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                                                    </div>
                                                                </form>
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
                                                            <div class="address">
                                                                <div id="showaddress" class='col-sm-12'>
                                                                    ไม่สามารถหาที่อยู่ได้
                                                                </div>
                                                            </div>
                                                            <p class="text-center">
                                                                <button type="button" class="btn-default btn" id="savenewaddressbtn">
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
                                                                        <form class="form-horizontal" action="/restaurant-setting/edit-addres.php" method="post">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <fieldset>
                                                                                        <div class="form-group">
                                                                                            <label class="col-sm-2 control-label" for="textinput">ที่อยู่ร้าน</label>
                                                                                            <div class="col-sm-10">
                                                                                                <textarea required  class="form-control" placeholder="" rows="4" id="resaddress" name="resaddress" style="margin: 0;"><?= $resdata["address"] ?></textarea>

                                                                                            </div>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                                                            </div>
                                                                        </form>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="msgModal"  >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                       กรุณาบันทึกข้อมูลหรือแก้ไขข้อมูลในส่วนของการตั้งค่าเกี่ยวกับรายการสั่งซื้อ วิธีการชำระเงิน และข้อมูลพนักงานจัดส่งให้ครบถ้วน  
                    </div>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-default" data-dismiss="modal">ตกลง</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- start footer -->
    <?php include '../template/footer.php'; ?>
    <!--<script src="/assets/bootstrap-fileinput-master/js/fileinput.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/fileinput.min.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/fileinput_locale_LANG.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.js"></script>
    <script src="/assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.min.js"></script>-->

    <script src="/assets/js/restaurant-setting.js"></script>

</body>
</html>
