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
            #restaurant_view form .stars {
                margin: 0 400 -10;
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
                . "left join mapping_delivery_type on mapping_delivery_type.restaurant_id = restaurant.id  "
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
                            <li role="presentation" ><a href="/view/cus_restaurant_view_promotion.php?resId=<?= $resid ?>" >โปรโมชั่น</a></li>
                            <li role="presentation" ><a href="/view/cus_restaurant_view.php?resId=<?= $resid ?>" >สั่งอาหาร</a></li>
                            <li role="presentation" ><a href="/view/cus_restaurant_view_info.php?resId=<?= $resid ?>" >ข้อมูลร้าน</a></li>
                            <li role="presentation" class="active"><a href="/view/cus_restaurant_view_comment.php?resId=<?= $resid ?>" >รีวิว / คอมเม้นท์</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- review -->
                            <div role="tabpanel" class="tab-pane active" id="review">
                                <br><div class="row">
                                    <div class="col-md-12">
                                        <h3 class="page-header" style="margin: 0 0 10px 0;">รีวิว / คอมเม้นท์</h3>
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
                                                                <header class="text-left ">
                                                                    <time class="comment-date" ><i class="fa fa-clock-o" style="color: gray"></i></time>
                                                                </header>
                                                                <div class="comment-post">
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
                                                    <!-- Comment1 -->
                                                    <article class="row">
                                                        <div class="col-md-2 col-sm-2 hidden-xs">
                                                            <figure class="thumbnail">
                                                                <img class="img-responsive" src="<?= $data["img_path"] ?>"  />
                                                                <figcaption class="text-center"><?= $data["firstName"] ?></figcaption> <!-- ชื่อจริง -->
                                                            </figure>
                                                        </div>
                                                        <div class="col-md-10 col-sm-10">
                                                            <div class="panel panel-default arrow left">
                                                                <div class="panel-body">
                                                                    <header class="text-left ">
                                                                        <time class="comment-date" ><i class="fa fa-clock-o"></i>&nbsp;<?= substr($data["updated_time"], 0, 11) ?> </time>
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
                    <div class="col-md-4">
                        <div class="card" id="showcalendar">
                            <div class="card-content">
                                <div id="calendar" style="color: #FF9900"></div>
                            </div>
                            <div class="calendar" style="color: #FF9900"></div>
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
