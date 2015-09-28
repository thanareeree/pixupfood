<?php
include '../dbconn.php';

$searchtxt = @$_POST["searchname"];

$resid = @$_POST["resid"];

$numrow = 0;
if ($searchtxt != "") {
    $res = $con->query("SELECT main_menu.id, main_menu.name as menuname "
            . "FROM main_menu where main_menu.name like '%$searchtxt%'");
    $numrow = $res->num_rows;
}
if ($numrow == 0) {
    ?>
    <div class="col-md-3">
        <h3>ไม่พบเมนูนี้ </h3>
    </div>
    <?php
} else {
    while ($data2 = $res->fetch_assoc()) {
        ?>
        <div class="col-md-2">
            <div class="thumbnail">
                <div class="caption">
                    <h4><?= $data2["menuname"] ?></h4>
                    <p style="text-align: right" class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" id="priceMenu" style="font-size: 18px;" placeholder="ราคา" required="">
                        <span class="input-group-btn">
                            <button class="btn btn-default" id="addMenu<?= $data2["id"] ?>" class="addMenu" type="button">Go!</button>
                        </span>
                    </div><!-- /input-group -->

                    </p>
                </div>
            </div>
        </div>
        <!--------------------------------------->
        <!-- ค้นหาเมนูมาแอดเมนู -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="col-md-12" style="margin-bottom: 50px">
                        <h2>ค้นหา</h2>
                        <form action="#" method="post" >
                            <input type="hidden" name="" id="resid" value="<?= $resid; ?>" >
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" id="searchNewMenu" placeholder="ชื่อรายการอาหารที่ท่านต้องการจะเพิ่มข้อมูล">
                                    <span class="input-group-btn ">
                                        <button class="btn btn-default input-lg" type="button" id="searchAddBtn"><i class="glyphicon glyphicon-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Menu 1 Row -->
                    <div class="row" id="showdatamenu">


                    </div>
                </div>
            </div>
        </div>

        <!-- จบค้นหา -->
        <?php
    }
}