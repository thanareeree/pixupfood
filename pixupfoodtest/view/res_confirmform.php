<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        
        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="row thirdstep" style="display: none" >
                                 <div class="col-md-2 wow fadeInUp" data-wow-delay="0.6s">
                                    <h2 class="text-uppercase"></h2>
                                </div>
                                <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                                    <h4>รูปภาพหลักฐานประกอบการสมัคร:</h4>   
                                </div>
                                <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                                    <div>
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                            <h4>ผู้ประกอบการร้านอาหารจำเป็นต้องอัพโหลดหลักฐานประกอบการสมัครเข้าใช้เว็บไซต์ pixupfood.com</h4><br>
                                            </div>
                                            <div class="col-md-12">
                                                <h4>หลักฐานประกอบการสมัคร :</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>1. สำเนาบัตรประจำตัวประชาชน หรือสำเนาทะเบียนบ้าน ของผู้ประกอบการ</h5>
                                                <h5>2. สำเนาทะเบียนบ้านของที่ตั้งร้านอาหาร</h5>
                                                <h5>3. สำเนาใบอนุญาตหรือหนังสือรับรองการแจ้งจากสำนักงานเขต</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <h5><span style="color: red">****</span><strong>เลือกอัพโหลดเอกสารมาเพียงหนึ่งอย่าง เพื่อใช้เป็นหลักฐานประกอบการสมัคร</strong><span style="color: red">****</span></h5>
                                            </div> 
                                        </div>>
                                        <div class="col-md-12">
                                            <input type="file"   required id="imgfile" name="imgfile">
                                            <input type="hidden" id="restid" name="restid">
                                        </div>
                                        <br>
                                        <div class="col-md-6">
                                            <input type="button" class="form-control text-uppercase btn-info" id="backbtn" value="Cancel">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" class="form-control text-uppercase " value="send">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
    </body>
</html>
