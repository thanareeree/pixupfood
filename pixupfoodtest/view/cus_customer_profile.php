<?php
include '../api/islogin.php';
include '../dbconn.php';
?>




<html>
    <head>

        <title>Customer Profile</title>
        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/profile.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    </head>
    <body>
        <?php
        $cusid = $_SESSION["userdata"]["id"];
        $res2 = $con->query("select * from customer where id = '$cusid' ");
        $data2 = $res2->fetch_assoc();

        $res3 = $con->query("SELECT * FROM `shippingAddress` WHERE customer_id = '$cusid'");
        ?>

        <?php include '../template/customer-navbar.php'; ?>
        <!-- start profile -->
        <section id="profile">
            <!-- modal -->
            <?php include '../customer-profile/modal-edit-change.php'; ?>

            <div class="container">
                <div class="row" style="margin-top:50px">
                    <?php include '../customer-profile/list-icon.php'; ?>
                </div>

                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content" style="margin-top:-50px;">
                            <!-- order tracking -->
                            <div class="tab-pane fade  active in" id="tracking">
                                <div class="content2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px;">
                                                           รายการสั่งด่วน 
                                                        </div>
                                                        <!-- ตารางรายการติดตาม -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="#" method="get">
                                                                    <div class="input-group">
                                                                        <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                        <input class="form-control" id="system-search" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required style="height: 34px;">
                                                                        <span class="input-group-btn">
                                                                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <table class="table table-list-search  table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>เลขที่รายการ</th>
                                                                            <th>รายการอาหาร</th>
                                                                            <th>จำนวน(ขุด)</th>
                                                                            <th>สถานะ</th>
                                                                            <th>รายละเอียด</th>
                                                                            <th>หลักฐานการโอนเงิน</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover" id="showFastOrder">
                                                                        

                                                                    </tbody>
                                                                </table>   
                                                            </div>
                                                        </div>
                                                        <!-- จบตารางรายการติดตาม -->

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel" style="margin:10px 0 10px 0;">
                                                <div class="card" style="margin:0;">
                                                    <div class="card-content">
                                                        <div class="page-header" style="font-size: 25px; margin-top: 5px">
                                                            รายการสั่งปกติ 
                                                        </div>
                                                        <!-- ตารางรายการติดตาม -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="#" method="get">
                                                                    <div class="input-group">
                                                                        <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                                                                        <input class="form-control" id="system-search2" name="q" placeholder="ค้นหาข้อมูลในตารางนี้" required style="height: 34px;">
                                                                        <span class="input-group-btn">
                                                                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <table class="table table-list-search2  table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ลำดับ</th>
                                                                            <th>เลขที่รายการ</th>
                                                                            <th>จำนวน(ชุด)</th>
                                                                             <th>ร้านอาหาร</th>
                                                                            <th>สถานะ</th>
                                                                            <th>รายละเอียด</th>
                                                                            <th>หลักฐานการโอนเงิน</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table table-condensed table-hover" id="showNormalOrder">
                                                                        

                                                                    </tbody>
                                                                </table>   
                                                            </div>
                                                        </div>
                                                        <!-- จบตารางรายการติดตาม -->

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


                <!-- อัพโหลดหลักฐานการโอนเงิน -->
                <!-- tracking -->
                <div class="modal fade" id="transf" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <span class="modal-title" id="myModalLabel">
                                    <span style="font-size: 30px; margin-top: 5px;">หลักฐานการโอนเงิน </span>     
                                </span>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="margin-top: 0px;">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-content"> 
                                                <div class="thumbnails">
                                                    <div class="span4">

                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-sm-3 control-label" for="textinput">แจ้งการโอนเงิน</label>
                                                            <div class="col-sm-9" style="margin-bottom: 15px;">
                                                                <textarea id="detailslip" rows="6"  name="detailslip" style="margin: 0px; width: 318px; height: 84px;"  placeholder="แจ้งหลักฐานการโอนเงิน ตัวอย่าง 25/05/2558 \nเวลาโอน\nธนาคาร\nและแจ้ง Order ID : xxxxx " ></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" >
                                                            <span class="input-group" style="margin-left: 150px;">
                                                                <button class="btn btn-success" id="savebtn" type="button" style="    margin-left: 260px;">บันทึก</button>
                                                            </span>
                                                        </div><hr>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="card">
                                            <div class="card-content"> 
                                                <div class="thumbnails">
                                                    <div class="span4">
                                                        <div class="thumbnail">
                                                            <img src="/assets/images/default-img360.png" alt="ALT NAME">
                                                            <div class="caption">
                                                                <form action="/id=<?= $cusid ?>" method="post" enctype="multipart/form-data">
                                                                    <span id="uploadtext" ></span>
                                                                    <input value="<?= $cusid ?>" id="cusidvalue" type="hidden">
                                                                    <p align="center" ><button type="button" name="img" id="chooseimgbtn"  onClick="imagerest.click()" onMouseOut="uploadtext.value = imagerest.value" class="btn btn-primary btn-block" style="font-style:normal">เลือกรูป</button></p>
                                                                    <input type="file" id="imagerest" name="imagerest" style="display:none" accept="image/jpeg,image/pjpeg,image/png"  />
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- จบอัพโหลดหลักฐานการโอนเงิน -->
                <!-- tracking -->
                <div class="modal fade" id="track" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <span class="modal-title" id="myModalLabel">
                                    <span style="font-size: 30px; margin-top: 5px;">รายการหมายเลข: </span>
                                    <span style="font-size: 30px; margin-top: 5px; color: orange">102458 </span>     
                                </span>
                            </div>
                            <div class="modal-body">
                                <div class="row" style="margin-top: 0px;">
                                    <div class="col-md-12">
                                        <div class="col-md-7">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span style="font-size: 20px">สถานะของรายการ: </span>
                                                    <span style="font-size: 20px; color: orange;"> เสร็จสิ้น </span><br>
                                                    <span style="font-size: 20px">ตอบรับรายการโดย: </span>
                                                    <span style="font-size: 20px; color: orange;"> นายใหญ่โภชนา </span><br>
                                                    <span style="font-size: 20px">ตอบรับวันที่: </span>
                                                    <span style="font-size: 20px; color: orange;"> 12-11-2015 </span><br>
                                                    <span style="font-size: 20px">ตอบรับเวลา: </span>
                                                    <span style="font-size: 20px; color: orange;"> 12:30 </span><br>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <span style="font-size: 20px">สถานที่ส่งสินค้า </span>
                                                    <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                    <span style="font-size: 17px">บริษัท นาดาว บางกอก จำกัด 92/14 ซอยสุขุมวิท 31 (สวัสดี) แขวงคลองตันเหนือ เขตวัฒนา กทม. 10110</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span style="font-size: 20px">จัดส่งสินค้าโดย: </span><br>
                                                    <span style="font-size: 20px; color: orange;"><!-- 108suchart สุชาติ ปานขำ --></span><br>
                                                    <span style="font-size: 20px">โทรศัพท์: </span><br>
                                                    <span style="font-size: 20px; color: orange;"><!--0812345678 --></span><br>
                                                    <span style="font-size: 20px">นัดส่งสินค้าวันที่: </span><br>
                                                    <span style="font-size: 20px; color: orange;"> 12-11-2015</span><br>
                                                    <span style="font-size: 20px">นัดส่งสินค้าเวลา: </span><br>
                                                    <span style="font-size: 20px; color: orange;"> 12:40 </span><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span style="font-size: 20px">รายการสินค้า </span>
                                                    <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table table-list-search">
                                                                <thead>
                                                                    <tr>
                                                                        <th>รายการ</th>
                                                                        <th>ราคาต่อหน่วย/บาท</th>
                                                                        <th>จำนวน</th>
                                                                        <th>ราคารวม/บาท</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="table table-condensed table-hover">
                                                                    <tr>                    
                                                                        <td>ข้าวกล้อง</td>
                                                                        <td style="text-align: center">10.00</td>
                                                                        <td style="text-align: center">50</td>
                                                                        <td style="text-align: center">500.00</td>

                                                                    </tr>
                                                                    <tr>                     
                                                                        <td>ผัดกระเพราหมู</td>
                                                                        <td style="text-align: center">15.00</td>
                                                                        <td style="text-align: center">50</td>
                                                                        <td style="text-align: center">750.00</td>
                                                                    </tr>
                                                                    <tr>                    
                                                                        <td>ไข่ดาว</td>
                                                                        <td style="text-align: center">5.00</td>
                                                                        <td style="text-align: center">50</td>
                                                                        <td style="text-align: center">250.00</td>
                                                                    </tr>
                                                                    <tr>                    
                                                                        <td>ค่าจัดส่ง</td>
                                                                        <td style="text-align: center">100.00</td>
                                                                        <td style="text-align: center">1</td>
                                                                        <td style="text-align: center">100.00</td>
                                                                    </tr>
                                                                    <tr class="success">                    
                                                                        <td>ราคารวม</td>
                                                                        <td style="text-align: center"></td>
                                                                        <td style="text-align: center"></td>
                                                                        <td style="text-align: center">1,600.00</td>
                                                                    </tr>
                                                                    <tr class="warning">                  
                                                                        <td>ส่วนลด10% 1D23A5</td>
                                                                        <td style="text-align: center"></td>
                                                                        <td style="text-align: center">1</td>
                                                                        <td style="text-align: center">-160.00</td>
                                                                    </tr>
                                                                    <tr class="danger">                  
                                                                        <td>ราคารวมหลังหักส่วนลด</td>
                                                                        <td style="text-align: center"></td>
                                                                        <td style="text-align: center"></td>
                                                                        <td style="text-align: center">1,440.00</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span style="font-size: 20px">เพิ่มเติม </span>
                                                    <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                    <span style="font-size: 15px; color: red;"> กระเพราไม่ใส่ถั่วฝักยาว </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span style="font-size: 20px">การชำระเงิน </span>
                                                    <hr style="margin-top: 5px;margin-bottom: 10px;">
                                                    <span style="font-size: 15px"> โอนเงินมัดจำผ่านธนาคาร: <br><span style="font-size: 15px; color: orange;"> กสิกรไทย เลขที่ 12-1231212-1 <br> 400.00 บาท</span> </span> &nbsp; 

                                                    <a href="#" class="btn btn-warning btn-xs "data-toggle="modal" data-target='.pop-up-2' href=".pop-up-2" style="margin-left: 90px;">แสดงสลิป</a><br>

                                                    <span style="font-size: 15px"> ชำระเงินด้วยเงินสด: <br><span style="font-size: 15px; color: red;"> 1040.00 บาท</span> </span> &nbsp; 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>
        <!-- ตารางรายการออเดอร์ -->
        <script src="/assets/js/OrderSearch.js"></script>
        <script src="/assets/js/customer-profile-change.js"></script>
        <script src="/assets/js/customer-profile.js"></script>

    </body>
</html>
