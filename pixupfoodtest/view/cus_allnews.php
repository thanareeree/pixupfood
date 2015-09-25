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
                        <img src="../assets/images/ads.png" width="100%" style="margin-top: 60px;margin-bottom: 60px">
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6" style="padding:60px 15px 30px 50px">
                                <ul class="media-list main-list">
                                    <li class="media">
                                        <a class="pull-left thumbnails" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news01.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">เมนูใหม่ ต้องลอง!!</h4>
                                            <p class="by-author">เพิ่ม 3 เมนูใหม่กับร้านลมัยโภชนา<br>ผัดพริกแกงทะเล / หมูผัดพริกเผา / ข้าวผัดปลาเค็ม</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news03.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">สปาเก็ตตี้ขี้เมา</h4>
                                            <p class="by-author">สปาเก็ตตี้ผัดขี้เมา รสเด็ด ปรุงสดใหม่ด้วยแม่ครัวมืออาชีพ จาก ร้านหนึ่ง</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news05.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">รับรีวิวอาหาร สำหรับลูกค้าทุกท่าน</h4>
                                            <p class="by-author">รีวิวฟรีกับลูกค้า basic plan ขึ้นไป* <br>free plan ก็รีวิวได้ แต่จะมีค่าบริการในการรีวิว<br>*เงื่อนไขเป็นไปตามที่เว็บไซต์กำหนด </p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news07.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">เลือกผัก และผลไม้ อย่างไร ให้ปลอดภัย</h4>
                                            <p class="by-author">ผักและผลไม้มีให้เลือกมากมาย ขึ้นอยู่กับแหล่งที่ขาย ส่วนใหญ่ผักตามตลาดมักมาจากหลายแหล่ง วิธีหนึ่งที่จะช่วยได้คือ...</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news09.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">ลวกเส้นสปาเก็ตตี้ กี่นาทีถึงพอดี</h4>
                                            <p class="by-author">เส้นสปาเก็ตตี้มีหลายแบบ แต่ละแบบก็ใช้เวลาต่างกันไป สำหรับเส้นสปาเก็ตตี้แบบยาวส่วนใหญ่ใช้เวลาอยู่ที่ประมาณ 8-10นาที ด้วยไฟแรง</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news11.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">มะเขือเทศบำรุงผิว</h4>
                                            <p class="by-author">มะเขือเทศนอกจากจะใช้ปรุงอาหารได้หลากหลาย ยังมีวิตามิน และคุณประโยชน์ช่วงบำรุงผิวได้ด้วย</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6" style="padding:60px 20px 0 10px">
                                <ul class="media-list main-list">
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news02.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">อร่อยแน่ ขอแนะนำ!</h4>
                                            <p class="by-author">ข้าวผัดลูกชิ้น ร้านอาหารไทย</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news04.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">สาขาใหม่ ถนนประชาอุทิศ</h4>
                                            <p class="by-author">เปิดสาขาที่ 3 กับร้านป้าน้อย ขึ้นชื่อเรื่องรสชาติ และความสดใหม่ของอาหาร พบกับเมนูอาหารมากมายหลากหลาย จะตามไปชิม หรือจะสั่งผ่านเว็บไซต์ก็สะดวก</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news06.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">วัตถุดิบคุณภาพ!</h4>
                                            <p class="by-author">ร้านป้าน้อย เลือกใช้วัตถุดิบที่สะอาดและสดใหม่ เพื่อความอร่อยของอาหารและความปลอดภัยของผู้บริโภค</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news08.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">ไข่ทรงเครื่อง</h4>
                                            <p class="by-author">ไข่ เป็นอีกหนึ่งทางเลือก ที่สามารถนำมาทำอาหารเมนูไข่ได้มากมาย ร้านป้าแสวง ขอเสนอ ไข่ทรงเครื่อง เมนูใหม่ที่ทางร้านคิดค้นขึ้น รสชาติเข้มข้น ลองสั่งกันได้เลย! </p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news10.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">พบกันเร็วๆนี้ ลุงลมุนสาขา 9</h4>
                                            <p class="by-author">อร่อยต้องเผื่อแผ่ ลุงลมุนเจ้าของร้านอาหารลุงลมุนได้ขยายสาขาเพิ่มเพื่อรองรับต่อความต้องการของลูกค้า !!ขอบอกอาหารร้านลุงอร่อยมาก</p>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="../assets/images/allnews/news12.jpg" alt="..." width="150px" style="max-height:90px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">ข้าวผัดหลากสี</h4>
                                            <p class="by-author">ข้าวผัดรสชาติเยี่ยม ด้วยวัตถุดิบมากมาย ของร้านเจ๊ฝน ลองสั่งเลย งานนี้ได้ทั้งรสชาติ คุณภาพ และสุขภาพ ในราคาที่ไม่แพงอย่างที่คิด</p>
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