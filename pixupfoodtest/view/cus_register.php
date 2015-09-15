<?php
session_start();
include '../dbconn.php';

?>




<html >
    <head>
        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        
        <title>PixupFood - The Original Food Delivery</title>
       <?php include '../template/customer-title.php'; ?>

        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/register.css">
        

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
                            <h3 class="text-uppercase">Address :</h3>
                            <p>ที่อยู่ปัจจุบัน </p><br>
                            <h3 class="text-uppercase">Phone :</h3>
                            <p>โทรศัพท์ </p>
                        </div>
                        <div class="col-md-5 wow fadeInUp" data-wow-delay="0.6s" style="margin-top: 10px;">
                            <div>
                                <form action="../register/customer-save.php" method="post">
                                    <div class="col-md-12 form-group">
                                        <input required type="email" class="form-control" placeholder="Email" id="cusemail" name="cusemail">
                                    </div>
                                    <div class="col-md-12">
                                        <input required type="password" class="form-control" placeholder="Password" id="cuspwd" name="cuspwd">
                                    </div>
                                    <div class="col-md-12">
                                        <input required type="password" class="form-control" placeholder="Confirm Password" id="cuspwdconfirm" name="cuspwdconfirm">
                                    </div>
                                    <div class="col-md-6">
                                        <input required type="text" class="form-control" placeholder="FirstName" id="cusfname" name="cusfname">
                                    </div>
                                    <div class="col-md-6">
                                        <input required type="text" class="form-control" placeholder="LastName" id="cuslname" name="cuslname">
                                    </div>
                                    <div class="col-md-12">
                                        <textarea required class="form-control" placeholder="Address" rows="3" id="cusaddress" name="cusaddress"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <input required type="tel" class="form-control" placeholder="Phone" id="cusphone" name="cusphone">
                                    </div><br>
                                    <div class="col-md-6 pull-right">
                                        <input type="submit" class="form-control text-uppercase" value="Registered">
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
        <?php include '../template/footer.php'; ?>
        <script>
            $(document).ready(function () {
                //Handles menu drop down
                $('.dropdown-menu').find('form').click(function (e) {
                    e.stopPropagation();
                });
            });
        </script>

    </body>
</html>