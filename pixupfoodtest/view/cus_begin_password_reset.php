<?php
session_start();
include '../dbconn.php';
?>




<html>
    <head>
        <title>Reset Password</title>
        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
       <link rel="stylesheet" href="/assets/css/cus_reset.css">
    </head>
    <body>
        <!-- start navigation -->
        <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
            <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                    </button>

                    <a href="/index.php" class="navbar-brand">Pixup</a>
                    <a href="/index.php" class="navbar-brand" style="color:rgba(0,0,32,1);padding-left: 0px;">Food</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
                    <ul class="nav navbar-nav" id="nav-after-login" ></ul>
                    <ul class="nav navbar-nav navbar-right text-uppercase" id="logindiv">
                        <li class="dropdown">
                            <a href="/index.php"  >
                                <span class="glyphicon glyphicon-home" style="width:40px;height:40px;"></span>
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navigation -->
        <!-- start register -->
        <section id="cus_reset">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                            <h1 class="text-uppercase">ค้นหาบัญชีของคุณ</h1>
                            <p style="font-size: 16px">
                                กรูณากรอกอีเมลของคุณ
                            </p>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 60px;margin-bottom: 80px">

                        <div class="col-md-2"></div>
                        <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                            <h3 class="text-uppercase text-right" >อีเมลของคุณ:</h3>

                        </div>
                        <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">

                            <div class="col-md-12">
                                <form action="/register/customer-save.php" method="post" id="resetPassword">
                                    <div class="col-md-12 form-group">
                                        <input required type="email" class="form-control" placeholder="กรูณากรอกอีเมลของคุณ" id="email" name="email">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="alert alert-danger" role="alert" id="showerrorAlert" style="display: none">
                                            <p style="color: red" id="errortext"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pull-right">
                                        <input type="submit" class="form-control text-uppercase" value="ค้นหา">
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </section>

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
        <script type="text/javascript">
            $(document).ready(function () {
                
            $("#resetPassword").on('submit', function (e) {
                $.ajax({
                    url: "/customer/reset-search-email.php",
                    type: "POST",
                    data: $("#resetPassword").serializeArray(),
                    dataType: "json",
                    success: function (data) {
                        if (data.result == 1) {
                        document.location = "/view/cus_send_password_reset.php?account_identifier="+data.email;
                        
                        } else {
                            //$("#divError").show();
                            $("#showerrorAlert").show();
                            $("#errortext").html('<i style="color:  red;font-size: 16px" class="glyphicon glyphicon-exclamation-sign"></i>&nbsp;'+data.error);
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