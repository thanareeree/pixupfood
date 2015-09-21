<?php
include '../api/islogin.php';
include '../dbconn.php';
include '../api/function.php';
?>




<html>
    <head>
       


        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->

        <title>Pixupfood - Restaurant View</title>

        <?php
        include '../template/customer-title.php';
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/restaurant_view.css">
        <link href="http://jondmiles.com/bootstrap-datepaginator/css/bootstrap-datepicker.css" rel="stylesheet" media="screen" type="text/css">
        <link href="http://jondmiles.com/bootstrap-datepaginator/css/bootstrap-datepaginator.min.css" rel="stylesheet" media="screen" type="text/css">

    </head>
    <body>

        <?php include '../template/customer-navbar.php'; ?>


        <!-- start profile -->
        <section id="restaurant_view">
            <div class="profilecontainer">
                <div class="headprofile">
                    <img align="left" class="fb-image-lg" src="../assets/images/city-restaurant-lunch-outside.png" alt="Profile image example"/>
                    <div class="container_status">
                        <span>Address: <?= $_SESSION["userdata"]["email"] ?></span><span> Tel: <?= $_SESSION["userdata"]["tel"] ?></span><br>
                        <span>เวลาเปิด - ปิด:</span><br>
                        <span>สถานะ:__________</span>
                    </div>
                    <img align="left" class="fb-image-profile thumbnail" src="http://lorempixel.com/180/180/people/9/" alt="Profile image example"/>
                    <div class="fb-profile-text">
                        <br><h1><?= $_SESSION["userdata"]["firstName"] ?>  <?= $_SESSION["userdata"]["lastName"] ?></h1>
                        <div class="row lead">
                            <div id="stars-existing" class="starrr" data-rating='4'></div>
                        </div>
                    </div>
                </div>
            </div> <!-- /container -->
            <!-- edit profile -->

            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">News</a></li>
                            <li role="presentation"><a href="#promo" aria-controls="promo" role="tab" data-toggle="tab">Promotions</a></li>
                            <li role="presentation"><a href="#order" aria-controls="order" role="tab" data-toggle="tab">สั่งอาหาร</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="news">
                                <br><div class="row">
                                    <section id="pinBoot">
                                        <article class="white-panel"><img src="http://i.imgur.com/sDLIAZD.png" alt="">
                                            <h4><a href="#">Title 1</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </article>

                                        <article class="white-panel"> <img src="http://i.imgur.com/8lhFhc1.gif" alt="">
                                            <h4><a href="#">Title 2</a></h4>
                                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </article>

                                        <article class="white-panel"> <img src="http://i.imgur.com/xOIMvAe.jpg" alt="">
                                            <h4><a href="#">Title 3</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                        </article>

                                        <article class="white-panel"> <img src="http://i.imgur.com/3gXW3L3.jpg" alt="">
                                            <h4><a href="#">Title 4</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </article>

                                        <article class="white-panel"> <img src="http://i.imgur.com/o2RVMqm.jpg" alt="">
                                            <h4><a href="#">Title 5</a></h4>
                                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </article>

                                        <article class="white-panel"> <img src="http://i.imgur.com/kFFpuKA.jpg" alt="">
                                            <h4><a href="#">Title 6</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                        </article>
                                        <article class="white-panel"><img src="http://i.imgur.com/E9RmLPA.jpg" alt="">
                                            <h4><a href="#">Title 7</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </article>

                                        <article class="white-panel"> <img src="http://i.imgur.com/8lhFhc1.gif" alt="">
                                            <h4><a href="#">Title 8</a></h4>
                                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </article>

                                    </section>
                                </div>
                            </div>
                            <!-- Promotion -->
                            <div role="tabpanel" class="tab-pane" id="promo">
                                <br><div class="row">
                                    <section id="pinBootpromo">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>                                                
                                        </div> <hr class="hrs">

                                        <!-- 3 -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- Order -->
                            <div role="tabpanel" class="tab-pane" id="order">
                                <div class="wizard">
                                    <div class="wizard-inner">
                                        <div class="connecting-line"></div>
                                        <ul class="nav nav-tabs" role="tablist">

                                            <li role="presentation" class="active">
                                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-folder-open"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li role="presentation" class="disabled">
                                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-pencil"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-picture"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-picture"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-picture"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <form role="form">
                                        <div class="tab-content">
                                            <div class="tab-pane active" role="tabpanel" id="step1">
                                                <div class="container_field">
                                                    <h3>ขั้นตอนที่ 1 : เลือกกล่อง</h3>
                                                    <input type="checkbox" name="sex" value="male">&nbsp;อาหารจานเดียว&nbsp;&nbsp;
                                                    <input type="checkbox" name="sex" value="female">&nbsp;ข้าว + กับข้าว 1 อย่าง&nbsp;&nbsp;
                                                    <input type="checkbox" name="sex" value="male">&nbsp;ข้าว + กับข้าว 2 อย่าง&nbsp;&nbsp;
                                                    <input type="checkbox" name="sex" value="female">&nbsp;ข้าว + กับข้าว 3 อย่าง
                                                </div>
                                                <ul class="list-inline pull-right">
                                                    <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="step2">
                                                <div class="container_field">
                                                    <h3>ขั้นตอนที่ 2 : เลือกข้าว</h3>
                                                    <input type="checkbox" name="sex" value="male">&nbsp;ข้าวหอมมะลิ&nbsp;&nbsp;
                                                    <input type="checkbox" name="sex" value="female">&nbsp;ข้าวเสาไห้&nbsp;&nbsp;
                                                    <input type="checkbox" name="sex" value="male">&nbsp;ข้าวกล้อง&nbsp;&nbsp;
                                                    <input type="checkbox" name="sex" value="female">&nbsp;ข้าวไรซ์เบอรี่
                                                </div>
                                                <ul class="list-inline pull-right">
                                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                    <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="step3">
                                                <div class="container_field">
                                                    <h3>ขั้นตอนที่ 3 : เลือกกับข้าว</h3>
                                                    <h3>ลำดับที่ 1</h3>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>                        
                                                    </div> <hr class="hrs">

                                                    <!-- 2 -->
                                                    <h3>ลำดับที่ 2</h3>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>                                                
                                                    </div> <hr class="hrs">

                                                    <!-- 3 -->
                                                    <h3>ลำดับที่ 3</h3>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                                <div class="caption">
                                                                    <h3>Thumbnail label</h3>
                                                                    <p>...</p>
                                                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                                </div>
                                                            </div>
                                                        </div>                                                
                                                    </div>
                                                </div>
                                                <ul class="list-inline pull-right">
                                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                    <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="step4">
                                                <div class="tab-pane" role="tabpanel" id="step4">
                                                    <div class="container_field">
                                                        <h3>ขั้นตอนที่ 4 : เลือกวัน เวลา และสถานที่จัดส่ง</h3>
                                                        <div>
                                                            <h3>ส่งวันที่ :     
                                                                <input type="date" name="senddate">
                                                            </h3>
                                                        </div>
                                                        <div>
                                                            <h3>เวลาประมาณ :     
                                                                <input type="time" name="sendtime">
                                                            </h3>
                                                        </div>
                                                        <h3>สถานที่</h3>
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2637.965367675441!2d100.49418899116831!3d13.651153172648238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x0f0100b33d0b31d0!2sKing+Mongkut%E2%80%99s+University+of+Technology+Thonburi!5e0!3m2!1sth!2s!4v1442071829798" width="730" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                        <br><br>
                                                        <h3>เลือกจากสถานที่ของคุณ</h3>
                                                        <div class="content2">
                                                            <table class="table table-hover" id="task-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Address</th>
                                                                        <th>Select</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>123 ม.4 ต.ยยยยยยยย</td>
                                                                        <td><input type="checkbox"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2</td>
                                                                        <td>3848 ม.บางมด</td>
                                                                        <td><input type="checkbox"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="row">
                                                                <div id="inbox" style="margin:15% 0 0 0;">
                                                                    <div class="fab btn-group show-on-hover dropup" id="add_sa" data-toggle="modal" data-target="#add_address">
                                                                        <button type="button" class="btn btn-danger glyphicon glyphicon-plus btn-io">
                                                                            <span class="fa-stack fa-2x">
                                                                                <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
                                                                                <i class="fa fa-plus fa-stack-1x fa-inverse fab-primary"></i>
                                                                                <i class="fa fa-plus fa-stack-1x fa-inverse fab-secondary"></i>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <ul class="list-inline pull-right">
                                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                                    </ul>
                                                </div>                                   
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="step5">
                                                <div class="container_field">
                                                    <div class="row">                                                        
                                                        <h3>ขั้นตอนที่ 5 : เลือกวิธีชำระเงิน</h3>
                                                        <div class="col-md-6">
                                                            <input type="checkbox" name="sex" value="male">&nbsp;เงินสด&nbsp;&nbsp;
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="checkbox" name="sex" value="female">&nbsp;โอนเงินผ่านบัญชีธนาคาร&nbsp;&nbsp;
                                                            <p>เลขที่บัญชี:_____________</p>
                                                            <p>ชื่อบัญชี:_______________</p>
                                                            <p>ธนาคาร:________สาขา_______</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-inline pull-right">
                                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                    <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Add Shipping address Modal -->
                        <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="shipping_address">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="shipping_address">Add Other Address</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="addressform" name="addressform" method="post">

                                            <div class="form-group">
                                                <input name="address" type="text" required class="form-control input-lg" id="address" placeholder="Address">
                                            </div>

                                            <div class="modal-footer form-group">
                                                <input type="submit" class="btn btn-primary" name="nextbutton" id="nextbutton" value="Update" >
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="datepaginator" id="paginator"></div><br><hr>
                        <div class="container_field">
                            <h3>Order & Price</h3>
                            <p>บอกรายละเอียดรายการ พร้อมราคาที่ลูกค้าเลือก</p>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">Order</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section> 


        <?php
        include '../template/footer.php';
        iconscript();
        ?>

        <script>
            (function () {
                'use strict';
                $.fn.extend({
                    filterTable: function () {
                        return this.each(function () {
                            $(this).on('keyup', function (e) {
                                $('.filterTable_no_results').remove();
                                var $this = $(this),
                                        search = $this.val().toLowerCase(),
                                        target = $this.attr('data-filters'),
                                        $target = $(target),
                                        $rows = $target.find('tbody tr');

                                if (search == '') {
                                    $rows.show();
                                } else {
                                    $rows.each(function () {
                                        var $this = $(this);
                                        $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                                    })
                                    if ($target.find('tbody tr:visible').size() === 0) {
                                        var col_count = $target.find('tr').first().find('td').size();
                                        var no_results = $('<tr class="filterTable_no_results"><td colspan="' + col_count + '">No results found</td></tr>')
                                        $target.find('tbody').append(no_results);
                                    }
                                }
                            });
                        });
                    }
                });
                $('[data-action="filter"]').filterTable();
            })(jQuery);

            $(function () {
                // attach table filter plugin to inputs
                $('[data-action="filter"]').filterTable();

                $('.container').on('click', '.panel-heading span.filter', function (e) {
                    var $this = $(this),
                            $panel = $this.parents('.panel');

                    $panel.find('.panel-body').slideToggle();
                    if ($this.css('display') != 'none') {
                        $panel.find('.panel-body input').focus();
                    }
                });
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script>
            var __slice = [].slice;

            (function ($, window) {
                var Starrr;

                Starrr = (function () {
                    Starrr.prototype.defaults = {
                        rating: void 0,
                        numStars: 5,
                        change: function (e, value) {
                        }
                    };

                    function Starrr($el, options) {
                        var i, _, _ref,
                                _this = this;

                        this.options = $.extend({}, this.defaults, options);
                        this.$el = $el;
                        _ref = this.defaults;
                        for (i in _ref) {
                            _ = _ref[i];
                            if (this.$el.data(i) != null) {
                                this.options[i] = this.$el.data(i);
                            }
                        }
                        this.createStars();
                        this.syncRating();
                        this.$el.on('mouseover.starrr', 'i', function (e) {
                            return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
                        });
                        this.$el.on('mouseout.starrr', function () {
                            return _this.syncRating();
                        });
                        this.$el.on('click.starrr', 'i', function (e) {
                            return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
                        });
                        this.$el.on('starrr:change', this.options.change);
                    }

                    Starrr.prototype.createStars = function () {
                        var _i, _ref, _results;

                        _results = [];
                        for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                            _results.push(this.$el.append("<i class='fa fa-star-o'></i>"));
                        }
                        return _results;
                    };

                    Starrr.prototype.setRating = function (rating) {
                        if (this.options.rating === rating) {
                            rating = void 0;
                        }
                        this.options.rating = rating;
                        this.syncRating();
                        return this.$el.trigger('starrr:change', rating);
                    };

                    Starrr.prototype.syncRating = function (rating) {
                        var i, _i, _j, _ref;

                        rating || (rating = this.options.rating);
                        if (rating) {
                            for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                                this.$el.find('i').eq(i).removeClass('fa-star-o').addClass('fa-star');
                            }
                        }
                        if (rating && rating < 5) {
                            for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                                this.$el.find('i').eq(i).removeClass('fa-star').addClass('fa-star-o');
                            }
                        }
                        if (!rating) {
                            return this.$el.find('i').removeClass('fa-star').addClass('fa-star-o');
                        }
                    };

                    return Starrr;

                })();
                return $.fn.extend({
                    starrr: function () {
                        var args, option;

                        option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                        return this.each(function () {
                            var data;

                            data = $(this).data('star-rating');
                            if (!data) {
                                $(this).data('star-rating', (data = new Starrr($(this), option)));
                            }
                            if (typeof option === 'string') {
                                return data[option].apply(data, args);
                            }
                        });
                    }
                });
            })(window.jQuery, window);

            $(function () {
                return $(".starrr").starrr();
            });

            $(document).ready(function () {

                $('#stars').on('starrr:change', function (e, value) {
                    $('#count').html(value);
                });

                $('#stars-existing').on('starrr:change', function (e, value) {
                    $('#count-existing').html(value);
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                //Initialize tooltips
                $('.nav-tabs > li a[title]').tooltip();

                //Wizard
                $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                    var $target = $(e.target);

                    if ($target.parent().hasClass('disabled')) {
                        return false;
                    }
                });

                $(".next-step").click(function (e) {

                    var $active = $('.wizard .nav-tabs li.active');
                    $active.next().removeClass('disabled');
                    nextTab($active);

                });
                $(".prev-step").click(function (e) {

                    var $active = $('.wizard .nav-tabs li.active');
                    prevTab($active);

                });
            });

            function nextTab(elem) {
                $(elem).next().find('a[data-toggle="tab"]').click();
            }
            function prevTab(elem) {
                $(elem).prev().find('a[data-toggle="tab"]').click();
            }
        </script>
        <script>
            $(document).ready(function () {

                // This will wait for the DOM (your HTML) to be loaded before executing aFunction

                /* uncomment to use optios
                 var options = {
                 selectedDate: '2013-01-01',
                 selectedDateFormat: 'YYYY-MM-DD'
                 }
                 
                 $('#paginator').datepaginator(options);
                 
                 */

                //  defatult settings, i.e. today's date etc.

                $('#paginator').datepaginator();


                /* uncomment to add event if date is changed
                 $('#paginator').on('selectedDateChanged', function(event, date) {
                 // Your logic goes here
                 alert('Date was changed.');
                 });
                 */

            });
        </script>
        <script type="text/javascript" src="http://jondmiles.com/bootstrap-datepaginator/js/moment.min.js"></script>
        <script type="text/javascript" src="http://jondmiles.com/bootstrap-datepaginator/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="http://jondmiles.com/bootstrap-datepaginator/js/bootstrap-datepaginator.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#pinBoot').pinterest_grid({
                    no_columns: 4,
                    padding_x: 10,
                    padding_y: 10,
                    margin_bottom: 50,
                    single_column_breakpoint: 700
                });
            });

            /*
             Ref:
             Thanks to:
             http://www.jqueryscript.net/layout/Simple-jQuery-Plugin-To-Create-Pinterest-Style-Grid-Layout-Pinterest-Grid.html
             */


            /*
             Pinterest Grid Plugin
             Copyright 2014 Mediademons
             @author smm 16/04/2014
             
             usage:
             
             $(document).ready(function() {
             
             $('#blog-landing').pinterest_grid({
             no_columns: 4
             });
             
             });
             
             
             */
            ;
            (function ($, window, document, undefined) {
                var pluginName = 'pinterest_grid',
                        defaults = {
                            padding_x: 10,
                            padding_y: 10,
                            no_columns: 3,
                            margin_bottom: 50,
                            single_column_breakpoint: 700
                        },
                columns,
                        $article,
                        article_width;

                function Plugin(element, options) {
                    this.element = element;
                    this.options = $.extend({}, defaults, options);
                    this._defaults = defaults;
                    this._name = pluginName;
                    this.init();
                }

                Plugin.prototype.init = function () {
                    var self = this,
                            resize_finish;

                    $(window).resize(function () {
                        clearTimeout(resize_finish);
                        resize_finish = setTimeout(function () {
                            self.make_layout_change(self);
                        }, 11);
                    });

                    self.make_layout_change(self);

                    setTimeout(function () {
                        $(window).resize();
                    }, 500);
                };

                Plugin.prototype.calculate = function (single_column_mode) {
                    var self = this,
                            tallest = 0,
                            row = 0,
                            $container = $(this.element),
                            container_width = $container.width();
                    $article = $(this.element).children();

                    if (single_column_mode === true) {
                        article_width = $container.width() - self.options.padding_x;
                    } else {
                        article_width = ($container.width() - self.options.padding_x * self.options.no_columns) / self.options.no_columns;
                    }

                    $article.each(function () {
                        $(this).css('width', article_width);
                    });

                    columns = self.options.no_columns;

                    $article.each(function (index) {
                        var current_column,
                                left_out = 0,
                                top = 0,
                                $this = $(this),
                                prevAll = $this.prevAll(),
                                tallest = 0;

                        if (single_column_mode === false) {
                            current_column = (index % columns);
                        } else {
                            current_column = 0;
                        }

                        for (var t = 0; t < columns; t++) {
                            $this.removeClass('c' + t);
                        }

                        if (index % columns === 0) {
                            row++;
                        }

                        $this.addClass('c' + current_column);
                        $this.addClass('r' + row);

                        prevAll.each(function (index) {
                            if ($(this).hasClass('c' + current_column)) {
                                top += $(this).outerHeight() + self.options.padding_y;
                            }
                        });

                        if (single_column_mode === true) {
                            left_out = 0;
                        } else {
                            left_out = (index % columns) * (article_width + self.options.padding_x);
                        }

                        $this.css({
                            'left': left_out,
                            'top': top
                        });
                    });

                    this.tallest($container);
                    $(window).resize();
                };

                Plugin.prototype.tallest = function (_container) {
                    var column_heights = [],
                            largest = 0;

                    for (var z = 0; z < columns; z++) {
                        var temp_height = 0;
                        _container.find('.c' + z).each(function () {
                            temp_height += $(this).outerHeight();
                        });
                        column_heights[z] = temp_height;
                    }

                    largest = Math.max.apply(Math, column_heights);
                    _container.css('height', largest + (this.options.padding_y + this.options.margin_bottom));
                };

                Plugin.prototype.make_layout_change = function (_self) {
                    if ($(window).width() < _self.options.single_column_breakpoint) {
                        _self.calculate(true);
                    } else {
                        _self.calculate(false);
                    }
                };

                $.fn[pluginName] = function (options) {
                    return this.each(function () {
                        if (!$.data(this, 'plugin_' + pluginName)) {
                            $.data(this, 'plugin_' + pluginName,
                                    new Plugin(this, options));
                        }
                    });
                }

            })(jQuery, window, document);
        </script>

    </body>
</html>
