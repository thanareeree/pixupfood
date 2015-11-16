<?php
session_start();
include '../dbconn.php';
?>

<html>
    <head>

        <title>Restaurant Register Form</title>
        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/register.css">
        <link rel="stylesheet" href="/assets/css/regis_map.css"> 

    </head>
    <body>
        <?php include './res_navbar.php'; ?>
        <!-- start register -->
        <section id="res_register">
            <div class="overlay">

                <div class="container" style="padding-bottom: 10px;">
                    <div class="row">
                        <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <h1 class="text-uppercase">restaurant register form</h1><hr>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="container " >
                        <form action="/restaurant/restaurant-save.php" method="post" id="restaurantformregis" >
                            <div class="row firststep">
                                <div class="col-md-2 wow fadeInUp" data-wow-delay="0.6s">
                                    <h2 class="text-uppercase">ข้อมูลผู้ประกอบการร้านอาหาร</h2>
                                </div>
                                <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                                    <h3 class="text-uppercase">E-mail :</h3>
                                    <p> อีเมลล์</p>
                                    <h3 class="text-uppercase">Password :</h3>
                                    <p>รหัสผ่าน</p>
                                    <h3 class="text-uppercase">Confirm Password :</h3>
                                    <p>ยืนยันรหัสผ่าน </p>
                                    <h3 class="text-uppercase">Name :</h3>
                                    <p>ชื่อ - สกุล </p>
                                    <h3 class="text-uppercase">Phone :</h3>
                                    <p>โทรศัพท์ </p>
                                </div>
                                <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                                    <div>
                                        <div class="sidetip errorEmail" style="display: none">
                                            <p style="color: red"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;อีเมลนี้เคยลงทะเบียนไว้ก่อนแล้ว</p>
                                        </div>
                                        <div class="sidetip errorEmailInvalid" style="display: none">
                                            <p style="color: red"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;โปรดป้อนอีเมลที่ถูกต้อง</p>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="email" class="form-control" placeholder="อีเมลล์" required id="resemail" name="resemail">
                                        </div>
                                        <div class="col-md-12">

                                            <input type="password" class="form-control" placeholder="รหัสผ่าน" required id="respassword" name="respassword">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="sidetip errorConfirmpwd"  style="display: none">
                                                <p style="color: red"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;รหัสผ่านไม่ตรงกัน</p>
                                            </div>
                                            <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" required id="resconfirmpwd" name="resconfirmpwd">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="ชื่อ" required id="resfname" name="resfname">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="สกุล" required id="reslname" name="reslname">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="sidetip errorPhoneInvalid" style="display: none">
                                            <p style="color: red"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;โปรดป้อนหมายเลขโทรศัพท์ที่ถูกต้อง</p>
                                        </div>
                                            <input type="tel" maxlength="12" class="form-control" placeholder="หมายเลขโทรศัพท์" required id="resphone" name="resphone">
                                        </div><br>
                                        <div class="col-md-6 pull-right">
                                            <input type="button" class="form-control text-uppercase btn-info" id="nextbtn" value="ต่อไป" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row secondstep" style="display: none" >
                                <div class="col-md-2 wow fadeInUp" data-wow-delay="0.6s">
                                    <h2 class="text-uppercase">ข้อมูลร้านอาหาร</h2>
                                </div>
                                <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                                    <h3 class="text-uppercase">Restaurant Name :</h3>
                                    <p>ชื่อร้านอาหาร </p>
                                    <h3 class="text-uppercase">Detail :</h3>
                                    <p>รายละเอียดร้าน </p><br>
                                    <h3 class="text-uppercase">Address :</h3>
                                    <p>ที่อยู่ร้านอาหาร </p><br>
                                    <h3 class="text-uppercase" style="margin-top: 485px;">Plan :</h3>
                                    <p>แผนการใช้งาน </p>
                                    <h3 class="text-uppercase"></h3>
                                    <p> </p>
                                    <h3 class="text-uppercase"></h3>
                                    <p></p>
                                </div>
                                <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                                    <div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="ชื่อร้านอาหาร" required id="restaurantname" name="restaurantname">
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="form-control" placeholder="รายละเอียดร้าน" rows="3" required id="detail" name="detail"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <textarea required disabled="" class="form-control" placeholder="กรุณาลากวางหมุดไปที่ตำแหน่งร้านของคุณก่อนจะแก้ไขที่อยู่ให้ถูกต้อง" rows="3" id="resaddress" name="resaddress" style="margin: 0;"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="address">
                                                        <div id='showaddress' class='col-sm-8' style="font-size: 14px">
                                                            ลากวางหมุดตรงที่ตั้งร้านของคุณ
                                                        </div>
                                                        <div class='col-sm-4' style="text-align: right;">
                                                            <button id="getlocationbtn" class="btn btn-warning">
                                                                <span class="glyphicon glyphicon-map-marker"></span>
                                                                ตำแหน่งปัจจุบัน
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12" style="padding: 0 0 20px 0;">
                                                <div id="map"></div>
                                            </div>
                                        </div>


                                        <div class="col-md-11">
                                            <select class="form-control " id="planlist" name="planlist">
                                                <?php
                                                $res3 = $con->query("SELECT * FROM `serviceplan`");
                                                while ($data3 = $res3->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $data3['id'] ?>"> <?= $data3['name'] ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <span data-toggle="modal" data-target="#squarespaceModal">
                                                <i class="fa fa-question-circle fa-lg"></i>
                                            </span>
                                        </div>
                                        <br>
                                        <div class="col-md-6">
                                            <input type="button" class="form-control text-uppercase btn-info" id="backbtn" value="ย้อนกลับ">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" class="form-control text-uppercase" id="submitformbtn" value="สมัครสมาชิก">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <!-- plan modal -->
        <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="lineModalLabel">เปรียบเทียบแผนการใช้งาน</h3>
                    </div>
                    <div class="modal-body">
                        <img src="/assets/images/plan.PNG">
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <!-- end register -->

        <!-- Modal จะเปิดร้านได้ต้อง อัพโดหหลดเอกสารและรอทางแอดเข้ามารับรองการเปิดร้านบนเว็บก่อน ถึงจะใช้งานได้ -->
        <div class="modal fade" id="termsmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">โปรดอ่านข้อกำหนดก่อนลงทะเบียน</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            1. บริษัทมีความมุ่งมั่นและตั้งใจเป็นอย่างยิ่งในการทำให้ข้อมูลในเว็บไซด์ถูกต้องและน่าเชื่อถือที่สุด แต่เนื่องด้วยอาจมีความคลาดเคลื่อนบางประการจึงอาจส่งผลทำให้ข้อมูลไม่ถูกต้องได้<br><br>
                            2. พนักงานส่งอาหารได้รับค่าแรงจากบริษัทโดยคำนวณจากชั่วโมงการทำงานและการให้บริการส่งอาหาร การให้ทิปไม่ได้เป็นข้อกำหนดของบริษัทแต่ขึ้นอยู่กับความพึงพอใจของลูกค้าหากท่านพอใจในบริการ<br><br>
                            3. ผู้ที่สมัครสมาชิกต้องกรอกข้อมูลที่เป็นจริงให้ครบทุกข้อ เพื่อสิทธิประโยชน์ของท่านในการเข้าร่วมกิจกรรมของเรา<br><br>
                            4. ข้อมูลของสมาชิกจะถูกเก็บเป็นความลับอย่างสูงสุด ผู้ดูแลเว็บบอร์ดจะไม่เปิดเผยข้อมูลของท่านเพื่อประโยชน์ทางการค้า หรือเพื่อประโยชน์ในด้านอื่น ๆ ทั้งสิ้น<br><br>
                            5. เพื่อความเป็นส่วนตัวและความปลอดภัยในข้อมูลของท่านเอง ผู้ดูแลเว็บบอร์ดขอแจ้งให้ท่านทราบว่า เป็นหน้าที่ของท่านเองในการรักษาชื่อ Login และ Password ของท่านให้ดี โดยไม่บอกให้ผู้อื่นทราบ<br><br>
                        </p>
                        <form>
                            <input type="checkbox" >&nbsp; ยอมรับ
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="/index.php"><button type="button" class="btn btn-default"  >ยกเลิก</button></a>
                        <button type="button" class="btn btn-primary" id="nextregisbtn" disabled="">ต่อไป</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?php include '../template/footer.php'; ?>
        <script src="/assets/js/res-register.js"></script>

    </body>
</html>