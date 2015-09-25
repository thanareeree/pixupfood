<?php
session_start();
include '../dbconn.php';
?>




<html >
    <head>
        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
       
        <title>PixupFood - Promotion</title>
          <?php include '../template/customer-title.php'; ?>
        <link rel="stylesheet" href="../assets/css/all_promotions.css">
       

    </head>
    <body>
        <?php include '../template/customer-navbar.php'; ?>
        <!-- start register -->
        <section id="all_promotions">
            <div class="overlay">
                <div class="container text-center">
                    <h1>Promotions</h1>
                    <h4>ศูนย์รวมโปรโมชั่นภายใน pixupfood.com</h4>                    
                </div>
            </div>
        </section>

        <section id="all_promotions_body">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <img src="../assets/images/ads.png" width="100%" style="margin-top: 60px;margin-bottom: 60px">
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6" style="padding:60px 15px 30px 50px">
                                <ul class="media-list main-list" style="border-top:1px solid #e8e8e8; padding-top:1.1em">
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allpromo/promo01.jpg"  alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">ลดสนั่นเมือง</h4>
                                            <p class="by-author">ลดสูงสุดถึง 50% วันนี้ - 31 ธันวาคม 2558 ที่ร้านลุงอนันต์<br>เมื่อสั่งอาหารผ่านเว็บไซต์</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allpromo/promo03.jpg"  alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">ไม่มีอีกแล้ว กับโปรโมชั่นสุดพิเศษ!!!</h4>
                                            <p class="by-author">ป้าน้อยใจปล้ำ เมื่อสั่งอาหารผ่านเว็บไซต์ ซื้อ 3 กล่องฟรี 1 กล่อง*<br>*จำกัดกล่องฟรีสูงสุดไม่เกิน 20 กล่อง</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6" style="padding:60px 20px 0 10px">
                                <ul class="media-list main-list" style="border-top:1px solid #e8e8e8; padding-top:1.1em">
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allpromo/promo02.jpg"  alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">ป้าลมัยใจดี!!</h4>
                                            <p class="by-author">ป้าลมัยใจดี ลด 10% ทุกยอดการสั่งซื้อผ่านเว็บไซต์เท่านั้น!!!</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allpromo/promo04.jpg"  alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">ฟรีน้ำกระป๋อง!!</h4>
                                            <p class="by-author">เมื่อมียอดสั่งซื้อกับร้านลุงเอก ผ่านเว็บไซต์ ทุก 100.- รับน้ำอัดลมฟรี 2 กระป๋อง</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end register -->

       <?php include '../template/footer.php'; ?>
        
        <script type="text/javascript">
            var $table = $('#fresh-table'),
                    full_screen = false;

            $().ready(function () {
                $table.bootstrapTable({
                    toolbar: ".toolbar",
                    showRefresh: false,
                    search: true,
                    showToggle: true,
                    showColumns: false,
                    pagination: true,
                    striped: true,
                    pageSize: 12,
                    pageList: [12, 25, 50, 100],
                    formatShowingRows: function (pageFrom, pageTo, totalRows) {
                        //do nothing here, we don't want to show the text "showing x of y from..." 
                    },
                    formatRecordsPerPage: function (pageNumber) {
                        return pageNumber + " rows visible";
                    },
                    icons: {
                        refresh: 'fa fa-refresh',
                        toggle: 'fa fa-th-list',
                        columns: 'fa fa-columns',
                        detailOpen: 'fa fa-plus-circle',
                        detailClose: 'fa fa-minus-circle'
                    }
                });



                $(window).resize(function () {
                    $table.bootstrapTable('resetView');
                });


            });
        </script>
 
    </body>
</html>