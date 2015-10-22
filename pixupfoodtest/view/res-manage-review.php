<?php
include '../api/islogin.php';
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant Today Management</title>

        <?php
        include '../template/customer-title.php';
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/res_restaurant_manage.css">
        <link rel="stylesheet" href="/assets/css/customer-comment.css">
        <style>
            form .stars {
                margin: 0 700 -10;
            }
        </style>

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
                        <div class="hidden-xs">ปฏิทิน</div>
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
                                        <li >
                                            <a href="/view/res_restaurant_manage_today.php" >ข่าวประกาศ </a>
                                        </li>
                                        <li class="active">
                                            <a href="/view/res-manage-review.php" >รีวิว/คอมเม้นต์จากลูกค้า </a>
                                        </li>
                                    </ul>
                                    <!-- End Header Sub Tab-->

                                    <!-- Content in ข่าวประกาศ-->
                                    <div class="tab-content">

                                        <!-- Start Content in คอมเม้นต์จากลูกค้า-->

                                        <div class="tab-pane active"  id="tab_default_2">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="page-header">รีวิว/คอมเม้นท์จากลูกค้า</h3>
                                                    <section class="comment-list">
                                                        <?php
                                                        $res = $con->query("SELECT customer.firstName, customer.img_path, comment.updated_time,"
                                                                . " comment.detail, comment.score "
                                                                . "FROM `comment` "
                                                                . "LEFT JOIN customer on customer.id = comment.customer_id "
                                                                . "WHERE comment.restaurant_id = '$resid'");
                                                        if ($res->num_rows == 0) {
                                                            ?>
                                                            <article class="row">
                                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                                    <figure class="thumbnail">
                                                                        <img class="img-responsive" src="/assets/images/default-avatar.jpg"  />
                                                                       <figcaption class="text-center"></figcaption>
                                                                    </figure>
                                                                </div>
                                                                <div class="col-md-10 col-sm-10">
                                                                    <div class="panel panel-default arrow left">
                                                                        <div class="panel-body">
                                                                            <header class="text-left "></header>
                                                                            <div class="comment-post">
                                                                                <h4>ยังไม่ไมี</h4>
                                                                                <form id="ratingsForm">
                                                                                    <div class="stars">
                                                                                        <input type="radio" name="star[]" class="star-1" id="star-1" disabled=""/>
                                                                                        <label class="star-1" for="star-1">1</label>
                                                                                        <input type="radio" name="star[]" class="star-2" id="star-2" disabled="" />
                                                                                        <label class="star-2" for="star-2">2</label>
                                                                                        <input type="radio" name="star[]" class="star-3" id="star-3" disabled="" />
                                                                                        <label class="star-3" for="star-3">3</label>
                                                                                        <input type="radio" name="star[]" class="star-4" id="star-4" disabled="" />
                                                                                        <label class="star-4" for="star-4">4</label>
                                                                                        <input type="radio" name="star[]" class="star-5" id="star-5" disabled="" />
                                                                                        <label class="star-5" for="star-5">5</label>
                                                                                        <span></span>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </article>
                                                            <?php
                                                        } else {
                                                            while ($data = $res->fetch_assoc()) {
                                                                ?>
                                                                <!-- First Comment -->
                                                                <article class="row">
                                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                                        <figure class="thumbnail">
                                                                            <img class="img-responsive" src="<?= $data["img_path"] ?>"  />
                                                                            <figcaption class="text-center"><?= $data["firstName"] ?></figcaption> <!-- ชื่อจริง -->
                                                                        </figure>
                                                                    </div>
                                                                    <div class="col-md-10 col-sm-10">
                                                                        <div class="panel panel-default arrow left">
                                                                            <div class="panel-heading"> ใหม่</div>
                                                                            <div class="panel-body">
                                                                                <header class="text-left ">
                                                                                    <time class="comment-date" ><i class="glyphicon glyphicon-time"></i>&nbsp;<?= substr($data["updated_time"], 0, 11) ?> </time>
                                                                                </header>
                                                                                <div class="comment-post">
                                                                                    <p><?= $data["detail"] ?></p>
                                                                                    <form id="ratingsForm">
                                                                                        <div class="stars">
                                                                                            <input type="radio" name="star[]" class="star-1" id="star-1" disabled="" <?= ($data["score"] == 1 ? 'checked' : '') ?>/>
                                                                                            <label class="star-1" for="star-1">1</label>
                                                                                            <input type="radio" name="star[]" class="star-2" id="star-2" disabled="" <?= ($data["score"] == 2 ? 'checked' : '') ?>/>
                                                                                            <label class="star-2" for="star-2">2</label>
                                                                                            <input type="radio" name="star[]" class="star-3" id="star-3" disabled="" <?= ($data["score"] == 3 ? 'checked' : '') ?>/>
                                                                                            <label class="star-3" for="star-3">3</label>
                                                                                            <input type="radio" name="star[]" class="star-4" id="star-4" disabled="" <?= ($data["score"] == 4 ? 'checked' : '') ?>/>
                                                                                            <label class="star-4" for="star-4">4</label>
                                                                                            <input type="radio" name="star[]" class="star-5" id="star-5" disabled="" <?= ($data["score"] == 5 ? 'checked' : '') ?>/>
                                                                                            <label class="star-5" for="star-5">5</label>
                                                                                            <span></span>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </article>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </section>
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
        </div>
    </div>

    <!-- End Content in today--> 

    <!-- start footer -->
    <?php include '../template/footer.php'; ?>

    <!--for old News-->
    <script>
        $(document).ready(function () {

            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
                $(".tab").addClass("active"); // instead of this do the below 
                $(this).removeClass("btn-default").addClass("btn-warning");
            });
           
        });


    </script>

</body>
</html>
