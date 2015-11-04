<?php
session_start();
include '../dbconn.php';
?>




<html>
    <head>
        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->

        <title>Customer OTP Form</title>
        <?php include '../template/customer-title.php'; ?>


        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/register.css">



    </head>
    <body>
        <!-- start preloader -->
        <div class="preloader">
            <div class="loader"></div>
        </div>
        <!-- end preloader -->
        <!-- start navigation -->
        <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
            <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                    </button>

                    <a href="/index.php" class="navbar-brand">Pixup</a>
                    <a href="/index.php" class="navbar-brand" style="color:rgba(0,0,32,1);padding-left: 0px;">Food</a>
                    <div class="col-md-4" style="margin:7px 0 0 15%;">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control input-lg" placeholder="Search.." />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="button">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <ul class="nav navbar-nav navbar-right text-uppercase">
                        <li><a href="/api/logout.php" class="nav-link"><?= (!isset($_SESSION["islogin"])) ? 'No Session' : "สวัสดีคุณ " . $_SESSION["userdata"]["firstName"] . " " . $_SESSION["userdata"]["lastName"] ?></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="/assets/images/bar/user.png" style="width:40px;height:40px;"/>
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navigation -->
        <!-- start register -->
        <section id="cus_register">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <h1 class="text-uppercase">Vertify Account</h1>
                            <p style="font-size: 16px">
                                กรูณากรอกรหัส 4 หลักที่ท่านได้รับผ่านทาง sms เพื่อยืนยันตัวตน 
                            </p>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 80px">
                        <div class="col-md-2"></div>
                        <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                            <h3 class="text-uppercase">Your OTP Password :</h3>
                            <p> รหัส OTP 4 หลัก</p>
                        </div>
                        <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                            <div>
                                <form action="/register/customer-save.php" method="post" id="otpform">
                                    <div class="col-md-12 form-group">
                                        <input type="hidden" id="cusid" name="cusid" value="<?= $_SESSION["userdata"]["id"] ?>">
                                        <input required type="text" class="form-control" placeholder="OTP password" id="otpinput" name="otpinput">
                                        <p style="color: red" id="errortext"></p>
                                    </div>
                                    <div class="col-md-4 pull-right">
                                        <input type="submit" class="form-control text-uppercase" value="Send">
                                    </div>
                                    <div class="col-md-4 pull-right">
                                        <a href="/api/logout.php"><input type="button" class="form-control text-uppercase btn-danger" id="cancelbtn" value="Cancel"></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="errorNotFoundModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อผิดพลาด</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert"> <span id="errorNotFound"></span></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                       
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="errorModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ข้อผิดพลาด</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert"> <span id="errorCantAcct"></span></div>
                    </div>
                    <div class="modal-footer">
                        <a href="/api/logout.php"><button type="button" class="btn btn-default">ปิด</button></a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- start footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <p>Copyright © 2015 PixupFood</p>
                    <p>School of Information Technology</p>
                    <p>King Mongkut’s University of Technology Thonburi</p>
                </div>
            </div>
        </footer>
        <!-- end footer -->

        <!-- script references -->
        <script src="/assets/js/jquery-2.1.4.min.js"></script>
        <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/js/wow.min.js"></script>
        <script src="/assets/js/custom.js"></script>

        <script>
            $(document).ready(function () {
                //Handles menu drop down
                $('.dropdown-menu').find('form').click(function (e) {
                    e.stopPropagation();
                });
                $("#otpform").on("submit", function (e) {
                    $.ajax({
                        type: "POST",
                        url: "/customer/checkotppassword.php",
                        data: $("#otpform").serializeArray(),
                        dataType: "json",
                        success: function (data) {
                            if (data.result == "1") {
                                document.location = "/view/cus_customer_profile.php?id=" + data.id;
                               
                            } else  if (data.result == "2"){
                                $("#errorCantAcct").html(data.error);
                                $("#errorModal").modal("show");
                                
                            }else{
                                 $("#errorNotFound").html(data.error);
                                $("#errorNotFoundModal").modal("show");
                            }
                        }
                    });
                    e.preventDefault();
                    return false;
                });
              

            });
        </script>

    </body>
</html>