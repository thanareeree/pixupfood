<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../dbconn.php';
?>




<html>
    <head>
        <meta charset="UTF-8">
        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->

        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <?php
        addlink("Customer Profile");
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/res_restaurant_manage.css">
        <link rel="stylesheet" href="../assets/css/Maps.css">
        <script src="../assets/bootstrap-fileinput-master/js/fileinput.js"></script>
        <script src="../assets/bootstrap-fileinput-master/js/fileinput.min.js"></script>
        <script src="../assets/bootstrap-fileinput-master/js/fileinput_locale_LANG.js"></script>
        <script src="../assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.js"></script>
        <script src="../assets/bootstrap-fileinput-master/js/plugins/canvas-to-blob.min.js"></script>



    </head>
    <body>

        <?php cusnavbar(); ?>

        <!-- start head -->
        <section id="head">
            <div id="myCarousel" class="carousel" style="margin-top:70px;">
                <!-- Indicators -->
                <div class="item">
                    <img src="../assets/images/slide/aa.png" class="img-responsive">
                    <div class="container">
                        <div class="carousel-caption-new">
                            <div class="RestaurantHeader">
                                ร้านนายใหญ่โภชนา
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
        <!-- end head-->

        <!-- Menu Bar-->
        <!--Menu Item-->
    <scetion id="menu">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_today.php">
                    <button type="button" id="today" class="btn btn-default">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">วันนี้</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_order.php">
                    <button type="button" id="orders" class="btn btn-default" data-toggle="tab">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">รายการสั่งซื้อ</div>
                    </button>
                </a>
            </div><div class="btn-group" role="group">
                <a href="res_restaurant_manage_calendar.php">
                    <button type="button" id="calendar" class="btn btn-default" data-toggle="tab">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">ปฏิทิน</div>
                    </button>
                </a>
            </div><div class="btn-group" role="group">
                <a href="res_restaurant_manage_menulist.php">
                    <button type="button" id="menulist" class="btn btn-default" data-toggle="tab">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">รายการอาหาร</div>
                    </button>
                </a>
            </div><div class="btn-group" role="group">
                <a href="res_restaurant_manage_edit.php">
                    <button type="button" id="editres" class="btn btn-default" data-toggle="tab">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
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
                                    <a href="#tab_default_1" data-toggle="tab">
                                        ทั่วไป </a>
                                </li>
                                <li>
                                    <a href="#tab_default_2" data-toggle="tab">
                                        พนักงานจัดส่ง </a>
                                </li>
                                <li>
                                    <a href="#tab_default_3" data-toggle="tab">
                                        วิธีการชำระเงิน </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    <div class="page-header"style="
                                         margin-top: 20px;
                                         ">
                                        <span style="font-size: 40px">การตั้งค่า</span>
                                    </div>

                                    <div class="card">
                                        <div class="card-content">
                                            <span style="font-size: 35px;">ตั้งค่าทั่วไป</span>
                                            <div class="row">
                                                <div class="col-md-5">

                                                    <!-- สถานะร้านค้า-->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            สถานะร้านค้า
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#StatusRes' href="#StatusRes">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> <span style="font-size: 20px; color: orange">
                                                                            แก้ไข</span></a></p>
                                                            </div>
                                                        </div>
                                                        <div class="material-switch" style="margin-left: 27%">
                                                            <span style="font-size: 20px"> ปิดร้าน </span> &nbsp;
                                                            <input id="someSwitchOptionSuccess2" name="someSwitchOption001" type="checkbox"/>
                                                            <label for="someSwitchOptionSuccess2" class="label-success"></label>
                                                            &nbsp;  <span style="font-size: 20px">เปิดร้าน</span>
                                                        </div>
                                                        <hr>
                                                        <span style="font-size: 20px">เปิดร้านอัตโนมัติเวลา: </span>
                                                        <span style="font-size: 20px; color: orange;"> 08.00น.-20.00น. </span><br>
                                                        <span style="font-size: 20px; color: red;"> *ปิดระบบอัติโนมัติชั่วคราว 3 วัน </span>

                                                    </div>
                                                    <!-- modal สถานะร้านค้า-->
                                                    <div class="modal fade" id="StatusRes" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h2 class="modal-title" id="myModalLabel" >สถานะร้านค้า</h2>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="radio"> 
                                                                        <label><input type="radio" style="width: 21px;height: 21px;margin-top: 7px;">&nbsp;<span style="font-size: 25px">เลือกเพื่อเปิดการทำงานระบบอัตโนมัติ</span></label>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="timeres" style="width: 23px;height: 23px;margin-top: 8px;"> <span style="font-size: 20px"> &nbsp;เวลาเปิดร้านในระบบอัตโนมัติ <input type="time"> ถึง <input type="time"> </span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-md-8" style="padding-right: 0px;">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" value="timeres" style="width: 23px;height: 23px;margin-top: 8px;"> 
                                                                                    <span style="font-size: 20px"> &nbsp;ตั้งเวลาปิดระบบเปิดร้านอัตโนมัติชั่วคราว 
                                                                                        <input type="number" style="width: 20%"> 
                                                                                    </span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4"style="padding-left: 0px;margin-top: 11px;">
                                                                            <span class="form-group">
                                                                                <select class="form-control" id="sel1"style="width: 50%">
                                                                                    <option>นาที</option>
                                                                                    <option>ชั่วโมง</option>
                                                                                    <option>วัน</option>
                                                                                    <option>เดือน</option>
                                                                                    <option>ปี</option>
                                                                                </select>
                                                                            </span>   
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


                                                    <!-- ปิดmodal สถานะร้านค้า-->

                                                    <!-- จบสถานะร้านค้า-->

                                                    <!-- ร้านค้าหมายเลข -->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">ร้านค้าหมายเลข <span style="font-size: 30px; color: orange;"> 108</span>
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#Resno' href="#Resno">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> <span style="font-size: 20px; color: orange">
                                                                            แก้ไข</span></a></p>
                                                            </div>
                                                        </div>

                                                        &nbsp;   <span style="font-size: 20px">ชื่อร้าน: </span>
                                                        <span style="font-size: 20px; color: orange;"> นายใหญ่โภชนา </span><br>
                                                        &nbsp;   <span style="font-size: 20px">ประเภทร้าน: </span>
                                                        <span style="font-size: 20px; color: orange;"> ร้านอาหารตามสั่ง </span><br>
                                                        &nbsp;   <span style="font-size: 20px">หน้าร้าน: </span>
                                                        <span style="font-size: 20px; color: orange;"> มี </span><br>


                                                    </div>

                                                    <!-- modal ร้านค้าหมายเลข-->
                                                    <div class="modal fade" id="Resno" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <span class="modal-title" id="myModalLabel"><div style="font-size: 30px; margin-top: 5px">ร้านค้าหมายเลข <span style="font-size: 30px; color: orange;"> 108</span></div></span>
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

                                                    <!-- ความน่าเชื่อถือ -->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">
                                                            ระดับความน่าเชื่อถือ
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#Turst' href="#Turst">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> <span style="font-size: 20px; color: orange">
                                                                            แก้ไข</span></a></p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-5"><img src="../assets/images/ResClass/middle.png"></div>
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
                                                                        <div class="col-md-3" style="padding-middle"><img src="../assets/images/ResClass/Standard.png"></div>
                                                                        <div class="col-md-3" style="padding-middle"><img src="../assets/images/ResClass/middle.png"></div>
                                                                        <div class="col-md-3" style="padding-middle"><img src="../assets/images/ResClass/High.png"></div>
                                                                        <div class="col-md-3" style="padding-middle"><img src="../assets/images/ResClass/Premium.png"></div>
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

                                                    <!-- ติดต่อลูกค้า -->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">ช่องทางการติดต่อของลูกค้า 
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#CusContact' href="#CusContact">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> <span style="font-size: 20px; color: orange">
                                                                            แก้ไข</span></a></p>
                                                            </div> 
                                                        </div>
                                                        &nbsp;   <span class="glyphicon glyphicon-earphone">&nbsp</span><span style="font-size: 20px">โทรศัพท์: </span>
                                                        <span style="font-size: 20px; color: orange;"> 081-234-5678 </span><br>
                                                        &nbsp;   <span class="glyphicon glyphicon-comment">&nbsp</span><span style="font-size: 20px">เฟสบุค: </span>
                                                        <span style="font-size: 20px; color: orange;"> fb.com/naiyaires </span><br>
                                                        &nbsp;   <span class="glyphicon glyphicon-comment">&nbsp</span><span style="font-size: 20px">ไลน์: </span>
                                                        <span style="font-size: 20px; color: orange;"> naiyaires </span><br>
                                                        &nbsp;   <span class="glyphicon glyphicon-send">&nbsp</span><span style="font-size: 20px">อีเมล: </span>
                                                        <span style="font-size: 20px; color: orange;"> naiyai@mail.com </span><br>
                                                        &nbsp;   <span class="glyphicon glyphicon-print">&nbsp</span><span style="font-size: 20px">แฟกซ์: </span>
                                                        <span style="font-size: 20px; color: orange;"> 02-345-6789 </span><br>
                                                        &nbsp;   <span class="glyphicon glyphicon-globe">&nbsp</span><span style="font-size: 20px">เว็บไซต์: </span>
                                                        <span style="font-size: 20px; color: orange;"> www.naiyai.com </span><br>

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
                                                    </div>

                                                    <!-- จบติดต่อลูกค้า -->
                                                </div>



                                                <div class="col-md-7">
                                                    <!-- ตำแหน่งที่ตั้ง -->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">ตำแหน่งที่ตั้งปัจจุบัน

                                                        </div>

                                                        <article class="map">
                                                            <p><span style="font-size: 20px">การเชื่อมต่อเพื่อระบุตำแหน่ง:</span> <span id="geostatus" style="font-size: 20px; color:orange;">กำลังค้นหา...</span></p>
                                                        </article>

                                                    </div>
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">รายละเอียดตำแน่งที่ตั้งปัจจุบัน</div>
                                                        <span style="font-size: 20px;"> 126 ถนนประชาอุทิศ แขวงบางมด เขตทุ่งครุ จังหวัดกรุงเทพมหานคร 10140 </span>


                                                        <div class="card-action">

                                                            <p class="text-center">
                                                                <a href="#">
                                                                    <span class="glyphicon glyphicon-refresh"style="font-size: 20px; color: orange"></span> <span style="font-size: 20px; color: orange">
                                                                        อัพเดท</span></a></p>
                                                        </div>


                                                    </div>

                                                     <!-- จบตำแหน่งที่ตั้ง --> 
                                                    <!-- ตำแหน่งที่ตั้งที่บันทึก -->
                                                    <div class="card card-content">
                                                        <div class="page-header" style="font-size: 30px; margin-top: 5px">รายละเอียดตำแน่งที่ตั้งที่ถูกบันทึกไว้
                                                            <div class="pull-right">
                                                                <p class="text-center">
                                                                    <a data-toggle="modal" data-target='#Location' href="#Location">
                                                                        <span class="glyphicon glyphicon-pencil"style="font-size: 20px; color: orange"></span> <span style="font-size: 20px; color: orange">
                                                                            แก้ไข</span></a></p>
                                                            </div>

                                                        </div>
                                                        <span style="font-size: 20px;"> 126 ถนนประชาอุทิศ แขวงบางมด เขตทุ่งครุ จังหวัดกรุงเทพมหานคร 10140 </span>

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
                                <div class="tab-pane" id="tab_default_2">



                                </div>
                                <div class="tab-pane" id="tab_default_3">



                                </div>
                            </div>
                        </div>

                    </div>
                    </section>


                    <!-- start footer -->
                    <?php
                    show_footer();
                    ?>
                    <script src="../assets/js/jquery.singlePageNav.min.js"></script>


                    <script>
                        $(document).ready(function () {
                            $(".btn-pref .btn").click(function () {
                                $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
                                $(".tab").addClass("active"); // instead of this do the below 
                                $(this).removeClass("btn-default").addClass("btn-warning");
                            });
                        });
                    </script>


                    <!--for old News-->
                    <script>
                        $(document).ready(function () {
                            $('#pinBoot').pinterest_grid({
                                no_columns: 4,
                                padding_x: 10,
                                padding_y: 10,
                                margin_bottom: 50,
                                single_column_breakpoint: 700
                            });
                        });

                        /*
                         Ref:
                         Thanks to:
                         http://www.jqueryscript.net/layout/Simple-jQuery-Plugin-To-Create-Pinterest-Style-Grid-Layout-Pinterest-Grid.html
                         */


                        /*
                         Pinterest Grid Plugin
                         Copyright 2014 Mediademons
                         @author smm 16/04/2014
                     
                         usage:
                     
                         $(document).ready(function() {
                     
                         $('#blog-landing').pinterest_grid({
                         no_columns: 4
                         });
                     
                         });
                     
                     
                         */
                        ;
                        (function ($, window, document, undefined) {
                            var pluginName = 'pinterest_grid',
                                    defaults = {
                                        padding_x: 10,
                                        padding_y: 10,
                                        no_columns: 3,
                                        margin_bottom: 50,
                                        single_column_breakpoint: 700
                                    },
                            columns,
                                    $article,
                                    article_width;

                            function Plugin(element, options) {
                                this.element = element;
                                this.options = $.extend({}, defaults, options);
                                this._defaults = defaults;
                                this._name = pluginName;
                                this.init();
                            }

                            Plugin.prototype.init = function () {
                                var self = this,
                                        resize_finish;

                                $(window).resize(function () {
                                    clearTimeout(resize_finish);
                                    resize_finish = setTimeout(function () {
                                        self.make_layout_change(self);
                                    }, 11);
                                });

                                self.make_layout_change(self);

                                setTimeout(function () {
                                    $(window).resize();
                                }, 500);
                            };

                            Plugin.prototype.calculate = function (single_column_mode) {
                                var self = this,
                                        tallest = 0,
                                        row = 0,
                                        $container = $(this.element),
                                        container_width = $container.width();
                                $article = $(this.element).children();

                                if (single_column_mode === true) {
                                    article_width = $container.width() - self.options.padding_x;
                                } else {
                                    article_width = ($container.width() - self.options.padding_x * self.options.no_columns) / self.options.no_columns;
                                }

                                $article.each(function () {
                                    $(this).css('width', article_width);
                                });

                                columns = self.options.no_columns;

                                $article.each(function (index) {
                                    var current_column,
                                            left_out = 0,
                                            top = 0,
                                            $this = $(this),
                                            prevAll = $this.prevAll(),
                                            tallest = 0;

                                    if (single_column_mode === false) {
                                        current_column = (index % columns);
                                    } else {
                                        current_column = 0;
                                    }

                                    for (var t = 0; t < columns; t++) {
                                        $this.removeClass('c' + t);
                                    }

                                    if (index % columns === 0) {
                                        row++;
                                    }

                                    $this.addClass('c' + current_column);
                                    $this.addClass('r' + row);

                                    prevAll.each(function (index) {
                                        if ($(this).hasClass('c' + current_column)) {
                                            top += $(this).outerHeight() + self.options.padding_y;
                                        }
                                    });

                                    if (single_column_mode === true) {
                                        left_out = 0;
                                    } else {
                                        left_out = (index % columns) * (article_width + self.options.padding_x);
                                    }

                                    $this.css({
                                        'left': left_out,
                                        'top': top
                                    });
                                });

                                this.tallest($container);
                                $(window).resize();
                            };

                            Plugin.prototype.tallest = function (_container) {
                                var column_heights = [],
                                        largest = 0;

                                for (var z = 0; z < columns; z++) {
                                    var temp_height = 0;
                                    _container.find('.c' + z).each(function () {
                                        temp_height += $(this).outerHeight();
                                    });
                                    column_heights[z] = temp_height;
                                }

                                largest = Math.max.apply(Math, column_heights);
                                _container.css('height', largest + (this.options.padding_y + this.options.margin_bottom));
                            };

                            Plugin.prototype.make_layout_change = function (_self) {
                                if ($(window).width() < _self.options.single_column_breakpoint) {
                                    _self.calculate(true);
                                } else {
                                    _self.calculate(false);
                                }
                            };

                            $.fn[pluginName] = function (options) {
                                return this.each(function () {
                                    if (!$.data(this, 'plugin_' + pluginName)) {
                                        $.data(this, 'plugin_' + pluginName,
                                                new Plugin(this, options));
                                    }
                                });
                            };

                        })(jQuery, window, document);
                    </script>
                    <script>
                        $(document).ready(function () {
                            $('#characterLeft').text('140 characters left');
                            $('#message').keydown(function () {
                                var max = 140;
                                var len = $(this).val().length;
                                if (len >= max) {
                                    $('#characterLeft').text('You have reached the limit');
                                    $('#characterLeft').addClass('red');
                                    $('#btnSubmit').addClass('disabled');
                                }
                                else {
                                    var ch = max - len;
                                    $('#characterLeft').text(ch + ' characters left');
                                    $('#btnSubmit').removeClass('disabled');
                                    $('#characterLeft').removeClass('red');
                                }
                            });
                        });


                    </script>

                    <script>
                        +function ($) {
                            'use strict';
                            var uploadForm = document.getElementById('js-upload-form');

                            var startUpload = function (files) {
                                console.log(files)
                            }

                            uploadForm.addEventListener('submit', function (e) {
                                var uploadFiles = document.getElementById('js-upload-files').files;
                                e.preventDefault()

                                startUpload(uploadFiles)
                            })
                        }(jQuery);
                    </script>

                    <!-- Compost Button-->
                    <script>
                        $('.fab').hover(function () {
                            $(this).toggleClass('active');
                        });
                        $(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                    </script>

                    <script>
                                /**
                                 *   I don't recommend using this plugin on large tables, I just wrote it to make the demo useable. It will work fine for smaller tables 
                                 *   but will likely encounter performance issues on larger tables.
                                 *
                                 *		<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
                                 *		$(input-element).filterTable()
                                 *		
                                 *	The important attributes are 'data-action="filter"' and 'data-filters="#table-selector"'
                                 */
                                        (function () {
                                            'use strict';
                                            var $ = jQuery;
                                            $.fn.extend({
                                                filterTable: function () {
                                                    return this.each(function () {
                                                        $(this).on('keyup', function (e) {
                                                            $('.filterTable_no_results').remove();
                                                            var $this = $(this),
                                                                    search = $this.val().toLowerCase(),
                                                                    target = $this.attr('data-filters'),
                                                                    $target = $(target),
                                                                    $rows = $target.find('tbody tr');

                                                            if (search == '') {
                                                                $rows.show();
                                                            } else {
                                                                $rows.each(function () {
                                                                    var $this = $(this);
                                                                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                                                                })
                                                                if ($target.find('tbody tr:visible').size() === 0) {
                                                                    var col_count = $target.find('tr').first().find('td').size();
                                                                    var no_results = $('<tr class="filterTable_no_results"><td colspan="' + col_count + '">No results found</td></tr>')
                                                                    $target.find('tbody').append(no_results);
                                                                }
                                                            }
                                                        });
                                                    });
                                                }
                                            });
                                            $('[data-action="filter"]').filterTable();
                                        })(jQuery);

                                $(function () {
                                    // attach table filter plugin to inputs
                                    $('[data-action="filter"]').filterTable();

                                    $('.container').on('click', '.panel-heading span.filter', function (e) {
                                        var $this = $(this),
                                                $panel = $this.parents('.panel');

                                        $panel.find('.panel-body').slideToggle();
                                        if ($this.css('display') != 'none') {
                                            $panel.find('.panel-body input').focus();
                                        }
                                    });
                                    $('[data-toggle="tooltip"]').tooltip();
                                })
                                        /* Calendar Table */

                                                /**
                                                 *   I don't recommend using this plugin on large tables, I just wrote it to make the demo useable. It will work fine for smaller tables 
                                                 *   but will likely encounter performance issues on larger tables.
                                                 *
                                                 *		<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
                                                 *		$(input-element).filterTable()
                                                 *		
                                                 *	The important attributes are 'data-action="filter"' and 'data-filters="#table-selector"'
                                                 */
                                                        (function () {
                                                            'use strict';
                                                            var $ = jQuery;
                                                            $.fn.extend({
                                                                filterTable: function () {
                                                                    return this.each(function () {
                                                                        $(this).on('keyup', function (e) {
                                                                            $('.filterTable_no_results').remove();
                                                                            var $this = $(this),
                                                                                    search = $this.val().toLowerCase(),
                                                                                    target = $this.attr('data-filters'),
                                                                                    $target = $(target),
                                                                                    $rows = $target.find('tbody tr');

                                                                            if (search == '') {
                                                                                $rows.show();
                                                                            } else {
                                                                                $rows.each(function () {
                                                                                    var $this = $(this);
                                                                                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                                                                                })
                                                                                if ($target.find('tbody tr:visible').size() === 0) {
                                                                                    var col_count = $target.find('tr').first().find('td').size();
                                                                                    var no_results = $('<tr class="filterTable_no_results"><td colspan="' + col_count + '">No results found</td></tr>')
                                                                                    $target.find('tbody').append(no_results);
                                                                                }
                                                                            }
                                                                        });
                                                                    });
                                                                }
                                                            });
                                                            $('[data-action="filter"]').filterTable();
                                                        })(jQuery);

                                                $(function () {
                                                    // attach table filter plugin to inputs
                                                    $('[data-action="filter"]').filterTable();

                                                    $('.container').on('click', '.panel-heading span.filter', function (e) {
                                                        var $this = $(this),
                                                                $panel = $this.parents('.panel');

                                                        $panel.find('.panel-body').slideToggle();
                                                        if ($this.css('display') != 'none') {
                                                            $panel.find('.panel-body input').focus();
                                                        }
                                                    });
                                                    $('[data-toggle="tooltip"]').tooltip();
                                                })


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
                                                    // designates typ eof message and passes in value
                                                    s.innerHTML = typeof msg == 'string' ? msg : "ไม่สามารถค้นหาตำแหน่งได้";
                                                    s.className = 'fail';
                                                }


                                                // statement that tests for device functionality
                                                if (navigator.geolocation) {
                                                    navigator.geolocation.getCurrentPosition(success, error);
                                                } else {
                                                    error('not supported');
                                                }

                    </script>

                    <script>
                                                var mapwrapper = document.createElement('div');
                                                mapwrapper.className = 'mapwrapper';
                    </script>

                    </body>
                    </html>
