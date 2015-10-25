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
        <link rel="stylesheet" href="/assets/css/customer-comment.css">

        <style>
            #restaurant_view .fb-image-profile
            {
                margin: -160px 45px 10px 80px;
                z-index: 9;
                width: 13%;
                height: 175px;
                border-radius:50%;
            }
            #restaurant_view .menu_img{
                width: 100%;
                max-width: 100%;
                height: 100px;
            }
            #showcalendar a span {
                color: #ffffff;
                font-size: 12.5px;
            }
        </style>


    </head>
    <body>
        <?php
        $cusid = $_SESSION["userdata"]["id"];
        $customerRes = $con->query("select customer.id, customer.firstName, customer.lastName,"
                . " customer.email, customer.tel, customer.address   "
                . "from customer "
                . "where id = '$cusid' ");
        $customerData = $customerRes->fetch_assoc();
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
                        <?php include '../customer-view-restaurant/star-head.php'; ?>
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
                            <li role="presentation" ><a href="/view/cus_restaurant_view_news.php?resId=<?= $resid ?>" >ข่าวประกาศ</a></li>
                            <li role="presentation" class="active"><a href="/view/cus_restaurant_view_promotion.php?resId=<?= $resid ?>" >โปรโมชั่น</a></li>
                            <li role="presentation" ><a href="/view/cus_restaurant_view.php?resId=<?= $resid ?>" >สั่งอาหาร</a></li>
                            <li role="presentation"><a href="/view/cus_restaurant_view_info.php?resId=<?= $resid ?>" >ข้อมูลร้าน</a></li>
                            <li role="presentation"><a href="/view/cus_restaurant_view_comment.php?resId=<?= $resid ?>" >รีวิว / คอมเม้นท์</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">

                            <!-- Promotion -->
                            <div role="tabpanel" class="tab-pane active" id="promo">
                                <br><div class="row">
                                    <section id="pinBootpromo">
                                        <div class="row">
                                            <section id="pinBoot">
                                                <?php
                                                $res = $con->query("select * from promotion "
                                                        . "LEFT JOIN promotion_main ON promotion_main.id = promotion.promotion_main_id "
                                                        . "where restaurant_id = '$resid' "
                                                        . "order by created_time DESC");
                                                while ($data = $res->fetch_assoc()) {
                                                    ?>
                                                    <article class="white-panel"><img src="<?= $data["img_path"] ?>" alt="">
                                                        <h4><?= $data["name"] ?>!!</h4>
                                                        <p style="font-size: 14px;"><?= $data["description"] ?></p>
                                                        <p style="font-size: 14px;">
                                                            <b>เริ่ม:</b>&nbsp;&nbsp;<?= $data["start_time"] ?>
                                                            <b>หมดเขต:</b>&nbsp;&nbsp;<?= $data["end_time"] ?>
                                                        </p>
                                                    </article>
                                                <?php } ?>
                                            </section>
                                        </div>
                                    </section>
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
        <script src="/assets/js/view_restaurant_promotion.js"></script>
        <script src="/assets/js/plugin-image.js"></script>
    </body>
</html>
