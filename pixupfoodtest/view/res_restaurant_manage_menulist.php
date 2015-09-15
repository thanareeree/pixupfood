<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant Menu Management</title>

        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/res_restaurant_manage.css">

    </head>
    <body>

        <?php include '../template/restaurant-navbar.php'; ?>

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
                    <button type="button" id="menulist" class="btn btn-warning" >
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


    <!-- รายการอาหาร -->
    <div class="tab-pane fade in" id="tab4">
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1_4" data-toggle="tab">รายการอาหารปัจจุบัน </a>  
                                </li>
                                <li>
                                    <a href="#tab_default_2_4" data-toggle="tab">รายการอาหารที่หมดชั่วคราว </a>
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
                                                        </span> เพิ่มใหม่</a>
                                                </p>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="text-center pull-left" style="margin-top: 20px;">
                                                    <a class="btn icon-btn btn-warning" data-toggle="modal" data-target='#'>
                                                        <span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-warning">
                                                        </span> ลบทิ้ง</a>
                                                </p>
                                            </div>
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
    <?php include '../template/footer.php'; ?>
    <script>
    
    </script>   
</body>
</html>
