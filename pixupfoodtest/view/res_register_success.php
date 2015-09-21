<?php
session_start();
include '../dbconn.php';
?>


<html >
    <head>
        <title>Restaurant Register Form</title>
        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/register.css">

        <style>
            .content2 {
                margin-left: 20px;
                margin-top: 40px;
                margin-bottom: 60px;
                margin-right: 20px;
                padding: 30px 0;
                padding-left: 40px;
                padding-right: 40px;
                background-color: rgba(255,246,143,0.3);
                border-top-left-radius: 25px;
                border-top-right-radius: 25px;
                border-bottom-left-radius: 25px;
                border-bottom-right-radius: 25px;
                height: auto;
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
                            <h1 class="text-uppercase">Register Success !!</h1><hr>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="container " >
                        <div class="row"  >
                            <div class="col-md-12 wow fadeInUp" style="margin-top: 50px;margin-left: 200px; margin-bottom: 50px"  data-wow-delay="0.6s">
                                <div class="col-md-4"></div>
                                <div class="col-md-8 content2 center-block">
                                    <div class="col-md-12" >
                                        <h4>ขั้นตอนการสมัครสมาชิกเพื่อเข้าเปิดร้านอาหารบนเว็บไซต์ pixupfood.com ของท่านสำเร็จเรียบร้อย</h4><br>
                                        <h4>ระบบจะเข้ามาตรวจสอบข้อมูลของท่านทุกชั่วโมง ขอบคุณครับ</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

            </div>
        </section>

        <?php include '../template/footer.php'; ?>
        <script>
            $(document).ready(function () {
                $("#cancelbtn").on("click", function (e) {
                    $("#modalcancel").modal("show");
                    //alert($.urlParam("success"));
                });
                $(".okbutton").on("click", function (e) {
                    $(".okbutton").attr("disabled", "disabled");
                    $("#modalcancel").modal("hide");
                    document.location = "../index.php";
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
                function checksuccess() {
                    if ($.urlParam("success") == 1) {
                        $("#modalsend").fadeIn(1000);
                        $("#modalsend").modal("show");
                    } else if ($.urlParam("success") == 0) {
                        $("#modalcancel").fadeIn(1000);
                        $("#modalcancel").modal("show");
                    }
                }
                checksuccess();




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
