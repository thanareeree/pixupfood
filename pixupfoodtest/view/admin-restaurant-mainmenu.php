<?php
include '../admin/islogin.php';
include '../template/navbar-admin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <?php addlink("Restaurant Management"); ?>
        <link rel="stylesheet" href="/assets/css/datatables.css">
        <link rel="stylesheet" href="/assets/css/res_restaurant_manage.css">
         <style>
            .card .card-image img {
                border-radius: 2px 2px 0 0;
                background-clip: padding-box;
                z-index: -1;
                width: 100%;
                max-width: 100%;
                height: 156px;
            }
            div.sidetip {
                position: absolute;
                left: 300;
                width: 300px;
                display: table;
                min-height: 32px;
                margin-top: -30;
                    margin-left: 150;
            }


        </style>
    </head>
    <body>
        <?php navAdminAfterLogin(); ?>
        <div class="container">

            <div class="toolbar">
                <h3>Edit Images of Main Menu</h3> 
                <a class="btn icon-btn btn-success" id="addbtn" style=" margin-left: 1015;margin-top: -30; margin-bottom: 15;">
                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success">
                    </span> เพิ่มเมนูอาหารหลัก
                </a>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin: 20px">
                    <div id="addNewMenuForm" style="display: none" >

                        <!-- Card Projects -->
                        <div class="col-md-12" style="margin-bottom: 50px">

                            <div class="card">
                                <div class="card-content"> 
                                    <h3 style="margin-bottom: 20px">เพิ่มเมนูอาหารหลัก</h3>
                                    <hr>
                                    <form action="/admin/add-main-menu.php" method="post" id="addMenuRes" enctype="multipart/form-data">

                                        <div class="row" style="margin-left: 140px;margin-right: 140px">
                                            <h3> ระบุรายละเอียด </h3>
                                            <hr>

                                            <div class="row" style="margin-left: 25px;margin-top: 50px; margin-top: 20px;">
                                                <span style="font-size: 18px;"> หมวดหมู่ </span>&nbsp;
                                                <select required="" style="width: 150px;font-size: 18px;" id="typefood-add" name="typefood-add">
                                                    <option value="0">--ตัวเลือก--</option>
                                                    <option value="ชนิดข้าว">ชนิดข้าว</option>
                                                    <option value="กับข้าว">กับข้าว</option>
                                                    <option value="อาหารจานเดียว">อาหารจานเดียว</option>
                                                    <option value="ขนม">ขนม</option>
                                                    <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                                                </select>
                                            </div>
                                            <div class="row" style="margin-left: 25px;margin-top: 50px; margin-top: 20px;">

                                                <span style="font-size: 18px;" id="typeselect" > หมวดหมู่ </span>&nbsp;
                                                <select class="foodtypelist" name="foodtypelist" required="" style="width: 150px;  font-size: 18px">
                                                    <option>--ตัวเลือก--</option>
                                                    <?php
                                                    $res1 = $con->query("SELECT * FROM `food_type`");
                                                    while ($data1 = $res1->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?= $data1['id'] ?>"> <?= $data1['description'] ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="row" style="margin-left: 25px;margin-top: 50px; margin-top: 20px;">

                                                <span style="font-size: 18px;"> ชื่อ </span> 
                                                &nbsp;<input type="text" style="font-size: 18px;" id="foodname" name="foodname"  required="" placeholder="ระบุชื่ออาหาร">
                                                <div class="sidetip errorMainmenuDuplicate" style="display: none" >
                                                    <p style="color: red"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;ชื่ออาหารซ้ำ</p>
                                                </div>
                                            </div>
                                            <h3> เลือกรูปภาพอาหาร </h3>
                                            <hr>
                                            <div id="updateImg" style="margin-bottom: 45;" >
                                                <input type="file" id="imagerest" name="imagerest"  accept="image/jpeg,image/pjpeg,image/png" required="" />

                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <div class="col-md-10"> </div>
                                            <div class="col-md-2" style="padding-right: 0px;padding-left: 45px;">
                                                <button type="submit" class="btn btn-success" style="margin-left: 25px;width: 100;" id="addNewMenubtn"><i class="glyphicon glyphicon-plus"></i></button>
                                                <span style="color: red" id="showerror"></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fresh-table">
                        <table id="restDataTable" class="table table-striped table-bordered">
                            <thead style="background-color: #FF9F00">
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="resname"  data-sortable="true">Menu Name</th>
                            <th data-field="img" data-sortable="true" >Image</th>
                            <th data-field="img" data-sortable="true" >Upload New Image</th>
                           <!--<th data-field="actions" >Actions</th>-->
                            </thead>
                            <tbody id="showdata">
                                <?php
                                $res1 = $con->query("SELECT * FROM `main_menu` ");
                                while ($data1 = $res1->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $data1["id"] ?></td>
                                        <td><?= $data1["name"] ?></td>
                                        <td class="text-center"><img src="<?= $data1["img_path"] ?>" style="max-height: 150px;max-width: 150px"></td>
                                        <td style="width: 300px" class="text-right">
                                            <div >
                                                <form action="/admin/edit-image-mainmenu.php?id=<?= $data1["id"] ?>" method="post" enctype="multipart/form-data">

                                                    <input type="file" id="imagerest" class="imagerest" required="" name="imagerest"  accept="image/jpeg,image/pjpeg,image/png"  />
                                                    <button class="btn btn-primary uploadBtn text-right" style="margin-top: 50px" type="submit" id="uploadBtn<?= $data1["id"] ?>">
                                                        <span style="font-family: 'supermarketregular'"><i  class="glyphicon glyphicon-upload"></i>&nbsp;อัพโหลดรูปภาพ</span>
                                                    </button>
                                                    <!--</form>--> 
                                                </form>
                                            </div>
                                        </td>
                                        <!--<td class="text-center">
                                           
                                            <button class="btn btn-danger deletebtn"  id="delete<?= $data1["id"] ?>">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </td>-->
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

        <script src="/assets/js/jquery-2.1.4.min.js"></script>
        <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/js/bootstrap-table.js"></script>
        <script src="/assets/js/dataTables.js"></script>
        <script>
            var table = $('#restDataTable').DataTable({
            });
        </script>
        <script>
            $(document).ready(function () {
                $("#addbtn").on("click", function (e) {
                    $("#addNewMenuForm").show();
                });
                $("#typefood-add").on("change", function (e) {
                    if ($("#typefood-add").val() == "ชนิดข้าว" || $("#typefood-add").val() == "ขนม" || $("#typefood-add").val() == "เครื่องดื่ม") {
                        $("#typeselect").hide();
                        $(".foodtypelist").hide();
                    } else {
                        $("#typeselect").show();
                        $(".foodtypelist").show();
                    }
                });
                $("#foodname").keyup(function (e) {
                    var name = $(this).val();
                    $.ajax({
                        url: "/restaurant/check-mainmenuname.php",
                        type: "POST",
                        dataType: "json",
                        data: {"foodname": name},
                        success: function (data) {
                            if (data.result == 1) {
                                $("#addNewMenubtn").attr("disabled", "disabled");
                                $(".errorMainmenuDuplicate").show();
                            } else {
                                $("#addNewMenubtn").removeAttr("disabled");
                                $(".errorMainmenuDuplicate").hide();
                            }
                        }
                    });
                });
                $("#foodname").blur(function (e) {
                    var name = $(this).val();
                    $.ajax({
                        url: "/restaurant/check-mainmenuname.php",
                        type: "POST",
                        dataType: "json",
                        data: {"foodname": name},
                        success: function (data) {
                            if (data.result == 1) {
                                $("#addNewMenubtn").attr("disabled", "disabled");
                                $(".errorMainmenuDuplicate").show();
                            } else {
                                $("#addNewMenubtn").removeAttr("disabled");
                                $(".errorMainmenuDuplicate").hide();
                            }
                        }
                    });
                });
            });
        </script>



    </body>
</html>
