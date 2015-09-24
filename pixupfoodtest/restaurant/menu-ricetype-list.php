<?php
$res2 = $con->query("SELECT DISTINCT main_menu.name, menu.price, menu.img_path   "
        . "FROM `menu` LEFT JOIN main_menu on main_menu.id = menu.main_menu_id "
        . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
        . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
        . "WHERE main_menu.type = 'ชนิดข้าว'");
while ($data2 = $res2->fetch_assoc()) {
    ?>
    <div class="col-md-3">
        <div class="card">
            <div class="maxheight">
                <div class="card-image" >
                    <img src="<?= ($data2["img_path"] == "") ? '/assets/images/default-img360.png' : $data2["img_path"] ?>" >
                </div>
                <div class="card-content height">
                    <div class="product-name"><?= $data2["name"] ?></div>
                    <div class="product-price"><?= $data2["price"] ?>&nbsp;บาท</div>
                </div>

                <div class="card-action" style="margin-top: -10px">
                    <div class="row col-md-12" >
                        <div class="col-md-3 pull-left">
                            <p class="text-center">
                                <a class="btn icon-btn btn-primary" data-toggle="modal" data-target='#EditMenu'>
                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-warning">
                                    </span> แก้ไข</a></p>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-3 pull-left">
                            <p class="text-center">
                                <a class="btn icon-btn btn-danger" data-toggle="modal" data-target='#'>
                                    <span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-warning">
                                    </span> ลบทิ้ง</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>