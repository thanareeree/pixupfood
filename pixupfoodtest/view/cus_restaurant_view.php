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
            #calendar {
                max-width: 900px;
                margin: 0 auto;
            }
            #restaurant_view .form-group {
                margin-bottom: 0px;
            }
.info_res
{
    font-size: 16px; 
    margin: 5px 0 0 30px; 
    color: orange;
}
        </style>


    </head>
    <body>
        <?php
        $menuSetId = @$_GET["menuId"];
        $menusetRes = $con->query("SELECT menu.id,  main_menu.name as menusetname, menu.price,main_menu.type,"
                . " restaurant.id as resid, restaurant.name as resname, restaurant.img_path "
                . "FROM menu "
                . "JOIN restaurant ON menu.restaurant_id = restaurant.id "
                . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                . "WHERE menu.id = '$menuSetId'");
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
        $con->query("select name from restaurant where id = '$resid'");
        ?>
        <?php include '../template/customer-navbar.php'; ?>

        <!-- edit head -->
        <section id="restaurant_view_head">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= $menusetData["resname"] ?></h1>
                    <div class="row lead">
                        <div id="stars-existing" class="starrr" data-rating='4'></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- edit body -->
        <section id="restaurant_view">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">News</a></li>
                            <li role="presentation"><a href="#promo" aria-controls="promo" role="tab" data-toggle="tab">Promotions</a></li>
                            <li role="presentation"><a href="#order" aria-controls="order" role="tab" data-toggle="tab">สั่งอาหาร</a></li>
                            <li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">ข้อมูลร้าน</a></li>
                            <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">รีวิว / คอมเม้นท์</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="news">
                                <br><div class="row">
                                    <div class="col-md-3">
                                        <section id="pinBoot">
                                            <article class="white-panel"><img src="/assets/images/res_resall/menuedit/FriedEgg.jpg" alt="">
                                                <h4><a href="#">เมนูใหม่</a></h4>
                                                <p>ทางร้านของเราได้เพิ่มเมนูอาหารใหม่ นั่นก็คือ สปาเก็ดดี้ไวท์ซอท สั่งได้แล้ววันนี้</p>
                                            </article>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <!-- Promotion -->
                            <div role="tabpanel" class="tab-pane" id="promo">
                                <br><div class="row">
                                    <section id="pinBootpromo">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <section id="pinBoot">
                                                    <article class="white-panel"><img src="/assets/images/sixStep/step5.png" alt="">
                                                        <h4><a href="#">ฟรีค่าจัดส่ง</a></h4>
                                                        <p>1 เดือนเท่านั้น</p>
                                                    </article>
                                                </section>
                                            </div>
                                            <!--<div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>     -->                    
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

                                    <form action="/customer/order-request-save.php?cusId<?= $cusid ?>&resId<?= $resid ?>" method="post">
                                        <input type="hidden" name="selectMenuFromCustomer" value="<?= $orderMenu_id ?>" >
                                        <div class="tab-content">

                                            <!-- เลือกกล่อง -------------------------------------------------------------->
                                            <div class="tab-pane active" role="tabpanel" id="step1">

                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="page-header">
                                                            ขั้นตอนที่ 1 : เลือกกล่องและจำนวนกล่อง
                                                        </div>
                                                        <div class="row">
                                                            <?php
                                                            $foodboxRes = $con->query("SELECT food_box.id, food_box.description, food_box.img_path,  "
                                                                    . "mapping_food_box.restaurant_id as resid "
                                                                    . "FROM mapping_food_box "
                                                                    . "LEFT JOIN food_box ON food_box.id = mapping_food_box.food_box_id "
                                                                    . "WHERE mapping_food_box.restaurant_id = '$resid' ");

                                                            while ($foodboxData = $foodboxRes->fetch_assoc()) {
                                                                ?>
                                                                <div class="col-md-3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img class="menu_img" src="<?= $foodboxData["img_path"] ?>"></a>
                                                                        <div class="caption">

                                                                            <p><?= $foodboxData["description"] ?>&nbsp;บาท</p>
                                                                            <p style="text-align: right">
                                                                                <input type="radio" name="foodboxtype" class="foodboxtype" id="foodboxtype<?= $foodboxData["id"] ?>" value="<?= $foodboxData["id"] ?>">
                                                                                <input type="hidden" class="boxtypedata" name="boxtype<?= $foodboxData["id"] ?>" value="<?= $foodboxData["description"] ?>">
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php } ?>
                                                        </div>
                                                        <div >
                                                            <h4>จำนวนกล่อง: &nbsp;<input type="number" name="boxamount" id="boxamount" value="" ></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-inline pull-right" style="margin-top: 20px;">
                                                    <li><button type="button" class="btn btn-primary next-step" id="submitStep1">Save and continue</button></li>
                                                </ul>

                                            </div>

                                            <!-- เลือกชนิดข้าวข้าว -------------------------------------------------------------->
                                            <div class="tab-pane" role="tabpanel" id="step2">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="page-header">
                                                            ขั้นตอนที่ 2 : เลือกข้าว
                                                        </div>
                                                        <div class="row">
                                                            <?php
                                                            $riceListRes = $con->query("SELECT main_menu.name, menu.price , menu.img_path,menu.id  "
                                                                    . "FROM `menu` LEFT JOIN main_menu on main_menu.id = menu.main_menu_id "
                                                                    . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                    . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                    . "WHERE main_menu.type = 'ชนิดข้าว' "
                                                                    . "and menu.restaurant_id = '$resid'");

                                                            while ($riceData = $riceListRes->fetch_assoc()) {
                                                                ?>
                                                                <div class="col-md-3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img class="menu_img" src="<?= ($riceData["img_path"] == "") ? '/assets/images/default-img360.png' : $riceData["img_path"] ?>"></a>
                                                                        <div class="caption">
                                                                            <h4><?= $riceData["name"] ?></h4>
                                                                            <p><?= $riceData["price"] ?>&nbsp;บาท</p>
                                                                            <p style="text-align: right">
                                                                                <input type="radio" name="ricetype" class="ricetype" id="ricetype<?= $riceData["id"] ?>" value="<?= $riceData["name"] ?>">
                                                                                <input type="hidden" class="ricetypedata" id="ricetypedata<?= $riceData["id"] ?>" value="<?= $riceData["price"] ?>"> 

                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                    <li><button type="button" class="btn btn-default prev-step" id="prevstep2">Previous</button></li>
                                                    <li><button type="button" class="btn btn-primary next-step" id="nextstep2">Save and continue</button></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="step3" >
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="page-header">
                                                            ขั้นตอนที่ 3 : เลือกรายการอาหาร
                                                        </div>
                                                        <h3>สามารถเลือกรายการได้ตามรูปแบบของกล่อง (ไม่เกิน 3 รายการ)</h3>
                                                        <div class="row">
                                                            <?php
                                                            $foodListRes = $con->query("SELECT DISTINCT main_menu.name, menu.price, menu.img_path, menu.id   "
                                                                    . "FROM `menu` LEFT JOIN main_menu on main_menu.id = menu.main_menu_id "
                                                                    . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                                    . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                                    . "WHERE main_menu.type = 'กับข้าว' "
                                                                    . "and menu.restaurant_id = '$resid'");

                                                            while ($foddListData = $foodListRes->fetch_assoc()) {
                                                                ?>
                                                                <div class="col-md-3">
                                                                    <div class="thumbnail">
                                                                        <a href="#"><img class="menu_img" src="<?= ($foddListData["img_path"] == "") ? '/assets/images/default-img360.png' : $foddListData["img_path"] ?>"></a>
                                                                        <div class="caption">
                                                                            <h4><?= $foddListData["name"] ?></h4>
                                                                            <p><?= $foddListData["price"] ?>&nbsp;</p>
                                                                            <p style="text-align: right">
                                                                                <input type="checkbox" name="foodlist[]" class="foodlist" id="foodlist<?= $foddListData["id"] ?>" value="<?= $foddListData["name"] ?>">
                                                                                <input type="hidden" name="foodprice[]" class="foodprice" id="foodprice<?= $foddListData["id"] ?>" value="<?= $foddListData["price"] ?>">
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                            }
                                                            ?>
                                                        </div> <!--<hr class="hrs">-->
                                                    </div>
                                                </div>
                                                <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                    <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                                </ul>
                                            </div>


                                            <div class="tab-pane" role="tabpanel" id="step4">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="page-header">
                                                            ขั้นตอนที่ 4 : เลือกวัน เวลา และสถานที่จัดส่ง
                                                        </div>
                                                        <div>
                                                            <h4>ส่งวันที่:     
                                                                <span id="datetext"></span><input type="date" name="delivery_date" required="">
                                                                <input type="text" name="date" id="datepick" style="display: none" >
                                                            </h4>
                                                        </div>
                                                        <div>
                                                            <h4>เวลา:<br>
                                                                <select name="delivery_time" id="delivery_time" class="col-md-3" >
                                                                    <option value="0">--เวลาจัดส่ง--</option>
                                                                    <option value="06:30:00">06:30 น.</option>
                                                                    <option value="07:30:00">07:30 น.</option>
                                                                    <option value="08:30:00">08:30 น.</option>
                                                                    <option value="09:30:00">09:30 น.</option>
                                                                    <option value="10:30:00">10:30 น.</option>
                                                                    <option value="11:30:00">06:30 น.</option>
                                                                    <option value="12:30:00">12:30 น.</option>
                                                                    <option value="13:30:00">13:30 น.</option>
                                                                    <option value="14:30:00">14:30 น.</option>
                                                                    <option value="15:30:00">15:30 น.</option>
                                                                    <option value="16:30:00">16:30 น.</option>
                                                                    <option value="17:30:00">17:30 น.</option>
                                                                    <option value="18:30:00">18:30 น.</option>
                                                                </select>
                                                            </h4>
                                                        </div><br>
                                                        <h3>สถานที่จัดส่ง:</h3>
                                                        <div class="content2">
                                                            <table class="table table-hover" id="task-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="3">Address</th>
                                                                        <th>Select</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                    $i = 1;

//$shipAddressRes = $con->query("SELECT CONCAT(shippingAddress.address,' ประเภท',shippingAddress.type,'(', shippingAddress.address_naming,')') AS ship_address, shippingAddress.id,shippingAddress.address  FROM `shippingAddress` WHERE customer_id = '$cusid'");
//while ($shipAddressData = $shipAddressRes->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>

                                                                    </tr>

                                                                    <?php
// }
                                                                    ?>
                                                                    <tr id="showdata">

                                                                    </tr>
                                                                    <tr id="showerror">

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
                                                </div>
                                                <ul class="list-inline pull-right"  style="margin-top: 20px">
                                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                    <li><button type="button" class="btn btn-primary next-step" id="hidecalendarbtn">Save and continue</button></li>
                                                </ul>
                                            </div>                                   



                                            <div class="tab-pane" role="tabpanel" id="step5">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="page-header">
                                                            ขั้นตอนที่ 5 : เลือกวิธีชำระเงิน
                                                        </div>

                                                        <?php
                                                        $bankRes = $con->query("SELECT `id`, `accname`, `accNo`, `bank`, `restaurant_id` "
                                                                . "FROM `bank_account` WHERE restaurant_id = '$resid' ");

                                                        $resPaymentRes = $con->query("select payment_type.id, payment_type.description "
                                                                . "FROM mapping_payment_type "
                                                                . "LEFT JOIN payment_type ON mapping_payment_type.payment_type_id = payment_type.id "
                                                                . "where mapping_payment_type.restaurant_id = '$resid' ");
                                                        $paymentRes = $con->query("SELECT payment_type.id, payment_type.description FROM payment_type ");
                                                        while ($paymentData = $paymentRes->fetch_assoc()) {
                                                            ?>
                                                            <div class="input-group col-md-12" style="margin: 10px 120px;"  >
                                                                <input type="radio"  name="paymentData" value="<?= $paymentData["id"] ?>"><?= $paymentData["description"] ?>
                                                            </div>
                                                        <?php } ?>
                                                        <hr>
                                                        <div >
                                                            *สามารถโอนเงินผ่านบัญชีธนาคาร&nbsp;&nbsp;<br>
                                                            <?php
                                                            while ($bankData = $bankRes->fetch_assoc()) {
                                                                ?>
                                                                <p>ชื่อบัญชี: &nbsp;<?= $bankData["accname"] ?>&nbsp;เลขที่บัญชี &nbsp;<?= $bankData["accNo"] ?>&nbsp;<?= $bankData["bank"] ?></p>

                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="list-inline pull-right" style="margin-top: 20px">
                                                    <li><button type="submit" class="btn btn-primary next-step">Order</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- ข้อมูลร้าน -->
                            <div role="tabpanel" class="tab-pane" id="info">
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="page-header">
                                                    <h3>ข้อมูลทั่วไป</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-commenting "></i> เกี่ยวกับร้าน</span><br>
                                                                <span class="info_res">ร้านอาหารตามสั่งแสนอร่อย ลองแล้วจะติดใจ บริการดี อาหารหลากหลาย สั่งเลย รับประกันความอร่อย </span>
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-clock-o "></i> ชั่วโมงการจัดส่ง</span><br>
                                                                <table style="margin: 5px 0 0 90px;width: 440px">
                                                                    <tbody class="info_res">
                                                                        <tr>
                                                                            <td> วันจันทร์ </td>
                                                                            <td class="pull-right"> 07.00น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันอังคาร </td>
                                                                            <td class="pull-right"> 07.00น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันพุธ </td>
                                                                            <td class="pull-right"> 07.00น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันพฤหัสบดี </td>
                                                                            <td class="pull-right"> 07.00น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันศุกร์ </td>
                                                                            <td class="pull-right"> 07.00น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันเสาร์ </td>
                                                                            <td class="pull-right"> 07.00น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันอาทิตย์ </td>
                                                                            <td class="pull-right"> 07.00น. - 18.30น.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-map-marker "></i> ที่ตั้งร้าน</span><br>
                                                                <span class="info_res">365/1167 ซ.พุทธบูชา 47 แขวงบางมด เขตทุ่งครุ กรุงเทพมหานคร 10140 </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-bell "></i> วัน/เวลาทำการ</span><br>
                                                                <span class="info_res"> จันทร์ - อาทิตย์ </span><br>
                                                                <span class="info_res"> 8.00น. - 22.00น. </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-users "></i> สั่งขั้นต่ำ</span><br>
                                                                <span class="info_res"> 30 กล่อง </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-motorcycle "></i> ค่าจัดส่ง</span><br>
                                                                <span class="info_res"> 100 บาท </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-clock-o "></i> ถึงมือประมาณ</span><br>
                                                                <span class="info_res"> 1 ชั่วโมง </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-money "></i> รูปแบบการชำระเงิน</span><br>
                                                                <span class="info_res"> เงินสดเมื่อได้รับอาหาร </span><br>
                                                                <span class="info_res"> โอนเงินผ่านบัญชีธนาคาร </span><br>
                                                                <span style="font-size: 12px; margin: 5px 0 0 30px; color: red"> *อาจมีการเรียกเก็บค่ามัดจำ </span>
                                                            </div>
                                                        </div><hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- review -->
                            <div role="tabpanel" class="tab-pane" id="review">
                                <br><div class="row">
                                    <div class="col-md-12">
                                        <h3 class="page-header" style="margin: 0 0 10px 0;">คอมเม้นต์จากลูกค้า</h3>
                                        <section class="comment-list">
                                            <!-- Comment1 -->
                                            <article class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <figure class="thumbnail">
                                                        <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
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
                                                        <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
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
                                                        <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
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
                                                        <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
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

                        <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="shipping_address">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/customer/ajax-address-shipping.php" id="addressform" name="addressform" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="shipping_address">เพิ่มที่จัดส่งสินค้า</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" value="<?= $cusid ?>" name="cusid">
                                            <label for="address">รายละเอียดที่จัดส่งสินค้า:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                            <div class="form-group">
                                                <textarea required class="form-control" placeholder="ที่จัดส่งสินค้า" rows="3"  name="address" id="address"></textarea>
                                            </div>
                                            <label for="addtype">ประเภทที่อยู่อาศัย:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                            <div class="form-group" >
                                                <select name="addtype" id="addtype" class="col-sm-12" required>
                                                    <option value="อพาร์ทเมนท์">อพาร์ทเมนท์</option>
                                                    <option value="สถานที่ราชการ">สถานที่ราชการ</option>
                                                    <option value="มหาวิทยาลัย">มหาวิทยาลัย</option>
                                                    <option value="โรงพยาบาล">โรงพยาบาล</option>
                                                    <option value="โรงแรม">โรงแรม</option>
                                                    <option value="บ้าน">บ้าน</option>
                                                    <option value="ตลาด">ตลาด</option>
                                                    <option value="โรงเรียน">โรงเรียน</option>
                                                    <option value="ร้านค้า">ร้านค้า</option>
                                                    <option value="วัด">วัด</option>
                                                    <option value="อื่นๆ">อื่นๆ</option>
                                                </select>
                                            </div>
                                            <label for="addnaming">กรุณาใส่ข้อมูลระบุที่จัดส่งเพื่อความรวดเร็ว:<span style="color: red;font-size: 20px;font-weight: normal">*</span></label>
                                            <div class="form-group">
                                                <input required class="form-control" placeholder="ชื่อเรียกที่จัดส่งเพื่อความรวดเร็ว"  name="addnaming" id="addnaming">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div>
                                                <input type="reset" class="btn btn-warning col-sm-3" name="resetbtn" value="Reset" >
                                                <input type="submit" class="btn btn-primary col-sm-3" name="addbtn"  value="Add" >
                                            </div>
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card" id="showcalendar">
                            <div class="card-content">
                                <div id="calendar"></div>
                            </div>  
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-content">
                                <div class="page-header">
                                    Order & Price
                                </div>
                                <div>

                                    <table class="table table-hover" id="task-table">
                                        <thead>
                                            <tr>
                                                <th>รายการอาหารที่เลือก</th>
                                                <th>
                                        <div class="col-md-6"></div>
                                        <div class="form-group col-md-6">
                                            <input type="number" name="amountbox" id="amountbox" class="form-control" value="">
                                        </div>

                                        </th>
                                        <th>กล่อง</th>
                                        </tr>
                                        </thead>
                                        <tbody id="menuOrderList">
                                            <tr>
                                                <td>ข้าว </td>
                                                <td>10</td>
                                                <td>บาท</td>
                                            </tr>
                                            <tr>
                                                <td>หมูกระเทียม </td>
                                                <td>20</td>
                                                <td>บาท</td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <table class="table table-hover" id="task-table">
                                        <thead>
                                            <tr>
                                                <th>ราคาทั้งหมด</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="priceOfOrder">
                                            <tr>
                                                <td>ราคา: </td>
                                                <td>10000</td>
                                                <td>บาท</td>
                                            </tr>
                                            <tr>
                                                <td>ค่าจัดส่ง: </td>
                                                <td>100</td>
                                                <td>บาท</td>
                                            </tr>
                                            <tr>
                                                <td>ราคารวม: </td>
                                                <td>10100</td>
                                                <td>บาท</td>
                                            </tr>
                                            <tr>
                                                <td>ค่ามัดจำ 20%: </td>
                                                <td>200</td>
                                                <td>บาท</td>
                                            </tr>
                                            <tr>
                                                <td style="color: red">ราคาส่วนที่เหลือ*</td>
                                                <td>900</td>
                                                <td>บาท</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <hr style="border: solid 1px">
                                    <p>*ราคาส่วนที่เหลือนั้น ลูกค้าจะต้องชำระด้วยเงินสดเมื่อได้รับสินค้า</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>

        <script>

            $(document).ready(function () {
                $('#calendar').fullCalendar({
                    defaultDate: '2015-02-12',
                    editable: true,
                    eventLimit: true // allow "more" link when too many events

                });

                $("#addressform").on("submit", function (e) {
                    $.ajax({
                        url: "/customer/ajax-address-shipping.php",
                        type: "POST",
                        data: $("#addressform").serializeArray(),
                        dataType: "json",
                        success: function (data) {
                            if (data.result == 1) {
                                $("#add_address").modal('hide');
                                $("#showdata").append('<td colspan="3">' + data.address + '</td>' +
                                        '<td><input type="radio"  name="shipAddress" value="' + data.address + '"> </td>');
                            } else {
                                $("#showerror").html(data.error);
                            }
                        }
                    });
                    e.preventDefault();
                    return false;
                });




            });

        </script>


        <script>
            $(document).ready(function () {
                $('#datepick').datepick({
                    minDate: new Date(),
                    dateFormat: 'd M yyyy'
                });

                $('#hidecalendarbtn').on('click', function (e) {
                    $('#showcalendar').hide();
                });

                $(".foodboxtype").click(function () {
                    var editid = $(this).attr("id");
                    var boxid = editid.replace("foodboxtype", "");
                    if (boxid == "1") {

                    } else if (boxid == "2") {

                    } else if (boxid == "3") {

                    } else if (boxid == "4") {

                    }


                });





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
                /* $('#pinBoot').pinterest_grid({
                 no_columns: 4,
                 padding_x: 10,
                 padding_y: 10,
                 margin_bottom: 50,
                 single_column_breakpoint: 700
                 });
                 });*/


                $('#info').click(function (e) {
                    alert('ccccc');
                });
            });
            /*
             Ref:
             Thanks to:
             http://www.jqueryscript.net/layout/Simple-jQuery-Plugin-To-Create-Pinterest-Style-Grid-Layout-Pinterest-Grid.html
             */

            /* (function ($, window, document, undefined) {
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
             $container = $(this.element), container_width = $container.width();
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
             
             })(jQuery, window, document);*/

        </script>

    </body>
</html>
