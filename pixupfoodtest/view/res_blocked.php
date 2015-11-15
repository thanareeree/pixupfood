<?php
session_start();
include '../dbconn.php';
?>


<html>
    <head>
        <title>Restaurant</title>
         <?php include '../template/customer-title.php'; ?>

        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/register.css">
       
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
                            <div class="col-md-12 wow fadeInUp" style="margin-top: 50px;margin-left: 100px; margin-bottom: 60px"  data-wow-delay="0.6s">
                                <div class="col-md-4"></div>
                                <div class="col-md-9 content2 center-block">
                                    <div class="col-md-12" >
                                        <h3 style="text-align: center">ร้านอาหารของท่านถูกระงับการใช้งานเว็บชั่วคราว</h3><br>
                                        <h3 style="text-align: center">กรุณาติดต่อ Admin เพื่อขออนุญาตเข้าใช้งานอีกครั้ง</h3><br>
                                         <h3 style="text-align: center">เบอร์ติดต่อ: 0877056769</h3>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <?php include '../template/footer.php'; ?>
      
    </body>
</html>
