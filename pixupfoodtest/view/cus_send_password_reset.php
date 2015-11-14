<?php
session_start();
include '../dbconn.php';
$email = @$_GET["account_identifier"];
?>

<html>
    <head>
        <title>Reset Password</title>
        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/cus_reset.css">

    </head>
    <body>
        <?php
        $email = @$_GET["account_identifier"];
        $cusRes = $con->query("select tel, img_path, firstName from customer where email = '$email'");
        $cusData = $cusRes->fetch_assoc();
        $cusTel = $cusData["tel"];
        $img = $cusData["img_path"];
        $fname = $cusData["firstName"];
        ?>
        <input type="hidden" value="<?= $cusTel ?>" id="cusTelData">

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
                            <h1 class="text-uppercase">ยืนยันข้อมูลส่วนตัวของคุณ</h1>
                            <p style="font-size: 16px">
                                กรูณากรอกหมายเลขโทรศัพท์ของคุณ ระบบจะส่งรหัสผ่านใหม่ผ่านทาง sms
                            </p>
                            <hr>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-2"></div>
                        <div class="col-md-8 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="thumbnail col-md-12" style=" max-width: 20%; margin-left: 110px;" ">
                                <img src="<?= $img ?>">
                                <div class = "caption">
                                    <p style="text-align: center; margin-bottom: -10px"><?= $fname ?></p>
                                </div>

                            </div>
                            <div class="col-md-12" style="margin-left: 80px; width: 500px">
                                <form action="#" method="post" id="sendResetPassword">
                                    <input value="<?= @$_GET["account_identifier"] ?>" type="hidden" name="account_identifier" >
                                    <div class="col-md-12 form-group">
                                        <input required type="tel" class="form-control" placeholder="กรูณากรอกหมายเลขโทรศัพท์ของคุณ" id="tel" name="tel">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="alert alert-danger" role="alert" id="showerrorAlert" style="display: none">
                                            <p style="color: red" id="errortext"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pull-right">
                                        <input type="submit" class="form-control text-uppercase" value="ยอมรับ">
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="col-md-2 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">

                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="msgModal"  >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ระบบรีเซ็ตรหัสผ่านของคุณเรียบร้อยแล้ว</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert">
                            ใช้รหัสผ่านใหม่ที่คุณได้รับ เข้าสู่ระบบเพื่อเข้าใช้งานเว็บ และควรเปลี่ยนรหัสผ่านใหม่อีกครั้ง
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/index.php"><button type="button" class="btn btn-success">ตกลง</button></a>
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
        <script type="text/javascript">
            $(document).ready(function () {
                //$("#msgModal").modal("show");
                $("#sendResetPassword").on('submit', function (e) {
                    $.ajax({
                        url: "/customer/reset-send-newpassword.php",
                        type: "POST",
                        data: $("#sendResetPassword").serializeArray(),
                        dataType: "json",
                        success: function (data) {
                            if (data.result == 1) {
                                //alert(data);
                                $("#msgModal").modal("show");
                            } else {
                                alert(data.error);
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