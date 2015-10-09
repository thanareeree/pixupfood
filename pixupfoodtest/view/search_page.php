<?php
session_start();
include '../dbconn.php';
?>
<html>
    <head>
        <title>PixupFood - The Original Food Delivery</title>
        <?php include '../template/customer-title.php'; ?>
        <link rel="stylesheet" href="/assets/css/search_page.css">
        <style>
            .searchTitle__content {
                width: 100%;
                background-color: #fff;
                border-bottom: solid 1px #f2f2f2;
                display: table;
                table-layout: fixed;
                padding-top: 29px;
            }
        </style>
    </head>
    <body>
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
                        <div class="col-md-10" style="padding-left:0px;">
                            <h3>Order Options</h3>
                            <form>
                                <div class="form-group">
                                    <input  type="checkbox" name="searchOption" value="orderFromMenu">&nbsp;&nbsp;<span style="font-size: 18px">สั่งอาหารจากรายการอาหาร</span><br>

                                </div>
                            </form>
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
                                                    . "AND restaurant.close = 0 AND restaurant.block = 0  "
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
                                                    <h4 class="media-heading "><?= $data["name"] ?> / <?= $data["menuname"] ?></h4><br>
                                                    <!-- ($data["menu_name"] != "" ? '&nbsp;/&nbsp;' . $data["menu_name"] : '')  -->

                                                </td>
                                                <td>
                                                    <p style="font-size: 20px"><?= $data["price"] ?>&nbsp;บาท<br></p>
                                                </td>
                                                <td style="padding-left: 50px">
                                                    <a href="/view/cus_restaurant_view.php?menuId=<?= $data["menuid"] ?>&resId=<?= $data["id"] ?>">
                                                        <span class="tooltip-r " data-toggle="tooltip" data-placement="top" title="log in to ordet this restaurant">
                                                            <button class="btn btn-success menu_order " id="menu_order<?= $data["menuid"] ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp; สั่งรายการอาหารนี้</button>
                                                        </span>
                                                    </a>
                                                    <span class="pull-right">
                                                        <button class="btn lovelovebtn"  id="lovelove<?= $data["menuid"] ?>"><i class="glyphicon glyphicon-heart" style="color: red;"></i>&nbsp;<span style="color: black;"> ชื่นชอบ</span></button>
                                                        <button class="btn btn-danger unlovebtn"  id="lovelove2<?= $data["menuid"] ?>" style="display: none;"><i class="glyphicon glyphicon-heart"></i>&nbsp; ชื่นชอบ</button>
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
        <div style="margin-bottom: 80px; margin-top: 40px;margin-left: 300px; text-align: center;">
            <a href="#search_page" style="color: #FF9F00; display: none" id="backtop">
                <i class="glyphicon glyphicon-arrow-up"></i>
                <h4 >Back to top</h4>
            </a>
        </div>
        <!-- end register -->
        <?php include '../template/footer.php'; ?>
        <?php
        if (isset($_SESSION["islogin"])) {
            ?>
            <script>
                $('.tooltip-r').removeAttr("title");
            </script>
            <?php
        } else {
            ?>
            <script>

                $('a').click(function (e) {
                    e.preventDefault()
                });
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
            <?php
        }
        ?>
        <script>
            $(document).ready(function () {

                var lat = "";
                var long = "";

                function startMap() {

                    map = new google.maps.Map(document.getElementById("map"));
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(getPosition);
                        //navigator.geolocation.watchPosition(updatePosition);
                    } else {
                        lat = "";
                        long = "";
                    }
                }
                startMap();

                function getPosition(pos) {
                    globalPosition = pos;
                    lat = pos.coords.latitude;
                    long = pos.coords.longitude;
                    // alert($("#latinput").val() + "\n" + $("#longinput").val());
                    console.log(pos);

                }


                $("#searchby").on("change", function (e) {
                    var searchby = $(this).val();
                    if (searchby == "foodname") {
                        $("#foodtype").val("all");
                        $("#foodtype").removeAttr("disabled");
                    } else {
                        $("#foodtype").val(0);
                        $("#foodtype").attr("disabled", "disabled");
                    }
                });

                $("#searchtxt").on("keyup", function (e) {
                    if (e.keyCode == 13) {
                        $("#searchbtn").click();
                    }
                });
                $("input[type=checkbox]").removeAttr("checked");

                $("#searchbtn").on("click", function (e) {
                    $("#result").html('<tr><td colspan="3" style="text-align: center;"><h2>Searching...</h2></td></tr>');
                    var searchby = $("#searchby").val();
                    var foodtype = $("#foodtype").val();
                    var searchtxt = $("#searchtxt").val();
                    $("input[type=checkbox]").removeAttr("checked");
                    $.ajax({
                        url: "/customer/ajax_search.php",
                        type: 'POST',
                        dataType: 'html',
                        data: {"searchby": searchby, "foodtype": foodtype, "searchtxt": searchtxt, "lat": lat, "long": long},
                        success: function (data, textStatus, jqXHR) {
                            $("#showsearchtext").html(searchtxt);
                            $("#result").html(data);
                            $('[data-toggle="tooltip"]').tooltip();

                        }
                    });
                });


                $("input[type=checkbox]").on("click", function (e) {
                    $("#result").html('<tr><td colspan="3" style="text-align: center;"><h2>Searching...</h2></td></tr>');
                    var searchoption = $("input:checked").val();
                    $.ajax({
                        url: "/customer/ajax_search_option.php",
                        type: 'POST',
                        dataType: 'html',
                        data: {"searchoption": searchoption},
                        success: function (data, textStatus, jqXHR) {
                            $("#result").html(data);
                            $('[data-toggle="tooltip"]').tooltip();

                        }
                    });
                });



            });
        </script>
        <script>
            $(document).ready(function () {
                $("#lovelove").click(function () {
                    $("#lovelove2").show();
                    $("#lovelove").hide();
                });
                $("#lovelove2").click(function () {
                    $("#lovelove").show();
                    $("#lovelove2").hide();
                });
            });

            $("#result").on("click", ".lovelovebtn", function (e) {
                var loveid = $(this).attr("id");
                var id = loveid.replace("lovelove", "");
                
                $.ajax({
                        url: "/customer/cus_favmenu.php",
                        type: "POST",
                        data: {"id": $("#showblockedid").html()},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "ok") {
                                $("#blockedmodal").modal("hide");
                                //fetchdataShowall();
                                document.location.reload();
                            } else {
                                alert("error");
                            }
                        }
                    });
            });
            
        </script>
    </body>
</html>