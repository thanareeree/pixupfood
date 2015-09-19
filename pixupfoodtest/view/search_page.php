<?php
session_start();
include '../dbconn.php';
?>
<html>
    <head>
        <title>PixupFood - The Original Food Delivery</title>
        <?php include '../template/customer-title.php'; ?>
        <link rel="stylesheet" href="../assets/css/search_page.css">
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
                                    Search By :
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" id="searchby">
                                        <option value="foodname">รายการอาหาร</option>
                                        <option value="rest">ร้านอาหาร</option>
                                        <option value="nearbyfood">ร้านอาหารบริเวณใกล้เคียง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 searchtitle">
                                    Food Type : 
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
                                    Keyword : 
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchtxt" placeholder="Search for...">
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
                    <div class="col-md-12">
                        <h2>Result</h2>
                        <div class="col-md-12" style="padding-left:0px;">
                            <div class="content2" style="padding-bottom:15px">
                                <div class="fresh-table" style="font-family: 'supermarketregular';">
                                    <table id="fresh-table" class="table">
                                        <thead style="background-color: #FF9F00">
                                        <th data-field="picture"  style="width: 180px">Pictures</th>
                                        <th data-field="rfname"  data-sortable="true" style="width: 300px">Restaurants/Foods Name</th>
                                        <th data-field="addetail"  data-sortable="true" >Address/Details</th>
                                        </thead>

                                        <tbody id="result">
                                            <?php
                                            $search = $con->real_escape_string(@$_GET["search"]);
                                            $numrow = 0;
                                            if ($search != "") {
                                                $res = $con->query("SELECT DISTINCT restaurant.id, restaurant.name ,restaurant.address, restaurant.tel ,restaurant.img_path "
                                                        . "FROM restaurant "
                                                        . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                                                        . "WHERE restaurant.name LIKE '%$search%' OR menu.name LIKE '%$search%' ");
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
                                                    <td>
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" 
                                                                 src="<?= ($data["img_path"] == "" ? "../assets/images/default-img150.png" : $data["img_path"]) ?>"
                                                                 style="max-width: 150px;">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <h4 class="media-heading"><?= $data["name"] ?></h4>
                                                    </td>
                                                    <td>
                                                        <p><?= $data["address"] ?><br><?= $data["tel"] ?></p>
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
            </div>
        </section>
        <!-- end register -->
        <?php include '../template/footer.php'; ?>
        <script>
            $(document).ready(function () {
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

                $("#searchbtn").on("click", function (e) {
                    $("#result").html('<tr><td colspan="3" style="text-align: center;"><h2>Searching...</h2></td></tr>');
                    var searchby = $("#searchby").val();
                    var foodtype = $("#foodtype").val();
                    var searchtxt = $("#searchtxt").val();
                    $.ajax({
                        url: "../customer/ajax_search.php",
                        type: 'POST',
                        dataType: 'html',
                        data: {"searchby":searchby, "foodtype":foodtype,"searchtxt":searchtxt},
                        success: function (data, textStatus, jqXHR) {
                            $("#result").html(data);
                        }
                    });
                });


            });
        </script>
    </body>
</html>