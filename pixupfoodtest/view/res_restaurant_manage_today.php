<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../dbconn.php';
?>

<html>
    <head>
        <title>Pixupfood - Restaurant Today Management</title>

        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/res_restaurant_manage.css">

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
                    <button type="button" id="today" class="btn btn-warning">
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
                        <div class="hidden-xs">ตารางการจัดส่งสินค้า</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_edit.php">
                    <button type="button" id="editres" class="btn btn-default">
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
                                            <a href="/view/res_restaurant_manage_today.php" >ข่าวประกาศ </a>
                                        </li>
                                        <li >
                                            <a href="/view/res-manage-review.php" >รีวิว/คอมเม้นต์จากลูกค้า </a>
                                        </li>
                                    </ul>
                                    <!-- End Header Sub Tab-->

                                    <!-- Content in ข่าวประกาศ-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_default_1">
                                            <!-- Content in ข่าวประกาศ-->
                                            <!-- Message box -->
                                            <div class="row">
                                                <form action="/restaurant/add-news-today.php" method="post"  enctype="multipart/form-data">
                                                    <div class="col-md-8 "> 
                                                        <div class="form-group" >
                                                            <label class="col-sm-2 control-label" style="font-size: 16px" for="textinput">หัวข้อข่าว:</label>
                                                            <div class="col-sm-10" style="margin-bottom: 15px;">
                                                                <input type="text" placeholder="หัวข้อข่าว" class="form-control"  name="title"  required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" >
                                                            <textarea class="form-control input-sm " name="newsdetail" required="" style="font-size: 18px" type="textarea" id="message" placeholder="พิมพ์ข้อความข้าวประกาศที่นี่"  rows="10"></textarea>  
                                                        </div>
                                                        <!-- Post Button-->
                                                        <div id="inbox">
                                                            <div >
                                                                <div data-toggle="tooltip" data-placement="left" title="ประกาศ" style="margin-left: 42px;margin-top: -80;margin-left: 600;">
                                                                    <button type="submit" class="btn btn-danger btn-io " >
                                                                        <i class="glyphicon glyphicon-plus"></i>
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
                                                            <div class="span4">
                                                                <div class="thumbnail">
                                                                    <h3 style="margin:30px 0 0 0;">ใส่ภาพที่นี่</h3>

                                                                    <img src="/assets/images/default-img360.png" alt="ALT NAME">
                                                                    <div class="caption">
                                                                        <input type="file" id="imagerest" name="imagerest"  required="" accept="image/jpeg,image/pjpeg,image/png"  />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- End ส่วนอัพโหลดใหม่ -->


                                            <hr>
                                            <?php
                                            $res = $con->query("SELECT * FROM `news` WHERE restaurant_id = '$resid' order by created_time DESC");
                                            if ($res->num_rows > 0) {
                                                ?>
                                                <span style="text-align:center"><h2>ข่าวที่แล้ว</h2></span>
                                                <hr>
                                                <section id="pinBoot">
                                                    <?php
                                                    while ($data = $res->fetch_assoc()) {
                                                        ?>
                                                        <article class="white-panel">
                                                            <button type="button" class="close deleteNewsBtn"  data-id="<?= $data["id"]?>" data-toggle="tooltip" data-placement="top" title="ลบข่าวนี้?"  aria-label="Close"><span aria-hidden="true" style="color: red">&times;</span></button>
                                                            <img src="<?= $data["img_path"]?>" alt="">
                                                            <h4>เมื่อวันที่: &nbsp;<?= substr($data["created_time"], 0, 11).""."เวลา"." ".substr($data["created_time"], 11, 5)?>&nbsp;น.</h4>
                                                            <p style="font-size: 16px;">
                                                                <b><?= $data["title"]?>:</b>&nbsp;<?= $data["detail"]?>
                                                            </p>
                                                        </article>
                                                    <?php } ?>
                                                </section>
                                            <?php } ?>

                                        </div>
                                        <!-- End Content in ข่าวประกาศ-->
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
    <?php include '../template/footer.php'; ?>
    <script src="/assets/js/plugin-image.js"></script>
    <!--for old News-->
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip()
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
            $('[data-toggle="tooltip"]').tooltip();
            $(".deleteNewsBtn").click(function (e){
                var id = $(this).attr("data-id");
                  $.ajax({
                    url: "/restaurant-setting/delete-news.php?newid=" + id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        if(data.result == '1'){
                            document.location.reload();
                        }else{
                            alert(data.error);
                        }
                    }
                });
            });
            /* $('#characterLeft').text('140 characters left');
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
             });*/
        });
    </script>
</body>
</html>
