<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../dbconn.php';
?>




<html>
    <head>
        <meta charset="UTF-8">
        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->

        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <?php
        addlink("Customer Profile");
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/res_restaurant_manage.css">

    </head>
    <body>

        <?php cusnavbar(); ?>

        <!-- start head -->
        <section id="head">
            <div id="myCarousel" class="carousel" style="margin-top:70px;">
                <!-- Indicators -->
                <div class="item">
                    <img src="../assets/images/slide/aa.png" class="img-responsive">
                    <div class="container">
                        <div class="carousel-caption-new">
                            <div class="RestaurantHeader">
                                ร้านนายใหญ่โภชนา
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
        <!-- end head-->

        <!--Menu Item-->
    <scetion id="menu">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_today.php">
                    <button type="button" id="today" class="btn btn-default">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">วันนี้</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_calendar.php">
                    <button type="button" id="orders" class="btn btn-default" data-toggle="tab">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">รายการสั่งซื้อ</div>
                    </button>
                </a>
            </div><div class="btn-group" role="group">
                <a href="">
                    <button type="button" id="calendar" class="btn btn-default" data-toggle="tab">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">ปฏิทิน</div>
                    </button>
                </a>
            </div><div class="btn-group" role="group">
                <a href="res_restaurant_manage_menulist.php">
                    <button type="button" id="menulist" class="btn btn-default" data-toggle="tab">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">รายการอาหาร</div>
                    </button>
                </a>
            </div><div class="btn-group" role="group">
                <a href="res_restaurant_manage_edit.php">
                    <button type="button" id="editres" class="btn btn-default" data-toggle="tab">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">การตั้งค่า</div>
                    </button>
                </a>
            </div>
        </div>
    </scetion>
    <!--End Menu Item-->
    <!-- รายการอาหาร -->
    <div class="tab-pane fade in" id="tab4">
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1_4" data-toggle="tab">
                                        รายการอาหารปัจจุบัน </a>  
                                </li>
                                <li>
                                    <a href="#tab_default_2_4" data-toggle="tab">
                                        รายการอาหารที่หมดชั่วคราว </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1_4">
                                    <div class="page-header">

                                        <div class="row">
                                            <div class="col-md-8"><h2>รายการอาหารปัจจุบัน</h2></div>
                                            <div class="col-md-2">
                                                <p class="text-center pull-right" style="margin-top: 20px;">
                                                    <a class="btn icon-btn btn-success" data-toggle="modal" data-target='#AddMenu'>
                                                        <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success">
                                                        </span> เพิ่มใหม่</a></p>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="text-center pull-left" style="margin-top: 20px;">
                                                    <a class="btn icon-btn btn-warning" data-toggle="modal" data-target='#'>
                                                        <span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-warning">
                                                        </span> ลบทิ้ง</a></p></div>
                                        </div>
                                    </div>
                                    <!-- ค้นหา -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>ค้นหา</h2>
                                                    <input type="text" class="form-control" placeholder="ป้อนคำค้นหา...">
                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข
                                                                                </a>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>
                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>
                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>
                                                                    </div>
                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข
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
                                    </div>
                                    <!-- จบค้นหา -->

                                    <!-- ชนิดข้าว -->

                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>ขนิดข้าว</h2>
                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="margin-left: 50px;">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>
                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger"> </span> 
                                                                                        แก้ไข
                                                                                    </a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger"> </span> 
                                                                                    แก้ไข
                                                                                </a>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>
                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>
                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>
                                                                    </div>
                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger"> </span>
                                                                                    แก้ไข
                                                                                </a>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>
                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>
                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>
                                                                    </div>
                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger"> </span> 
                                                                                        แก้ไข
                                                                                    </a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger"> </span> 
                                                                                    แก้ไข
                                                                                </a>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>
                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>
                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>
                                                                    </div>
                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger"> </span> 
                                                                                        แก้ไข
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
                                    </div>
                                    <!-- จบชนิดข้าว -->

                                    <!-- เริ่มรายการกับข้าว -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>รายการกับข้าว</h2>
                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>
                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>
                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>
                                                                    </div>
                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>
                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>
                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>
                                                                    </div>
                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>
                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>
                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>
                                                                    </div>
                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
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

                                    <!-- จบรายการกับข้าว-->

                                    <!-- อาหารจานด่วน -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>อาหารจานด่วน</h2>
                                                    <!-- Menu 1 Row-->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>


                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>


                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>


                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>


                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Menu 1 Row -->

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>


                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>


                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>


                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>


                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
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
                                    <!-- จบรายการอาหารจานด่วน-->

                                    <!-- รายการเครื่องดื่ม -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h2>เครื่องดื่ม</h2>
                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>


                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>


                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>


                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>


                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Menu 1 Row -->

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>


                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>


                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>


                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>


                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3 pull-left">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                    </span> แก้ไข</a></p>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>


                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>

                                                                    </div>

                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3 pull-left">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#EditMenu'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-danger">
                                                                                        </span> แก้ไข</a></p>
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

                                    <!-- จบรายการเครื่องดื่ม-->

                                    <!-- Modal แก้ไขเมนู -->
                                    <!--EditMenu Modal-->
                                    <div class="modal fade" id="EditMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">เพิ่มรายการใหม่</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row" style="margin: 0px;">
                                                        <div class="card">
                                                            <div class="card-action">
                                                                <div class="page-header" style="font-size:18px;margin-top: 0px;">
                                                                    รูปภาพ
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="col-md-6"> 
                                                                        <div class="thumbnails">
                                                                            <div class="span4">
                                                                                <form>
                                                                                    <div class="thumbnail">
                                                                                            <!-- <input type="file" name="img"> --->
                                                                                        <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg" alt="ALT NAME">
                                                                                    </div>                                                                                    
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6" style="margin-top: 60px;"> 
                                                                        <p align="center"><button type="button" name="img" value="อัพโหลด" onClick="upload.click()" onMouseOut="uploadtext.value = upload.value" class="btn btn-primary btn-block" style="font-style:normal">เลือกรูป</button></p>
                                                                        <!-- Upload Function-->   

                                                                        <form action="uploadfile.php" method="post" enctype="multipart/form-data" target="ifrm">
                                                                            <input type="file" name="upload" style="display:none" />
                                                                            <input type="button" name="uploadbutton" value="choose file" onclick="upload.click()" onmouseout="uploadtext.value = upload.value" style="display:none"/>
                                                                        </form>

                                                                        <iframe name="ifrm" style="display:none;">
                                                                        </iframe>

                                                                        <div class="progress">
                                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                                                                100%
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin:15px -15px;">
                                                            <div class="col-md-12">
                                                                <div class="card" style="margin-top: 1px;">
                                                                    <div class="card-action">
                                                                        <div class="page-header" style="font-size:18px;margin-top: 0px;">
                                                                            ทั่วไป
                                                                        </div>
                                                                        <form>
                                                                            <div class="row" style="margin:10px 0 0 5px;">
                                                                                <span style="margin-left: 24px;"> ชื่ออาหาร </span> &nbsp;<input type="text">
                                                                                <span style="margin-left: 25px;"> ราคาอาหาร </span> &nbsp;<input type="text">&nbsp; บาท 
                                                                            </div>
                                                                            <div class="row" style="margin:10px 0 0 30px;">
                                                                                <span> หมวดหมู่ </span>&nbsp;
                                                                                <select style="width: 150px;">
                                                                                    <option>--ตัวเลือก--</option>
                                                                                    <option>ชนิดข้าว</option>
                                                                                    <option>กับข้าว</option>
                                                                                    <option>อาหารจานด่วน</option>
                                                                                    <option>เครื่องดื่ม</option>
                                                                                </select>
                                                                                <span style="margin-left: 25px;"> หมวดหมู่ </span>&nbsp;&nbsp;
                                                                                <select style="width: 150px;  margin-left: 5px;">
                                                                                    <option>--ตัวเลือก--</option>
                                                                                    <option>อาหารไทย</option>
                                                                                    <option>อาหารฝรั่ง</option>
                                                                                    <option>อาหารญี่ปุ่น</option>
                                                                                    <option>อาหารเหนือ</option>
                                                                                    <option>อาหารอีสาน</option>
                                                                                    <option>อาหารใต้</option>
                                                                                    <option>อาหารเจ</option>
                                                                                    <option>อาหารมังสวิรัติ</option>
                                                                                </select>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <form action="#" method="#">
                                                                <div class="col-md-6">
                                                                    <div class="card" style="margin-top: 1px;">
                                                                        <div class="card-action">
                                                                            <div class="page-header"style="font-size:18px;margin-top: 0px;">โปรโมชั่น</div>
                                                                            <div class="material-switch">
                                                                                <span style="margin-left: 28px;"> ปิดใช้งาน </span> &nbsp;
                                                                                <input id="someSwitchOptionSuccess2" name="someSwitchOption001" type="checkbox"/>
                                                                                <label for="someSwitchOptionSuccess2" class="label-success"></label>
                                                                                &nbsp; <span>เปิดใช้งาน</span> <br> <br>
                                                                                <div class="radio" style="margin-left: 23px;">
                                                                                    <input type="radio" > <span > &nbsp;ลดราคา </span>&nbsp; <input type="text" style="width: 108px;"><span>&nbsp; บาท </span> <br><br>
                                                                                    <input type="radio" > <span > &nbsp;ลดราคา </span>&nbsp; <input type="text" style="width: 108px;"><span>&nbsp; % </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card" style="margin-top: 1px;">
                                                                        <div class="card-action">
                                                                            <div class="page-header" style="font-size:18px;margin-top: 0px;">สถานะ</div>


                                                                            <div class="material-switch ">
                                                                                <span style="
                                                                                      margin-left: 33px;
                                                                                      "> สินค้าหมด </span> &nbsp;
                                                                                <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox"/>
                                                                                <label for="someSwitchOptionSuccess" class="label-success"></label>
                                                                                &nbsp; <span>มีสินค้า</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                    <button type="button" class="btn btn-primary">บันทึก</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--End EditMenu Modal-->

                                    <!--AddMenu Modal-->
                                    <div class="modal fade" id="AddMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">เพิ่มรายการใหม่</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row" style="margin: 0px;">
                                                        <div class="card">
                                                            <div class="card-action">
                                                                <div class="page-header" style="font-size:18px;margin-top: 0px;">
                                                                    รูปภาพ
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="col-md-6"> 
                                                                        <div class="thumbnails">
                                                                            <div class="span4">
                                                                                <form>
                                                                                    <div class="thumbnail">
                                                                                            <!-- <input type="file" name="img"> --->
                                                                                        <img src="http://placehold.it/160x100" alt="ALT NAME">
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6" style="margin-top: 60px;"> 
                                                                        <p align="center">
                                                                            <button type="button" name="img" value="อัพโหลด" onClick="upload.click()" onMouseOut="uploadtext.value = upload.value" class="btn btn-primary btn-block" style="font-style:normal">
                                                                                เลือกรูป
                                                                            </button>
                                                                        </p>
                                                                        <!-- Upload Function-->   
                                                                                </form>
                                                                        <form action="uploadfile.php" method="post" enctype="multipart/form-data" target="ifrm">
                                                                            <input type="file" name="upload" style="display:none" />
                                                                            <input type="button" name="uploadbutton" value="choose file" onclick="upload.click()" onmouseout="uploadtext.value = upload.value" style="display:none"/>
                                                                        </form>

                                                                        <iframe name="ifrm" style="display:none;">
                                                                        </iframe>

                                                                        <div class="progress">
                                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                                                                100%
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin:15px -15px;">
                                                            <div class="col-md-12">
                                                                <div class="card" style="margin-top: 1px;">
                                                                    <div class="card-action">
                                                                        <div class="page-header" style="font-size:18px;margin-top: 0px;">
                                                                            ทั่วไป
                                                                        </div>
                                                                        <form>
                                                                            <div class="row" style="margin:10px 0 0 5px;">
                                                                                <span style="margin-left: 24px;"> ชื่ออาหาร </span> &nbsp;<input type="text">
                                                                                <span style="margin-left: 25px;"> ราคาอาหาร </span> &nbsp;<input type="text">&nbsp; บาท 
                                                                            </div>
                                                                            <div class="row" style="margin:10px 0 0 30px;">
                                                                                <span> หมวดหมู่ </span>&nbsp;
                                                                                <select style="width: 150px;">
                                                                                    <option>--ตัวเลือก--</option>
                                                                                    <option>ชนิดข้าว</option>
                                                                                    <option>กับข้าว</option>
                                                                                    <option>อาหารจานด่วน</option>
                                                                                    <option>เครื่องดื่ม</option>
                                                                                </select>
                                                                                <span style="margin-left: 25px;"> หมวดหมู่ </span>&nbsp;&nbsp;
                                                                                <select style="width: 150px;  margin-left: 5px;">
                                                                                    <option>--ตัวเลือก--</option>
                                                                                    <option>อาหารไทย</option>
                                                                                    <option>อาหารฝรั่ง</option>
                                                                                    <option>อาหารญี่ปุ่น</option>
                                                                                    <option>อาหารเหนือ</option>
                                                                                    <option>อาหารอีสาน</option>
                                                                                    <option>อาหารใต้</option>
                                                                                    <option>อาหารเจ</option>
                                                                                    <option>อาหารมังสวิรัติ</option>
                                                                                </select>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <form action="#" method="#">
                                                                <div class="col-md-6">
                                                                    <div class="card" style="margin-top: 1px;">
                                                                        <div class="card-action">
                                                                            <div class="page-header"style="font-size:18px;margin-top: 0px;">โปรโมชั่น</div>
                                                                            <div class="material-switch">
                                                                                <span style="margin-left: 28px;"> ปิดใช้งาน </span> &nbsp;
                                                                                <input id="someSwitchOptionSuccess2" name="someSwitchOption001" type="checkbox"/>
                                                                                <label for="someSwitchOptionSuccess2" class="label-success"></label>
                                                                                &nbsp; <span>เปิดใช้งาน</span> <br> <br>
                                                                                <div class="radio" style="margin-left: 23px;">
                                                                                    <input type="radio" > <span > &nbsp;ลดราคา </span>&nbsp; <input type="text" style="width: 108px;"><span>&nbsp; บาท </span> <br><br>
                                                                                    <input type="radio" > <span > &nbsp;ลดราคา </span>&nbsp; <input type="text" style="width: 108px;"><span>&nbsp; % </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card" style="margin-top: 1px;">
                                                                        <div class="card-action">
                                                                            <div class="page-header" style="font-size:18px;margin-top: 0px;">สถานะ</div>


                                                                            <div class="material-switch ">
                                                                                <span style="
                                                                                      margin-left: 33px;
                                                                                      "> สินค้าหมด </span> &nbsp;
                                                                                <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox"/>
                                                                                <label for="someSwitchOptionSuccess" class="label-success"></label>
                                                                                &nbsp; <span>มีสินค้า</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                    <button type="button" class="btn btn-primary">บันทึก</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End AddMenu Modal-->
                                </div>

                                <!-- รายการอาหารที่หมดชั่วคราว -->

                                <div class="tab-pane" id="tab_default_2_4">
                                    <div class="page-header">
                                        <div class="row">
                                            <div class="col-md-6"><h2>รายการอาหารที่หมดชั่วคราว</h2></div>
                                            <div class="col-md-3"><p class="text-center" style="width: 0px;height: 0px;margin-left: 437px;margin-top: 20px;">
                                                    <a class="btn icon-btn btn-warning" data-toggle="modal" data-target='#'>
                                                        <span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-warning">
                                                        </span> ลบทิ้ง</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ค้นหา -->
                                    <div class="row">
                                        <!-- Card Projects -->
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <!-- Menu 1 Row -->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card maxheight">
                                                                <div class="card-image">
                                                                    <img src="../assets/images/res_resall/menuedit/FriedEgg.jpg">
                                                                </div>
                                                                <div class="card-content height">
                                                                    <div class="product-name">ไข่ดาว</div>
                                                                    <div class="product-price">7 บาท</div>
                                                                </div>
                                                                <div class="card-action">
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="left: 13px;">
                                                                            <p class="text-center">
                                                                                <a class="btn icon-btn btn-success" data-toggle="modal" data-target='#'>
                                                                                    <span class="glyphicon btn-glyphicon glyphicon-retweet img-circle text-success"> </span> 
                                                                                    เปิดการจำหน่าย
                                                                                </a>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="maxheight">
                                                                    <div class="card-image">
                                                                        <img src="../assets/images/res_resall/menuedit/pork.jpg">
                                                                    </div>
                                                                    <div class="card-content height">
                                                                        <div class="product-name">กระดูกหมูกระเทียมพริกไทย</div>
                                                                        <span class="promotion-discount">70 บาท</span>

                                                                        <span class="promotion-price"> 56 บาท</span>
                                                                        <span class="promotion-percent" style="margin-left:25px"> 20%</span>
                                                                    </div>
                                                                    <div class="card-action">
                                                                        <div class="row">
                                                                            <div class="col-md-3" style="left: 13px;">
                                                                                <p class="text-center">
                                                                                    <a class="btn icon-btn btn-success" data-toggle="modal" data-target='#'>
                                                                                        <span class="glyphicon btn-glyphicon glyphicon-retweet img-circle text-success"> </span>
                                                                                        เปิดการจำหน่าย
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
                                    </div>          
                                </div>
                                <!-- จบแทบ รายการอาหารที่หมดชั่วคราว -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Tab เมนูอาหาร -->


    <!-- start footer -->
    <?php
    show_footer();
    ?>
    <script src="../assets/js/jquery.singlePageNav.min.js"></script>

    <script>
                                                                                $(document).ready(function () {
                                                                                    $(".btn-pref .btn").click(function () {
                                                                                        $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
                                                                                        $(".tab").addClass("active"); // instead of this do the below 
                                                                                        $(this).removeClass("btn-default").addClass("btn-warning");
                                                                                    });
                                                                                });
    </script>


    <!--for old News-->
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

    <script>
        +function ($) {
            'use strict';
            var uploadForm = document.getElementById('js-upload-form');

            var startUpload = function (files) {
                console.log(files)
            }

            uploadForm.addEventListener('submit', function (e) {
                var uploadFiles = document.getElementById('js-upload-files').files;
                e.preventDefault()

                startUpload(uploadFiles)
            })
        }(jQuery);
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
