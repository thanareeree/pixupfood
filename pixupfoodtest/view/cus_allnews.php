<?php
session_start();
include '../dbconn.php';
?>

<html >
    <head>        
        <title>PixupFood - The Original Food Delivery</title>
        <?php include '../template/customer-title.php'; ?>
        <link rel="stylesheet" href="../assets/css/all_news.css">
    </head>
    <body>
        <?php include '../template/customer-navbar.php'; ?>

        <!-- start register -->
        <section id="allnews">
            <div class="overlay">
                <div class="container text-center">
                    <h1>News and Update</h1>
                    <h4>ข่าวสารทั่วไป และ ข้อมูลใหม่ๆ จากร้านอาหาร</h4>
                </div>
            </div>
        </section>

        <section id="allnews_body">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <img src="/assets/images/ads.png" width="100%" style="margin-top: 60px;margin-bottom: 60px">
                    </div>
                    <div class="col-md-10" >
                        <div class="row" style="padding:60px 15px 30px 50px;border-top:1px solid #e8e8e8; ">
                            <?php
                            $res = $con->query("SELECT news.img_path, news.title, news.detail, news.created_time, restaurant.name "
                                    . "FROM `news` "
                                    . "LEFT JOIN restaurant ON restaurant.id = news.restaurant_id "
                                    . " ORDER BY RAND() ");
                            while ($data = $res->fetch_assoc()) {
                                ?>
                                <div class="col-md-6" >
                                    <ul class="media-list main-list"  style="border-bottom:1px solid #e8e8e8; ">
                                        <li class="media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object" src="<?= $data["img_path"] ?>" alt="..." width="150px" style="max-height:90px;">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><?= $data["title"] ?></h4>
                                                <p class="by-author" ><?= $data["detail"] ?><br>
                                                    <?= $data["name"] ?>&nbsp;เมื่อวันที่: &nbsp;<?= substr($data["created_time"], 0, 11) . " " . substr($data["created_time"], 11, 5) ?>&nbsp;น.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end register -->

        <?php include '../template/footer.php'; ?>


    </body>
</html>