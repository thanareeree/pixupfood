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
                . ", deliveryfee"
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
                <div class="row">
                    <div class="col-md-8">
                        <!-- Nav tabs -->
                     <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" ><a href="/view/cus_restaurant_view_news.php?resId=<?= $resid?>" >ข่าวประกาศ</a></li>
                            <li role="presentation" ><a href="/view/cus_restaurant_view_promotion.php?resId=<?= $resid?>" >โปรโมชั่น</a></li>
                            <li role="presentation" ><a href="/view/cus_restaurant_view.php?resId=<?= $resid?>" >สั่งอาหาร</a></li>
                            <li role="presentation" class="active"><a href="/view/cus_restaurant_view_info.php?resId=<?= $resid?>" >ข้อมูลร้าน</a></li>
                            <li role="presentation"><a href="/view/cus_restaurant_view_comment.php?resId=<?= $resid?>" >รีวิว / คอมเม้นท์</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                          
                            <!-- ข้อมูลร้าน -->
                            <div role="tabpanel" class="tab-pane active" id="info">
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
                                                                <span class="info_res"><?= $resNameData["detail"] ?></span>
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-clock-o "></i> ชั่วโมงการจัดส่ง</span><br>
                                                                <table style="margin: 5px 0 0 90px;width: 440px">
                                                                    <tbody class="info_res">
                                                                        <tr>
                                                                            <td> วันจันทร์ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันอังคาร </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันพุธ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันพฤหัสบดี </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันศุกร์ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันเสาร์ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td> วันอาทิตย์ </td>
                                                                            <td class="pull-right"> 06.30น. - 18.30น.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-map-marker "></i> ที่ตั้งร้าน</span><br>
                                                                <span class="info_res"><?= $resNameData["address"] ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-bell "></i> วัน/เวลาทำการ</span><br>
                                                                <span class="info_res"> จันทร์ - อาทิตย์ </span><br>
                                                                <span class="info_res"> <?= $resNameData["opentime"] ?> </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-users "></i> สั่งขั้นต่ำ</span><br>
                                                                <span class="info_res"> <?= $resNameData["amount_box_minimum"] ?> กล่อง </span>   
                                                            </div>
                                                        </div><hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: 22px;"><i class="fa fa-motorcycle "></i> ค่าจัดส่ง</span><br>
                                                                <span class="info_res"> <?= $resNameData["deliveryfee"] ?> บาท </span>   
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
                                                                <span style="font-size: 12px; margin: 5px 0 0 30px; color: red"> *ค่ามัดจำ 20%ต่อหนึ่งรายการ </span>
                                                            </div>
                                                        </div><hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        <script src="/assets/js/view_restaurant_info.js"></script>
    </body>
</html>