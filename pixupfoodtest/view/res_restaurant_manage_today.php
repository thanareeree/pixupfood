<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant Today Management</title>

        <?php
        include '../template/customer-title.php';
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/res_restaurant_manage.css">

    </head>
    <body>
        <?php
        $resid = $_SESSION["restdata"]["id"];
        $result = $con->query("select * from restaurant where id = '$resid' ");
        $resdata = $result->fetch_assoc();
        ?>
        <?php include '../template/restaurant-navbar.php'; ?>


        <!-- start profile -->
        <section id="RestaurantHeader">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= $resdata["name"] ?></h1>
                </div>
            </div>
        </section>
        <!-- Menu Bar-->
        <!--Menu Item-->
    <scetion id="menu">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_order.php">
                    <button type="button" id="orders" class="btn btn-default" >
                        <span class="glyphicon glyphicon-align-left" aria-hidden="true" ></span>
                        <div class="hidden-xs">รายการสั่งซื้อ</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_today.php">
                    <button type="button" id="today" class="btn btn-default">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">วันนี้</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_menulist.php">
                    <button type="button" id="menulist" class="btn btn-default" >
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <div class="hidden-xs">รายการอาหาร</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_calendar.php">
                    <button type="button" id="calendar" class="btn btn-default" >
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        <div class="hidden-xs">ปฏิทิน</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_edit.php">
                    <button type="button" id="editres" class="btn btn-warning">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">การตั้งค่า</div>
                    </button>
                </a>
            </div>
        </div>
    </scetion>
    <!--End Menu Item-->

    <div class="well white">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1">
                <!-- Content in วันนี้-->
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Start Header Sub Tab-->
                            <div class="tabbable-panel">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        <li class="active">
                                            <a href="#tab_default_1" data-toggle="tab">
                                                ข่าวประกาศ </a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_2" data-toggle="tab">
                                                คอมเม้นต์จากลูกค้า </a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_3" data-toggle="tab">
                                                Tab 3 </a>
                                        </li>
                                    </ul>
                                    <!-- End Header Sub Tab-->

                                    <!-- Content in ข่าวประกาศ-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_default_1">
                                            <!-- Content in ข่าวประกาศ-->
                                            <!-- Message box -->
                                            <div class="row">
                                                <div class="col-md-8 ">                         
                                                    <textarea class="form-control input-sm " type="textarea" id="message" placeholder="Message" maxlength="140" rows="19"></textarea>  
                                                    <span class="help-block">
                                                        <p id="characterLeft" class="help-block ">You have reached the limit</p>
                                                    </span> 
                                                    <!-- Post Button-->
                                                    <div id="inbox">

                                                        <div class="fab btn-group show-on-hover dropup">
                                                            <div data-toggle="tooltip" data-placement="left" title="ประกาศ" style="margin-left: 42px;">
                                                                <button type="button" class="btn btn-danger btn-io dropdown-toggle" data-toggle="dropdown">
                                                                    <span class="fa-stack fa-2x">
                                                                        <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
                                                                        <i class="fa fa-plus fa-stack-1x fa-inverse fab-primary"></i>
                                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse fab-secondary"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--End Post Button-->
                                                </div>
                                                <!-- End MESSAGE BOX-->
                                                <!-- News Image Upload-->
                                                <div class="col-md-4"> 
                                                    <div class="thumbnails">
                                                        <div class="span4"><form>
                                                                <div class="thumbnail">

                                                                    <!-- <input type="file" name="img"> --->
                                                                    <h3 style="margin:30px 0 0 0;">ใส่ภาพที่นี่</h3>

                                                                    <img src="http://placehold.it/320x200" alt="ALT NAME">
                                                                    <div class="caption">
                                                                        <p align="center"><button type="button" name="img" value="อัพโหลด" onClick="upload.click()" onMouseOut="uploadtext.value = upload.value" class="btn btn-primary btn-block" style="font-style:normal">อัพโหลด</button></p>
                                                                        <!-- Upload Function-->   
                                                                        <form action="uploadfile.php" 
                                                                              method="post" 
                                                                              enctype="multipart/form-data" 
                                                                              target="ifrm"
                                                                              >
                                                                            <input type="file"
                                                                                   name="upload"
                                                                                   style="display:none"
                                                                                   />

                                                                            <input type="button"
                                                                                   name="uploadbutton" 
                                                                                   value="choose file"
                                                                                   onclick="upload.click()"
                                                                                   onmouseout="uploadtext.value = upload.value"
                                                                                   style="display:none"
                                                                                   />
                                                                        </form>
                                                                        <iframe name="ifrm" style="display:none">
                                                                        </iframe>
                                                                        <div class="progress">
                                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                                                                100% Complete 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End ส่วนอัพโหลดใหม่ -->


                                            <hr>


                                            <span style="text-align:center"><h2>ข่าวที่แล้ว</h2></span>
                                            <hr>


                                            <section id="pinBoot">

                                                <article class="white-panel"><img src="http://i.imgur.com/eTuCPxM.jpg" alt="">
                                                    <h4><a href="#">13 มี.ค. 2015 10.25น.</a></h4>
                                                    <p>Lorem ipsum </p>
                                                </article>

                                                <article class="white-panel"> <img src="http://i.imgur.com/evzIQVF.jpg" alt="">
                                                    <h4><a href="#">13 มี.ค. 2015 10.25น.</a></h4>
                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                </article>

                                                <article class="white-panel"> <img src="http://i.imgur.com/BiFkD83.jpg" alt="">
                                                    <h4><a href="#">13 มี.ค. 2015 10.25น.</a></h4>
                                                    <p>Lorem ipsum </p>
                                                </article>
                                                <article class="white-panel"> <img src="http://i.imgur.com/ApuihUx.jpg" alt="">
                                                    <h4><a href="#">13 มี.ค. 2015 10.25น.</a></h4>
                                                    <p>Lorem ipsum dolor sit amet, </p>
                                                </article>

                                                <article class="white-panel"> <img src="http://i.imgur.com/LUiR7W8.jpg" alt="">
                                                    <h4><a href="#">13 มี.ค. 2015 10.25น.</a></h4>
                                                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                </article>

                                                <article class="white-panel"> <img src="http://i.imgur.com/5NljFvC.jpg" alt="">
                                                    <h4><a href="#">13 มี.ค. 2015 10.25น.</a></h4>
                                                    <p>Duis aute
                                                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                </article>
                                                <article class="white-panel"><img src="http://i.imgur.com/lp6qUPo.jpg" alt="">
                                                    <h4><a href="#">13 มี.ค. 2015 10.25น.</a></h4>
                                                    <p>voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                </article>

                                                <article class="white-panel"> <img src="http://i.imgur.com/EygIdZU.jpg" alt="">
                                                    <h4><a href="#">13 มี.ค. 2015 10.25น.</a></h4>
                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                </article>

                                            </section>


                                        </div>
                                        <!-- End Content in ข่าวประกาศ-->

                                        <!-- Start Content in คอมเม้นต์จากลูกค้า-->

                                        <div class="tab-pane" id="tab_default_2">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="page-header">คอมเม้นต์จากลูกค้า</h3>


                                                    <section class="comment-list">
                                                        <!-- First Comment -->
                                                        <article class="row">
                                                            <div class="col-md-2 col-sm-2 hidden-xs">
                                                                <figure class="thumbnail">
                                                                    <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                                                                    <figcaption class="text-center">username</figcaption>
                                                                </figure>
                                                            </div>
                                                            <div class="col-md-10 col-sm-10">
                                                                <div class="panel panel-default arrow left">

                                                                    <div class="panel-heading"> 

                                                                        ใหม่

                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <header class="text-left">
                                                                            <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                                        </header>
                                                                        <div class="comment-post">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                            </p>
                                                                        </div>


                                                                        <p class="text-right"><a class="btn icon-btn btn-danger" href="#"><span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger"></span></i> รายงาน</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>

                                                        <!-- First Comment -->
                                                        <article class="row">
                                                            <div class="col-md-2 col-sm-2 hidden-xs">
                                                                <figure class="thumbnail">
                                                                    <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                                                                    <figcaption class="text-center">username</figcaption>
                                                                </figure>
                                                            </div>
                                                            <div class="col-md-10 col-sm-10">
                                                                <div class="panel panel-default arrow left">
                                                                    <div class="panel-heading"> 

                                                                        ใหม่

                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <header class="text-left">
                                                                            <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                                        </header>
                                                                        <div class="comment-post">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-right"><a class="btn icon-btn btn-danger" href="#"><span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger"></span></i> รายงาน</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>

                                                        <!-- First Comment -->
                                                        <article class="row">
                                                            <div class="col-md-2 col-sm-2 hidden-xs">
                                                                <figure class="thumbnail">
                                                                    <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                                                                    <figcaption class="text-center">username</figcaption>
                                                                </figure>
                                                            </div>
                                                            <div class="col-md-10 col-sm-10">
                                                                <div class="panel panel-default arrow left">
                                                                    <div class="panel-heading"> 

                                                                        ใหม่

                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <header class="text-left">
                                                                            <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                                        </header>
                                                                        <div class="comment-post">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-right"><a class="btn icon-btn btn-danger" href="#"><span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger"></span></i> รายงาน</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>

                                                        <!-- First Comment -->
                                                        <article class="row">
                                                            <div class="col-md-2 col-sm-2 hidden-xs">
                                                                <figure class="thumbnail">
                                                                    <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                                                                    <figcaption class="text-center">username</figcaption>
                                                                </figure>
                                                            </div>
                                                            <div class="col-md-10 col-sm-10">
                                                                <div class="panel panel-default arrow left">

                                                                    <div class="panel-body">
                                                                        <header class="text-left">
                                                                            <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                                        </header>
                                                                        <div class="comment-post">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-right"><a class="btn icon-btn btn-danger" href="#"><span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger"></span></i> รายงาน</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>

                                                        <!-- First Comment -->
                                                        <article class="row">
                                                            <div class="col-md-2 col-sm-2 hidden-xs">
                                                                <figure class="thumbnail">
                                                                    <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                                                                    <figcaption class="text-center">username</figcaption>
                                                                </figure>
                                                            </div>
                                                            <div class="col-md-10 col-sm-10">
                                                                <div class="panel panel-default arrow left">

                                                                    <div class="panel-body">
                                                                        <header class="text-left">
                                                                            <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                                        </header>
                                                                        <div class="comment-post">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-right"><a class="btn icon-btn btn-danger" href="#"><span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger"></span></i> รายงาน</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>

                                                        <!-- First Comment -->
                                                        <article class="row">
                                                            <div class="col-md-2 col-sm-2 hidden-xs">
                                                                <figure class="thumbnail">
                                                                    <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                                                                    <figcaption class="text-center">username</figcaption>
                                                                </figure>
                                                            </div>
                                                            <div class="col-md-10 col-sm-10">
                                                                <div class="panel panel-default arrow left">

                                                                    <div class="panel-body">
                                                                        <header class="text-left">
                                                                            <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                                                                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                                        </header>
                                                                        <div class="comment-post">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-right"><a class="btn icon-btn btn-danger" href="#"><span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger"></span></i> รายงาน</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>
                                                    </section>
                                                </div>
                                            </div>


                                            <div class="text-center">
                                                <ul class="pagination pagination-large">
                                                    <li><a href="" rel="prev">«</a></li>
                                                    <li><a href="">1</a></li>
                                                    <li><a href="">2</a></li>
                                                    <li><a href="">3</a></li>
                                                    <li><a href="">4</a>
                                                    </li><li class="active"><span>5</span></li>
                                                    <li class="disabled"><span>...</span></li>
                                                    <li><a href="">10</a></li>
                                                    <li><a href="">11</a></li>
                                                    <li><a href="" rel="next">»</a></li>	
                                                </ul>
                                            </div>
                                            <!-- End Content in คอมเม้นต์จากลูกค้า-->
                                        </div>
                                        <div class="tab-pane" id="tab_default_3">
                                            <p>
                                                Howdy, I'm in Tab 3.
                                            </p>
                                            <p>
                                                Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
                                            </p>
                                            <p>
                                                <a class="btn btn-info" href="http://j.mp/metronictheme" target="_blank">
                                                    Learn more...
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Content in today--> 

    <!-- start footer -->
    <?php
    show_footer();
    ?>
  
    <!--for old News-->
    <script>
        $(document).ready(function () {

            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
                $(".tab").addClass("active"); // instead of this do the below 
                $(this).removeClass("btn-default").addClass("btn-warning");
            });
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
            };

        })(jQuery, window, document);
    </script>
    <script>
        $(document).ready(function () {
            $('#characterLeft').text('140 characters left');
            $('#message').keydown(function () {
                var max = 140;
                var len = $(this).val().length;
                if (len >= max) {
                    $('#characterLeft').text('You have reached the limit');
                    $('#characterLeft').addClass('red');
                    $('#btnSubmit').addClass('disabled');
                }
                else {
                    var ch = max - len;
                    $('#characterLeft').text(ch + ' characters left');
                    $('#btnSubmit').removeClass('disabled');
                    $('#characterLeft').removeClass('red');
                }
            });
        });


    </script>

    <!-- Compost Button-->
    <script>
        $('.fab').hover(function () {
            $(this).toggleClass('active');
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
                /**
                 *   I don't recommend using this plugin on large tables, I just wrote it to make the demo useable. It will work fine for smaller tables 
                 *   but will likely encounter performance issues on larger tables.
                 *
                 *		<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
                 *		$(input-element).filterTable()
                 *		
                 *	The important attributes are 'data-action="filter"' and 'data-filters="#table-selector"'
                 */
                        (function () {
                            'use strict';
                            var $ = jQuery;
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
                })
                        /* Calendar Table */

                                /**
                                 *   I don't recommend using this plugin on large tables, I just wrote it to make the demo useable. It will work fine for smaller tables 
                                 *   but will likely encounter performance issues on larger tables.
                                 *
                                 *		<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
                                 *		$(input-element).filterTable()
                                 *		
                                 *	The important attributes are 'data-action="filter"' and 'data-filters="#table-selector"'
                                 */
                                        (function () {
                                            'use strict';
                                            var $ = jQuery;
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
                                })


    </script>

</body>
</html>
