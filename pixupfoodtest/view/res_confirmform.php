<?php
session_start();
include '../dbconn.php';
include './res_navbar.php';
?>


<html >
    <head>
        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <meta  charset="utf-8" />
        <title>Restaurant Register Form</title>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <!-- animate css -->
        <link rel="stylesheet" href="../assets/css/animate.min.css">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">



        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/register.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/search.css">
        <link rel="stylesheet" href="../assets/css/slide2.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />


    </head>
    <body>
        <?php show_navbar(); ?>
        <!-- start register -->
        <section id="res_register">
            <div class="overlay">
                <div class="container" style="padding-bottom: 10px;">
                    <div class="row">
                        <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <h1 class="text-uppercase">หลักฐานประกอบการสมัคร</h1><hr>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="container " >
                        <div class="row"  >
                            <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="col-md-12" >
                                        <h4>ผู้ประกอบการร้านอาหารจำเป็นต้องอัพโหลดหลักฐานประกอบการสมัครเข้าใช้เว็บไซต์ pixupfood.com</h4><br>
                                    </div>
                                    <div class="col-md-3" style="text-align: right">
                                        <h4>หลักฐานประกอบการสมัคร :</h4>
                                    </div>
                                    <div class="col-md-9">
                                        <h4>1. สำเนาบัตรประจำตัวประชาชน หรือสำเนาทะเบียนบ้าน ของผู้ประกอบการ</h4>
                                        <h4>2. สำเนาทะเบียนบ้านของที่ตั้งร้านอาหาร</h4>
                                        <h4>3. สำเนาใบอนุญาตหรือหนังสือรับรองการแจ้งจากสำนักงานเขต</h4>
                                        <h5><span style="color: red; text-align: center">****</span><strong>เลือกอัพโหลดเอกสารมาเพียงหนึ่งอย่าง เพื่อใช้เป็นหลักฐานประกอบการสมัคร</strong><span style="color: red">****</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <form action="../restaurant/upload-confirm-image.php?id=<?= $_GET["id"] ?>" method="post" enctype="multipart/form-data" id="formupload">
                                        <div class="col-md-3" style="text-align: right">
                                            <h4>อัพโหลดรูปภาพ:</h4>
                                        </div>
                                        <div class="col-md-9">
                                            <span id="output" style="color: red; text-align: right"></span>
                                            <input type="file"   required id="imgfile" name="imgfile">

                                        </div>
                                        <br>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <input type="button" class="form-control text-uppercase btn-info" id="cancelbtn" value="Cancel">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" class="form-control text-uppercase " id="sendbtn" value="send">
                                        </div>
                                        <div class="col-md-3"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal cancelbtn -->
        <div class="modal fade" id="modalcancel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ท่านจะต้องอัพโหลดหลักฐานประกอบการสมัครอีกครั้ง !!</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert">
                            <p>ขั้นตอนการสมัครสมาชิกเพื่อเข้าเปิดร้านอาหารบนเว็บไซต์ pixupfood.com ของท่านยังไม่สมบูรณ์</p><br>
                            <p>ท่านจะต้องอัพโหลดหลักฐานประกอบการสมัครอีกครั้ง </p><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary okbutton">OK</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Modal send -->
        <div class="modal fade" id="modalsend">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Register Success</h4>
                    </div>
                    <div class="modal-body">
                        <p>ขั้นตอนการสมัครสมาชิกเพื่อเข้าเปิดร้านอาหารบนเว็บไซต์ pixupfood.com ของท่านสำเร็จเรียบร้อย</p><br>
                        <p>ระบบจะเข้ามาตรวจสอบข้อมูลของท่านทุกชั่วโมง ขอบคุณครับ</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary okbtn">OK</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?php show_footer(); ?>
        <script>
            $(document).ready(function () {
                $("#cancelbtn").on("click", function (e) {
                    $("#modalcancel").modal("show");
                    //alert($.urlParam("success"));
                });
                $(".okbutton").on("click", function (e) {
                    $(".okbutton").attr("disabled", "disabled");
                    $("#modalcancel").modal("hide");
                    document.location = "../api/logout.php";
                });
                
                $.urlParam = function (name) {
                    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                    if (results == null) {
                        return null;
                    }
                    else {
                        return results[1] || 0;
                    }
                };
                function checksuccess(){
                     if($.urlParam("success")== 0){
                        $("#modalcancel").fadeIn(1000);
                        $("#modalcancel").modal("show");
                    }
                } checksuccess();
                
                $("#imgfile").on("change", function (e) {
                    var imgsize = $("#imgfile")[0].files[0].size;
                    var imgtype = $("#imgfile")[0].files[0].type;
                    switch (imgtype) {
                        case 'image/png':
                        case 'image/pjpeg':
                        case 'image/jpeg':
                            break;
                        default :
                            $("#output").html("<b>" + imgtype + "</b>  Unsupport file type!! <br>");
                            $("#sendbtn").attr("disabled", "disabled");
                    }
                    if (imgsize > 1048576) {
                        $("#output").html("Size: <b>" + imgsize + "</b> too big file!!");
                        $("#sendbtn").attr("disabled", "disabled");
                    } else {
                        $("#output").html(" ");
                        $("#sendbtn").removeAttr("disabled");
                    }
                });
            });
        </script>
    </body>
</html>
