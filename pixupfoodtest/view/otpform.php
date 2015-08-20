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

        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <meta charset="UTF-8">
        <title>PixupFood - Login and Register Page</title>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">


        <link rel="stylesheet" href="../assets/css/animate.min.css">
        <link rel="stylesheet" href="../assets/Supermarket/stylesheet.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/search.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />

    </head>
    <body >
        <!-- start preloader -->
        <div class="preloader">
            <div class="loader"></div>
        </div>
        <!-- end preloader -->


        <?php
        include './navbar.php';
        show_navbar();
        ?>

        <!-- start contact -->
        <section id="loreg">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.6s">
                            <h2 class="text-uppercase">สมัครสมาชิก</h2><br><br>
                            <div class="col-md-4" style="margin-top:13px;">
                                <a href="#" data-toggle="modal" data-target="#ModalCus">
                                    <img src="../assets/images/bar/userl.png" style="width:104px; height:104px;"><br><br>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#ModalCus">
                                    <p style="margin-left:15px;font-weight:bold"> CUSTOMERS </p>
                                </a>
                            </div>
                            <div class="col-md-1" style="margin-top:13px;"></div>
                            <div class="col-md-4" style="margin-top:13px;">
                                <a href="#" data-toggle="modal" data-target="#ModalRes">
                                    <img src=../assets/images/bar/restaurant.png style="width:104px; height:104px;"><br><br>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#ModalRes">
                                    <p style="margin-left:15px;font-weight:bold"> RESTAURANTS </p>
                                </a>
                            </div>
                        </div>


                        <div class="col-md-6 wow fadeInRight" data-wow-delay="0.6s">
                            <h2 class="text-uppercase">เข้าสู่ระบบ</h2>
                            <div class="contact-form">
                                <form action="../api/loginsession.php" method="post">
                                    <div class="col-md-4" style="margin-top:13px;font-weight:bold;font-size:18px;">
                                        USERNAME &nbsp; &nbsp;:
                                    </div>
                                    <div class="col-md-8">
                                        <input required type="text" class="form-control" name="loginemail" placeholder="อีเมล">
                                    </div>
                                    <div class="col-md-4" style="margin-top:13px;font-weight:bold;font-size:18px;">
                                        PASSWORD &nbsp; &nbsp;:
                                    </div>
                                    <div class="col-md-8">
                                        <input required type="password" class="form-control" name="password" placeholder="รหัสผ่าน" >
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <input type="submit" class="form-control text-uppercase" value="เข้าสู่ระบบ">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end contact -->


        <div class="modal fade" data-backdrop="static" 
             data-keyboard="false"  id="otpmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Are you sure to delete ???????!!!!</h4>
                    </div>
                    <div class="modal-body">
                        <p>You are going to delete<br><br>
                            <b>ID : </b><span id="showid"></span><br>
                            <b>Text : </b><span id="showtext"></span><br>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cancelbtn" class="btn btn-success" data-dismiss="modal">Cancel</button>
                        <button type="button" id="deleteyes" class="btn btn-danger">Go Away !</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->






        <?php show_footer(); ?>
        <!-- script references -->
        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.js"></script>
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/jquery.singlePageNav.min.js"></script>
        <script src="../assets/js/custom.js"></script>
        <script>
          
            
         
           

        </script>
    </body>
</html>
