<?php
session_start();
include '../dbconn.php';
?>

<html >
    <head>
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
                        <div class="row" style="padding:60px 15px 30px 50px;border-top:1px solid #e8e8e8; ">
                            <?php
                            $res = $con->query("select promotion.id, promotion_main.name, restaurant.name as restname, "
                                    . "promotion.start_time, promotion.end_time, promotion.description, promotion_main.img_path  "
                                    . "from promotion "
                                    . "LEFT JOIN promotion_main ON promotion_main.id = promotion.promotion_main_id "
                                    . "LEFT JOIN restaurant ON restaurant.id = promotion.restaurant_id "
                                    . "ORDER BY RAND() DESC ");
                            while ($data = $res->fetch_assoc()) {
                                ?>
                                <div class="col-md-6" >
                                    <ul class="media-list main-list"  style="border-bottom:1px solid #e8e8e8; ">
                                        <li class="media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object" src="<?= $data["img_path"] ?>" alt="..." width="150px" style="max-height:110;">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><?= $data["restname"] ?></h4>
                                                <p class="by-author"><?= $data["description"] ?><br><br>
                                                    เริ่มวันที่: &nbsp;<?= $data["start_time"] ?>&nbsp;
                                                    หมดเขต: &nbsp;<?= $data["end_time"] ?>&nbsp;

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