<?php
session_start();
include '../dbconn.php';
?>
<html>
    <head>
        <title>PixupFood - The Original Food Delivery</title>
        <?php include '../template/customer-title.php'; ?>
        <link rel="stylesheet" href="/assets/css/search_page.css">
        <link rel="stylesheet" href="/assets/css/check-radio.css">
    </head>
    <body>
        <?php $cusid = @$_SESSION["userdata"]["id"] ?>
        <?php include '../template/customer-navbar.php'; ?>
        <!-- start register -->
        <section id="search_page">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <h1>PIXUPFOOD</h1>
                            <h4>Search Food & Restaurant That You Want</h4>
                        </div>
                        <div class="col-md-5" id="searchcri">
                            <div class="row">
                                <div class="col-md-4 searchtitle">
                                    ค้นหาจาก :
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" id="searchby">
                                        <option value="foodname">รายการอาหาร</option>
                                        <option value="rest">ร้านอาหาร</option>
                                        <option value="nearbyfood">ร้านอาหารบริเวณใกล้คุณ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 searchtitle">
                                    ประเภทอาหาร : 
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" id="foodtype">
                                        <option value="all">ทั้งหมด</option>
                                        <?php
                                        $getFoodTypeRes = $con->query("SELECT * FROM food_type");
                                        while ($foodtype = $getFoodTypeRes->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $foodtype["id"] ?>"><?= $foodtype["description"] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 searchtitle">
                                    คีย์เวิร์ด : 
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchtxt"  placeholder="ชื่อร้านอาหาร | ชื่อรายการอาหาร">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" id="searchbtn" type="button">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="search_page_body">
            <div class="container">
                <div class="row">

                    <div class="col-md-12" style="margin-top: 20px;">
                        <!--div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                  <h2>ผลการค้นหา</h2> 
                            </div>
                        </div>-->
                    </div>
                    <div class="col-md-3">
                        <div class = "card" style="margin-top: 30px">
                            <div class="card-content">
                                <div class="page-header" style="color: #FF9900">
                                    <i class="fa fa-filter"></i>&nbsp;ตัวเลือกเพิ่มเติม
                                </div>
                                <label class="Form-label--tick">
                                    <input type="checkbox" name="searchOption" value="orderFromMenu" class=" Form-label-checkbox">
                                    <span class="Form-label-text" style="font-size: 22px">&nbsp;<b style="color: #FF5F00">Pixup<span style="color: black">Fast</span></b> </span>
                                </label>
                            </div>
                        </div>
                        <div >
                            <div class = "card" style="margin-top: 30px">
                                <div class="card-content">
                                    <h4><i class="fa fa-question-circle" ></i>&nbsp;ฟังก์ชัน <b style="color: #FF5F00">Pixup<span style="color: black">Fast</span></b>  คืออะไร?</h4>
                                    <hr>
                                    <span style="font-size: 16px">
                                        &nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #FF5F00">Pixup<span style="color: black">Fast</span></b> คือ ตัวช่วยของคุณที่จะทำให้การสั่งอาหารง่ายขึ้น 
                                        มีอาหารต่างๆ ให้เลือกมากมาย คุณไม่จำเป็นต้องรู้จักร้านค้า เพราะระบบจะเลือกให้คุณ!  &nbsp;&nbsp;พร้อมแสดงข้อมูลและราคา ให้คุณตัดสินใจได้ง่ายขึ้น <br>
                                          &nbsp;&nbsp;&nbsp;&nbsp;ยิ่งไปกว่านั้น คุณสามารถส่งคำสั่งซื้อได้  พร้อมกันมากถึง 3 ร้านค้า ภายในเวลา 15 นาที
                                          ร้านค้าใดที่ตอบรับรายการเร็วที่สุดจะเป็นผู้ประกอบอาหารสุดพิเศษให้คุณ
                                         <i class="fa fa-smile-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9" style="padding-left:0px; ">
                        <h2>ผลการค้นหาคำว่า: &nbsp;<span id="showsearchtext"  style="color: #FF9F00"><?= @$_GET["search"] ?></span></h2>
                        <div class="content2" style="padding-bottom:15px">
                            <div class="fresh-table" style="font-family: 'supermarketregular';">
                                <table id="fresh-table" class="table">
                                    <thead style="background-color: #FF9F00; color: white">
                                    <th data-field="picture"  style="width: 180px">รูปภาพ</th>
                                    <th data-field="rfname"  data-sortable="true" style="width: 300px">ชื่อร้านอาหาร/ชื่อรายการอาหาร</th>
                                    <th data-field="addetail"  data-sortable="true" >รายละเอียด</th>
                                    <th></th>
                                    </thead>

                                    <tbody id="result">
                                        <?php
                                        $search = $con->real_escape_string(@$_GET["search"]);
                                        $numrow = 0;
                                        if ($search != "") {
                                            $res = $con->query("SELECT DISTINCT restaurant.id,restaurant.name, menu.img_path, main_menu.name as menuname,"
                                                    . " food_type.description as foodtype, restaurant.name as resname, menu.id as menuid, menu.price,"
                                                    . "main_menu.img_path as img "
                                                    . "FROM menu "
                                                    . "LEFT JOIN restaurant ON menu.restaurant_id = restaurant.id "
                                                    . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                    . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                    . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                    . "WHERE main_menu.name LIKE '%$search%' "
                                                    . " AND restaurant.block = 0  "
                                                    . "order by main_menu.name ");
                                            echo $con->error;
                                            $numrow = $res->num_rows;
                                        } else {
                                            $res = $con->query("SELECT DISTINCT restaurant.id,restaurant.name, menu.img_path, main_menu.name as menuname,"
                                                    . " food_type.description as foodtype, restaurant.name as resname, menu.id as menuid, menu.price,"
                                                    . "main_menu.img_path as img "
                                                    . "FROM menu "
                                                    . "LEFT JOIN restaurant ON menu.restaurant_id = restaurant.id "
                                                    . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                    . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                    . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                    . "WHERE main_menu.name LIKE '%' "
                                                    . "AND restaurant.block = 0  "
                                                    . "order by main_menu.name ");
                                            echo $con->error;
                                            $numrow = $res->num_rows;
                                        }
                                        if ($numrow == 0) {
                                            ?>
                                            <tr><td colspan="3" style="text-align: center;"><h2>No Result !</h2></td></tr>
                                            <?php
                                        }
                                        while ($data = $res->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <a class="" href="#">
                                                        <img 
                                                            src="<?= ($data["img_path"] == "" ? $data["img"] : $data["img_path"]) ?>"
                                                            style="max-width: 150px; max-height:90px;">
                                                    </a>
                                                </td>
                                                <td>
                                                    <h4 class="media-heading"><?= $data["name"] ?> / <?= $data["menuname"] ?></h4><br>
                                                    <!-- ($data["menu_name"] != "" ? '&nbsp;/&nbsp;' . $data["menu_name"] : '')  -->

                                                </td>
                                                <td>
                                                    <p style="font-size: 20px"><?= $data["price"] ?>&nbsp;บาท<br></p>
                                                </td>
                                                <td style="padding-left: 50px">
                                                    <a href="/view/cus_restaurant_view.php?menuId=<?= $data["menuid"] ?>&resId=<?= $data["id"] ?>" <?= (isset($_SESSION["islogin"])) ? "" : "onclick=\"return false;\"" ?>>
                                                        <span class="tooltip-r"<?= (isset($_SESSION["islogin"])) ? "" : " data-toggle=\"tooltip\" " ?>data-placement="top" title="log in to ordet this restaurant">
                                                            <button class="btn btn-success menu_order" id="menu_order<?= $data["menuid"] ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp; สั่งรายการอาหารนี้</button>
                                                        </span>
                                                    </a>
                                                    <span class="pull-right">
                                                        <?php
                                                        if (isset($_SESSION["islogin"])) {
                                                            $menuid = $data["menuid"];
                                                            $favRes = $con->query("SELECT * FROM `favorite_menu` WHERE  customer_id = '$cusid' and menu_id ='$menuid' ");
                                                            if ($favRes->num_rows > 0) {
                                                                while ($favData = $favRes->fetch_assoc()) {
                                                                    ?>
                                                                    <button class="btn favmenu btn-default  " >
                                                                        <i class="glyphicon glyphicon-heart faved"  data-menuid="<?= $data["menuid"] ?>" data-favid="<?= $favData["id"] ?>" data-faved="1" ></i>&nbsp;<span class="faved"> ชื่นชอบ</span>
                                                                    </button>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <button class="btn favmenu btn-default">
                                                                    <i class="glyphicon glyphicon-heart unfav"  data-menuid="<?= $data["menuid"] ?>" data-favid="" data-faved="0"  ></i>&nbsp;<span class="unfav"> ชื่นชอบ</span>
                                                                </button>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <button class="btn favunlogin btn-default" class="tooltip-r " data-toggle="tooltip" data-placement="top" title="log in to favorite this menu" data-menuid="<?= $data["menuid"] ?>" data-favid="" data-faved="0"  >
                                                                <i class="glyphicon glyphicon-heart  unfav" ></i>&nbsp;<span class="unfav"> ชื่นชอบ</span>
                                                            </button>
                                                        <?php } ?>
                                                    </span>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="map" style="display: none"></div>
        <div class="page_up" style="text-align: center;">
            <a href="#search_page_body" style="color: #FF9F00;" id="backtop">
                <img src="/assets/images/top.png">
               <!-- <i class="glyphicon glyphicon-arrow-up"></i>
                <h4 >Back to top</h4>-->
            </a>
        </div>

        <!-- end register -->
        <?php include '../template/footer.php'; ?>
        <script src="/assets/js/search-page.js"></script>
    </body>
</html>