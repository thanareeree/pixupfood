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
        <style>
            #map {
                height: 250px;
                width: 50%;
            }
        </style>


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
                                        <div class="col-md-12">
                                            <input type="email" class="form-control" placeholder="Email" required id="resemail" name="resemail">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control" placeholder="Password" required id="respassword" name="respassword">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control" placeholder="Confirm Password" required id="resconfirmpwd" name="resconfirmpwd">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="FirstName" required id="resfname" name="resfname">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="LastName" required id="reslname" name="reslname">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control"   id="latinput" name="latinput"  >
                                        </div>
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control"   id="longinput" name="longinput">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="tel" class="form-control" placeholder="Phone" required id="resphone" name="resphone">
                                        </div><br>
                                        <div class="col-md-6 pull-right">
                                            <input type="button" class="form-control text-uppercase btn-info" id="nextbtn" value="Next" >
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
                                    <h3 class="text-uppercase">Province :</h3>
                                    <p>จังหวัด </p>
                                    <h3 class="text-uppercase">Zone :</h3>
                                    <p>เขต(เฉพาะกรุงเทพมหานคร) </p>
                                    <h3 class="text-uppercase">Plan :</h3>
                                    <p>แผนการใช้งาน</p>
                                </div>
                                <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                                    <div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="RestaurantName" required id="restaurantname" name="restaurantname">
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="form-control" placeholder="Detail" rows="3" required id="detail" name="detail"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea class="form-control" placeholder="Address" rows="3" required id="resaddress" name="resaddress"></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <select class="form-control " id="provincelist" name="provincelist">
                                                <?php
                                                $res = $con->query("SELECT `id`, `name` FROM `province`");
                                                while ($data = $res->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $data['name'] ?>"> <?= $data['name'] ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control " id="zonelist" name="zonelist">
                                                <?php
                                                $res = $con->query("SELECT `id`, `name` FROM `zone`");
                                                while ($data = $res->fetch_assoc()) {
                                                    ?>

                                                    <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control " id="planlist" name="planlist">
                                                <?php
                                                $res3 = $con->query("SELECT * FROM `serviceplan`");
                                                while ($data3 = $res3->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $data3['id'] ?>"> <?= $data3['name'] ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div><br>
                                        <div class="col-md-6">
                                            <input type="button" class="form-control text-uppercase btn-info" id="backbtn" value="Back">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" class="form-control text-uppercase" id="submitformbtn" value="Confirmed">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div id="map" style="display: none"></div>
        </section>
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
                            6. <br><br>
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
        <script>
            $(document).ready(function () {
                $('#termsmodal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $("#termsmodal").modal('show');
                
                $( "input[type=checkbox]" ).on( "click", function (e){
                    $("#nextregisbtn").removeAttr("disabled");
                });
                $("#nextregisbtn").click(function (e){
                    $("#termsmodal").modal('hide');
                });

                function startMap() {

                    map = new google.maps.Map(document.getElementById("map"));
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(getPosition);
                        //navigator.geolocation.watchPosition(updatePosition);
                    } else {
                        alert("ffff");
                        // document.getElementById("latinput").value = "---";
                        // document.getElementById("longinput").value = "---";
                    }
                }

                startMap();


                function getPosition(pos) {
                    globalPosition = pos;
                    document.getElementById("latinput").value = pos.coords.latitude;
                    document.getElementById("longinput").value = pos.coords.longitude;
                    console.log(pos);

                }


                $("#nextbtn").on("click", function (e) {
                    if ($("#resemail").val() == "" || $("#respassword").val() == "" ||
                            $("#resconfirmpwd").val() == "" || $("#resphone").val() == "" ||
                            $("#resfname").val() == "" || $("#reslname").val() == "") {
                        //alert("กรอกข้อมูลไม่ครบ");
                        $("#nextbtn").add("disabled");

                    } else {

                        $(".firststep").hide();
                        $(".secondstep").fadeIn(500);
                    }

                });
                $("#backbtn").on("click", function (e) {
                    $(".firststep").fadeIn(500);
                    $(".secondstep").hide();
                });

                $("#restaurantformregis").on("submit", function (e) {

                    $.ajax({
                        type: "POST",
                        url: "/restaurant/restaurant-save.php",
                        data: {"resemail": $("#resemail").val(),
                            "respassword": $("#respassword").val(),
                            "resfname": $("#resfname").val(),
                            "reslname": $("#reslname").val(),
                            "latinput": $("#latinput").val(),
                            "longinput": $("#longinput").val(),
                            "resphone": $("#resphone").val(),
                            "restaurantname": $("#restaurantname").val(),
                            "detail": $("#detail").val(),
                            "resaddress": $("#resaddress").val(),
                            "provincelist": $("#provincelist").val(),
                            "zonelist": $("#zonelist").val(),
                            "planlist": $("#planlist").val()},
                        dataType: "json",
                        success: function (data) {
                            if (data.result == "1") {
                                document.location = "/view/res_confirmform.php?id=" + data.id;
                            } else {
                                alert("ไม่สามารถบันทึกข้อมูลได้\nError : " + data.error + "\n" +
                                        $("#resemail").val());

                            }
                        }
                    });
                    e.preventDefault();
                    return false;
                });


                //Handles menu drop down
                $('.dropdown-menu').find('form').click(function (e) {
                    e.stopPropagation();
                });
                $("#backstep").click(function () {
                    $("#firststep").fadeIn(500);
                    $("#secondstep").hide();
                });

                $("#nextstep").click(function () {
                    $("#firststep").hide();
                    $("#secondstep").fadeIn(500);
                });

            });
        </script>
    </body>
</html>