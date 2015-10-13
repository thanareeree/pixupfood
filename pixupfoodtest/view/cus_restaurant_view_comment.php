<?php
include '../dbconn.php';
include '../api/islogin.php';
?>

<html>
    <head>
        <title>Pixupfood - Restaurant View</title>

        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/restaurant_view.css">

        <link href='/assets/css/fullcalendar.css' rel='stylesheet' />
        <link href='/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        
        <style>
            #showcalendar a span {
                color: #ffffff;
                font-size: 12.5px;
            }
        </style>

    </head>
    <body>
        <?php
        $orderMenu_id = @$_GET["menuId"];
        $menusetRes = $con->query("SELECT menu.id,  main_menu.name as menusetname, menu.price,main_menu.type,"
                . " restaurant.id as resid, restaurant.name as resname, restaurant.img_path "
                . "FROM menu "
                . "JOIN restaurant ON menu.restaurant_id = restaurant.id "
                . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                . "WHERE menu.id = '$orderMenu_id'");
        $menusetData = $menusetRes->fetch_assoc();
        print_r($menusetData);

        $cusid = $_SESSION["userdata"]["id"];
        $customerRes = $con->query("select customer.id, customer.firstName, customer.lastName,"
                . " customer.email, customer.tel, customer.address   "
                . "from customer "
                . "where id = '$cusid' ");
        $customerData = $customerRes->fetch_assoc();

        $orderMenu_id = @$_GET["menuId"];
        $resid = @$_GET["resId"];
        $resNameRes = $con->query("select `name`, `email`, `tel`,`detail`, `img_path`, `star`, `address`,"
                . " `opentime`, `amount_box_minimum`, `amount_box_limit`, `has_restaurant`, `restaurant_type`"
                . ", deliveryfee, close"
                . " from restaurant "
                . "join mapping_delivery_type on mapping_delivery_type.restaurant_id = restaurant.id  "
                . " where id = '$resid'");
        $resNameData = $resNameRes->fetch_assoc();
        ?>
        <?php include '../template/customer-navbar.php'; ?>
        <input type="hidden" value="<?= $resid ?>" class="getResId" >
        <!-- edit head -->
        <section id="restaurant_view_head">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= ($resNameData["name"] == "" ? $resNameData["name"] : $resNameData["name"]) ?></h1>
                    <div class="row lead">
                        <div id="stars-existing" class="starrr" data-rating='4'></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- edit body -->
        <section id="restaurant_view">
            <div class="container">
                <?php include '../customer-view-restaurant/status-close.php'; ?>
                <div class="row">
                    <div class="col-md-8">
                        <!-- Nav tabs -->
                       <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" ><a href="/view/cus_restaurant_view_news.php?resId=<?= $resid?>" >ข่าวประกาศ</a></li>
                            <li role="presentation" ><a href="/view/cus_restaurant_view_promotion.php?resId=<?= $resid?>" >โปรโมชั่น</a></li>
                            <li role="presentation" ><a href="/view/cus_restaurant_view.php?resId=<?= $resid?>" >สั่งอาหาร</a></li>
                            <li role="presentation" ><a href="/view/cus_restaurant_view_info.php?resId=<?= $resid?>" >ข้อมูลร้าน</a></li>
                            <li role="presentation" class="active"><a href="/view/cus_restaurant_view_comment.php?resId=<?= $resid?>" >รีวิว / คอมเม้นท์</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- review -->
                            <div role="tabpanel" class="tab-pane active" id="review">
                                <br><div class="row">
                                    <div class="col-md-12">
                                        <h3 class="page-header" style="margin: 0 0 10px 0;">คอมเม้นต์จากลูกค้า</h3>
                                        <section class="comment-list">
                                            <!-- Comment1 -->
                                            <article class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <figure class="thumbnail">
                                                        <img class="img-responsive" src="/assets/images/default-avatar.jpg"  />
                                                        <figcaption class="text-center">มานี</figcaption> <!-- ชื่อจริง -->
                                                    </figure>
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="panel panel-default arrow left">
                                                        <div class="panel-body">
                                                            <header class="text-left">
                                                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                            </header>
                                                            <div class="comment-post">
                                                                <p>
                                                                    อร่อยมากๆ ค่ะ ><
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                            <!-- Comment2 -->
                                            <article class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <figure class="thumbnail">
                                                        <img class="img-responsive" src="/assets/images/default-avatar.jpg" />
                                                        <figcaption class="text-center">มานะ</figcaption>
                                                    </figure>
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="panel panel-default arrow left">
                                                        <div class="panel-body">
                                                            <header class="text-left">
                                                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                            </header>
                                                            <div class="comment-post">
                                                                <p>
                                                                    เมนูข้าวผัดร้านนี้อร่อยมากครับ !!
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                            <!-- Comment3 -->
                                            <article class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <figure class="thumbnail">
                                                        <img class="img-responsive"src="/assets/images/default-avatar.jpg"  />
                                                        <figcaption class="text-center">ปิติ</figcaption>
                                                    </figure>
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="panel panel-default arrow left">
                                                        <div class="panel-body">
                                                            <header class="text-left">
                                                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                            </header>
                                                            <div class="comment-post">
                                                                <p>
                                                                    คนส่งอาหารมาช้าไปหน่อยครับ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>

                                            <!-- Comment4 -->
                                            <article class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <figure class="thumbnail">
                                                        <img class="img-responsive" src="/assets/images/default-avatar.jpg" />
                                                        <figcaption class="text-center">ชูใจ</figcaption>
                                                    </figure>
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="panel panel-default arrow left">
                                                        <div class="panel-body">
                                                            <header class="text-left">
                                                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                                                            </header>
                                                            <div class="comment-post">
                                                                <p>
                                                                    ผัดกระเพราเค็มไปนิดนึงค่ะ แต่บริการดี มั่นใจได้ค่ะ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </section>
                                    </div>
                                </div>
                                <!-- คอมเม้นลูกค้าเขียน -->
                                <hr class="hrs">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form>
                                            <div class="card">
                                                <div class="card-content" style="padding: 10px 10px 0 10px">
                                                    <textarea class="form-control input-sm " type="textarea" id="recom" placeholder="เขียนข้อความของคุณที่นี่" rows="5"></textarea><br>
                                                </div>
                                            </div>
                                            <div class="pull-right" style="margin: 10px 0 0 0">
                                                <button class="btn btn-primary" type="submit" value="ส่งข้อความ">ส่งข้อความ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" id="showcalendar">
                            <div class="card-content">
                                <div id="calendar" style="color: #FF9900"></div>
                            </div>  
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>
        <script src="/assets/js/view_reataurant_comment.js"></script>
    </body>
</html>
