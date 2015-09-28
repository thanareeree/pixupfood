<?php
$resid = $_SESSION["restdata"]["id"];
$res2 = $con->query("SELECT DISTINCT restaurant.id,menu.img_path, menu.price, menu.id as menuResId, menu.status, "
        . "main_menu.name as menuname, restaurant.name as resname "
        . "FROM restaurant "
        . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
        . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
        . "left JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
        . "left JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
        . "WHERE restaurant.id = '$resid' and main_menu.type = 'กับข้าว'");

while ($data2 = $res2->fetch_assoc()) {
    ?>
    <div class="col-md-3">
        <div class="card">
            <div class="maxheight">
                <div class="card-image">
                    <img src="<?= ($data2["img_path"] == "") ? '/assets/images/default-img360.png' : $data2["img_path"] ?>" >
                </div>
                <div class="card-content height">
                    <div class="product-name"><?= $data2["menuname"] ?></div>
                    <div class="product-price"><?= $data2["price"] ?>&nbsp;บาท</div>
                </div>

                <div class="card-action" style="margin-top: -10px">
                    <div class="row col-md-12" >
                        <div class="col-md-3 pull-left">
                            <p class="text-center">
                                <a class="btn icon-btn btn-primary editmenubtn" id="editbtn<?= $data2["menuResId"] ?>" data-toggle="modal" data-target='#EditMenu<?= $data2["menuResId"] ?>'>
                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-warning">
                                    </span> แก้ไข</a></p>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-3 pull-left">
                            <p class="text-center">
                                <a class="btn icon-btn btn-danger deletemenubtn" id="deletebtn<?= $data2["menuResId"] ?>" data-toggle="modal" data-target='#'>
                                    <span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-warning">
                                    </span> ลบทิ้ง</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal แก้ไขเมนู ------------------------------------------------------------------------------>
    <!--EditMenu Modal-->
    <div class="modal fade" id="EditMenu<?= $data2["menuResId"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/restaurant/menu-edit-image.php" method="post" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
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
                                                    <div class="thumbnail">
                                                            <!-- <input type="file" name="img"> --->
                                                        <img src="<?= ($data2["img_path"] == "") ? '/assets/images/default-img360.png' : $data2["img_path"] ?>" alt="ALT NAME">
                                                    </div>                                                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="margin-top: 60px;"> 
                                            <p align="center"><button type="button" name="img" value="อัพโหลด" onClick="upload.click()" onMouseOut="uploadtext.value = upload.value" class="btn btn-primary btn-block" style="font-style:normal">เลือกรูป</button></p>

                                            <input type="file" name="upload" style="display:none" />
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
                                            <div class="row" style="margin:10px 0 0 5px;">
                                                <span style="margin-left: 25px;"> ราคาอาหาร </span> &nbsp;<input type="text" name="newPrice" value="<?= $data2["price"]?>">&nbsp; บาท 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="card" style="margin-top: 1px;">
                                        <div class="card-action">
                                            <div class="page-header" style="font-size:18px;margin-top: 0px;">สถานะ</div>


                                            <div class="material-switch ">
                                                <span style="margin-left: 33px;"> มีสินค้า </span> &nbsp;
                                                <input id="closeMenu" name="closeMenu[]" type="checkbox" value="<?= $data2["status"]?>"  <?= ($data2["status"]=='1'? 'checked':'')?>/>
                                                <label for="closeMenu" class="label-success"></label>
                                                &nbsp; <span>สินค้าหมด</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>