<?php
include './navbar.php';
include '../dbconn.php';
?>


<html>
    <head>
         <title>Pixupfood - Restaurant Messenger</title>
        <?php include '../template/customer-title.php';?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/messenger.css">
    </head>
    <body>
       
        <!-- start navigation -->
        <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" style="color:rgba(255,127,0,1);padding-right: 0px;" class="navbar-brand">Pixup</a>
                    <a href="#" class="navbar-brand" style="color:black;padding-left: 0px;">Food</a>
                    <ul class="nav navbar-nav navbar-right text-uppercase pull-right">
                        <li><a <?= (!isset($_SESSION["islogin"])) ? 'href="#"' : 'href="/api/logout.php" class="nav-link"' ?> ><?= (!isset($_SESSION["islogin"])) ? ' สวัสดี ' : $_SESSION["userdata"]["firstName"] . " " . $_SESSION["userdata"]["lastName"] ?>
                                <img src="/assets/images/bar/user.png" style="width:30px;height:30px;"/> 
                            </a>
                        </li>                                                 
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navigation -->

        <!-- start contact -->
        <section id="loreg">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 wow fadeInRight" data-wow-delay="0.6s">
                            <h2 class="text-uppercase">เข้าสู่ระบบ</h2>
                            <div class="contact-form">
                                <form action="/api/messenger-login.php" method="post">
                                    <div class="col-md-4" style="margin-top:13px;font-weight:bold;font-size:18px;">
                                        USERNAME &nbsp; &nbsp;:
                                    </div>
                                    <div class="col-md-8">
                                        <input required type="text" class="form-control" name="loginemail" placeholder="ชื่อผู้ใช้ ตัวอย่าง 999Somchai">
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

        <?php include '../template/footer.php';?>
    </body>
</html>
