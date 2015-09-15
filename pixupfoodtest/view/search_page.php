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
        <link rel="stylesheet" href="../assets/css/search_page.css">



    </head>
    <body>
        <?php include '../template/customer-navbar.php'; ?>

        <!-- start register -->
        <section id="search_page">
            <div class="overlay">
                <div class="container text-center">
                    <h1>PIXUPFOOD</h1>
                    <h4>Search Food & Restaurant That You Want</h4>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div id="custom-search-input">
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control input-lg" placeholder="Search.." />
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-lg" type="button">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="search_page_body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h2>Fillter</h2>
                        <div class="col-md-12" style="padding-left:0px;">
                            <select class="form-control prolist" id="plan">
                                <option value="Type">ประเภทอาหาร</option>
                                <option value="North">อาหารเหนือ</option>
                                <option value="EastNorth">อาหารอีสาน</option>
                                <option value="South">อาหารใต้</option>
                                <option value="Carte">อาหารตามสั่งทั่วไป</option>
                                <option value="Dessert">ขนมหวาน</option>
                                <option value="Bakery">เบเกอรี่</option>
                            </select>
                        </div>
                        <div class="col-md-12" style="padding-left:0px;">
                            <h3>Restaurant Options</h3>
                            <form action="">
                                <input type="checkbox" name="sex" value="male">&nbsp;สั่งอาหารมากกว่า 100 ชุด<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;สั่งอาหารล่วงหน้ามากกว่า 1 วัน<br>
                                <input type="checkbox" name="sex" value="male">&nbsp;มีรายการโปรโมชัน<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;รับชำระสินค้าออนไลน์<br>
                                <input type="checkbox" name="sex" value="male">&nbsp;ร้านที่เปิดให้บริการ<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;มีบริการด่วนพิเศษ
                            </form>
                        </div>
                        <div class="col-md-12" style="padding-left:0px;">
                            <h3>Food Types</h3>
                            <form action="">
                                <input type="checkbox" name="sex" value="male">&nbsp;อาหารตามสั่ง<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;อาหารจัดเซ็ต(Box Set)<br>
                                <input type="checkbox" name="sex" value="male">&nbsp;อาหารว่าง<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;ขนม เครื่องดื่ม และ เบเกอรี่<br>
                                <input type="checkbox" name="sex" value="male">&nbsp;อาหารมังสวิรัติ<br>
                                <input type="checkbox" name="sex" value="female">&nbsp;อาหารฮาลาล
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9">
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
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a class="pull-left" href="#">
                                                        <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                                    </a>
                                                </td>
                                                <td>
                                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                                </td>
                                                <td>
                                                    <p>By Jhon Doe</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a class="pull-left" href="#">
                                                        <img class="media-object" src="http://placehold.it/150x90" alt="...">
                                                    </a>
                                                </td>
                                                <td>
                                                    <h4 class="media-heading">Lorem ipsum dolor asit amet</h4>
                                                </td>
                                                <td>
                                                    <p>By Jhon Doe</p>
                                                </td>
                                            </tr>
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
                alert(loadPageVar("search"));
            });
            function loadPageVar(sVar) {
                return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
            }
        </script>
    </body>
</html>