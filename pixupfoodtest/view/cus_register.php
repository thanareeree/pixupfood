<?php
session_start();
include '../dbconn.php';
?>




<html >
    <head>


        <title>PixupFood - The Original Food Delivery</title>
        <?php include '../template/customer-title.php'; ?>

        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/register.css">
        <link rel="stylesheet" href="/assets/css/regis_map.css">    

    </head>
    <body>
        <?php include '../template/customer-navbar.php'; ?>
        <!-- start register -->
        <section id="cus_register">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <h1 class="text-uppercase">customer register form</h1><hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
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
                            <h3 class="text-uppercase">Address :</h3>
                            <p>ที่อยู่ปัจจุบัน </p>
                        </div>
                        <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                            <div>
                                <form action="/register/customer-save.php" method="post" id="cusregisterform">
                                    <div class="sidetip errorEmail" style="display: none">
                                            <p style="color: red"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;อีเมลนี้เคยลงทะเบียนไว้ก่อนแล้ว</p>
                                        </div>
                                        <div class="sidetip errorEmailInvalid"  style="display: none">
                                            <p style="color: red"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;โปรดป้อนอีเมลที่ถูกต้อง</p>
                                        </div>
                                    <div class="col-md-12 form-group" style="margin: 0;">
                                        <input required type="email" class="form-control" placeholder="อีเมลล์" id="cusemail" name="cusemail">
                                    </div>
                                    <div class="col-md-12">
                                        <input required type="password" class="form-control" placeholder="รหัสผ่าน" id="cuspwd" name="cuspwd">
                                    </div>
                                    <div class="col-md-12">
                                          <div class="sidetip errorConfirmpwd"  style="display: none" >
                                                <p style="color: red"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;รหัสผ่านไม่ตรงกัน</p>
                                            </div>
                                        <input required type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" id="cuspwdconfirm" name="cuspwdconfirm">
                                    </div>
                                    <div class="col-md-6">
                                        <input required type="text" class="form-control" placeholder="ชื่อ" id="cusfname" name="cusfname">
                                    </div>
                                    <div class="col-md-6">
                                        <input required type="text" class="form-control" placeholder="สกุล" id="cuslname" name="cuslname">
                                    </div>
                                    <div class="col-md-12">
                                         <div class="sidetip errorPhoneInvalid" style="display: none" >
                                            <p style="color: red"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;โปรดป้อนหมายเลขโทรศัพท์ที่ถูกต้อง</p>
                                        </div>
                                        <input required type="tel" class="form-control" placeholder="หมายเลขโทรศัพท์" id="cusphone" name="cusphone">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <textarea required class="form-control" disabled="" placeholder="กรุณาลากวางมุดตรงที่อยู่ของคุณก่อนแก้ไขข้อมูลให้ถูกต้อง" rows="3" id="cusaddress" name="cusaddress" style="margin: 0;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="address">
                                                    <div id='showaddress' class='col-sm-6'>
                                                        ลากวางหมุดตรงที่อยู่ของคุณ
                                                    </div>
                                                    <div class='col-sm-6' style="text-align: right;">
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
                                    <br>
                                    <div class="col-md-6 pull-right">
                                        <input type="submit" class="form-control text-uppercase" id="nextbtn" value="สมัครสมาชิก">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end register -->

        <!-- Modal ลูกค้าต้องอ่านก่อนถึงจะสมัครได้-->
        <div class="modal fade" id="termsmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">โปรดอ่านข้อกำหนดก่อนลงทะเบียน</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            1. สมาชิกต้องกรอกข้อมูลให้ครบถ้วน และตรงตามเป็นจริง เพื่อสิทธิประโยชน์ของท่านเอง หากตรวจสอบพบว่า ข้อมูลของท่านที่ให้มาเป็นเท็จ ทางระบบจะยกเลิกการเป็นสมาชิกของท่านทันที โดยไม่ต้องแจ้งให้ทราบล่วงหน้า<br><br>
                            2. สมาชิกจะต้องรักษารหัสผ่าน หรือชื่อเข้าใช้งานในระบบสมาชิก เป็นความลับ และหากมีผู้อื่นสามารถเข้าใช้จาก ทางชื่อของท่านได้ ทางบริษัทฯ จะไม่รับผิดชอบใดๆ ทั้งสิ้น<br><br>
                            3. Username ที่ไม่ได้ Login เข้ามาใช้งานเป็นเวลาอย่างน้อย 3 เดือน จะถูกลบบัญชีโดยไม่ต้องแจ้งให้สมาชิกทราบล่วงหน้า<br><br>
                            4. ผู้ดูแลเว็บไซต์ขอสงวนสิทธิ์ในการยกเลิกความเป็นสมาชิกหรือหยุดให้บริการระบบสมาชิกเมื่อใดก็ได้ โดยไม่ต้องแจ้งให้สมาชิกทราบล่วงหน้า<br><br>
                            5. บริการจัดส่งอาหารอาจไม่ครอบคลุมทุกพื้นที่<br><br>
                            6. ภาพผลิตภัณฑ์ ภาชนะ และการตกแต่งที่ปรากฏในเว็บไซต์ใช้เพื่อการโฆษณาเท่านั้น<br><br>
                            7. ราคารวมภาษีมูลค่าเพิ่มแล้ว<br><br>
                            8. ยอดขั้นต่ำการสั่งซื้อ และราคาค่าจัดส่งขึ้นอยู่กับร้านแต่ละร้าน<br><br>
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
        
         <div id="resgisterSuccessModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">บันทึกข้อมูลสมัครสมาชิกเรียบร้อยเเล้ว</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert">
                            <p>กรุณาล็อกอินเข้าสู่ระบบ และกรอกรหัส OTP เพื่อยืนยันตัวตนเข้าใช้งานเว็บภายในเวลา 30 นาที</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/index.php" ><button type="button" class="btn btn-success" >ตกลง</button></a>
                    </div>
                </div>

            </div>
        </div>

        <?php include '../template/footer.php'; ?>
        <script src="/assets/js/cus-regis-map.js"></script>
    </body>
</html>