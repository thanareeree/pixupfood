<?php
include '../../dbconn.php';
$boxtype = $_POST["boxtype"];
$resid = $_POST["resid"];

if ($boxtype == "4") {
    $type = "อาหารจานเดียว";
} else if ($boxtype == "5") {
    $type = "ขนม";
} else if ($boxtype == "6") {
    $type = "เครื่องดื่ม";
} else {
    $type = "กับข้าว";
}
$img = "";

$foodListRes = $con->query("SELECT DISTINCT main_menu.name as menuname, menu.img_path,"
        . " menu.id, main_menu.img_path as img, menu.price "
        . "FROM `menu` "
        . "LEFT JOIN main_menu on main_menu.id = menu.main_menu_id "
        . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
        . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
        . "WHERE main_menu.type = '$type' and menu.status = 0 "
        . "and menu.restaurant_id = '$resid'");

if ($foodListRes->num_rows == 0) {
    ?>
    <div class="col-md-12" style="margin-top: 30px">
        <div class="alert alert-warning " role="alert">
            <h4 class="text-center">ยังไม่มีรายการ</h4>
        </div>
    </div>
    <?php
} else {
    while ($foddListData = $foodListRes->fetch_assoc()) {
        ?>
        <div class="col-md-3">
            <div class="thumbnail foodlistselect">
                <img class="menu_img" src="<?= $foddListData["img_path"] == null ? $foddListData["img"] : $foddListData["img_path"] ?>" style="max-height: 101px;min-height: 101px">
                <div class="caption">
                    <h4><?= $foddListData["menuname"] ?></h4>
                    <h4><?= $foddListData["price"] ?> &nbsp;บาท</h4>
                    <p style="text-align: right">
                        <label class="Form-label--tick">
                            <input type="checkbox" name="foodlist[]" class="foodlist Form-label-checkbox" value="<?= $foddListData["id"] ?>">
                            <span class="Form-label-text"></span>
                        </label>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }
}