<?php
include '../dbconn.php';
$searchby = $con->real_escape_string(@$_POST["searchby"]);
$foodtype = $con->real_escape_string(@$_POST["foodtype"]);
$searchtxt = $con->real_escape_string(@$_POST["searchtxt"]);
$lat = @$_POST["lat"];
$long = @$_POST["long"];

if ($foodtype == "all") {
    $foodtypeq = "";
} else {
    $foodtypeq = " AND menu.id IN (SELECT menu_id FROM mapping_food_type WHERE food_type_id = '$foodtype') "
            . "AND food_type.description IN (SELECT food_type.description FROM food_type WHERE id = '$foodtype') ";
}
if ($searchby == "foodname") {
    $numrow = 0;
    if ($searchtxt != "") {
        $res = $con->query("SELECT menu.id, menu.name as menuname,menu.price ,menu.type , food_type.description ,"
                . "restaurant.name as resname, restaurant.address, restaurant.detail, restaurant.tel, menu.img_path "
                . "FROM restaurant "
                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = menu.id "
                . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                . "WHERE menu.name LIKE '%$searchtxt%' $foodtypeq ");
        $numrow = $res->num_rows;
    } else if ($searchtxt == "") {
        $res = $con->query("SELECT menu.id, menu.name as menuname,menu.price ,menu.type , food_type.description ,"
                . "restaurant.name as resname, restaurant.address, restaurant.detail, restaurant.tel, menu.img_path "
                . "FROM restaurant "
                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = menu.id "
                . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                . "WHERE menu.name LIKE '%' $foodtypeq ");
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
                        src="<?= ($data["img_path"] == "" ? "../assets/images/default-img150.png" : $data["img_path"]) ?>"
                        style="max-width: 150px; max-height:90px;">
                </a>
            </td>
            <td>
                <h4 class="media-heading"><?= $data["resname"] ?> / <?= $data["menuname"] ?></h4>
                <br><br><p style="color: #ffaa3e"><?= ($data["type"] != '' ? "#" . $data["type"] : '' ) ?>&nbsp;
                    <?= ($data["description"] != '' ? "#" . $data["description"] : '' ) ?></p>
            </td>
            <td>
                <p style="font-size: 20px"><?= $data["price"] ?>&nbsp;บาท<br></p>
            </td>
            <td>
                <span class="tooltip-r" data-toggle="tooltip" data-placement="top" title="log in to ordet this restaurant">
                    <button class="btn btn-success menu_order" id="menu_order<?= $data["id"] ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp; สั่งรายการอาหารนี้</button>
                </span>
            </td>
        </tr>
        <?php
    }
} else if ($searchby == "rest") {
    $numrow = 0;
    if ($searchtxt != "") {
        $res = $con->query("SELECT DISTINCT restaurant.id, restaurant.name ,restaurant.address, "
                . "restaurant.detail,  restaurant.tel,restaurant.img_path, restaurant.zone_id,"
                . " zone.name as zone_name, restaurant.province  "
                . "FROM restaurant JOIN zone ON zone.id = restaurant.zone_id "
                . "WHERE restaurant.name LIKE '%$searchtxt%' "
                . "AND zone.name IN (SELECT zone.name FROM zone WHERE id = restaurant.zone_id)");
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
                        src="<?= ($data["img_path"] == "" ? "../assets/images/default-img150.png" : $data["img_path"]) ?>"
                        style="max-width: 150px; max-height:90px;">
                </a>
            </td>
            <td>
                <h4 class="media-heading"><?= $data["name"] ?></h4>
            </td>
            <td>
                <i class="glyphicon glyphicon-map-marker"></i>&nbsp;<?= ($data["province"] == "กรุงเทพมหานคร") ? 'เขต' . $data["zone_name"] . '&nbsp;' : '' ?> <?= $data["province"] ?> 

            </td>
            <td>
                <a href="../view/cus_restaurant_view.php?resId=<?= $data["id"] ?>">
                    <span class="tooltip-r" data-toggle="tooltip" data-placement="top" title="log in to ordet this restaurant">
                        <button class="btn btn-success restaurant_order" id="restaurant_order<?= $data["id"] ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp; สั่งอาหารล่วงหน้า</button>
                    </span>
                </a>
            </td>
        </tr>

        <?php
    }
} else if ($searchby == "nearbyfood") {
    $numrow = 0;
    if ($lat != "" && $long != "") {
        $res = $con->query("SELECT DISTINCT restaurant.id, restaurant.name ,restaurant.address, "
                . "restaurant.detail,  restaurant.tel,restaurant.img_path, restaurant.zone_id,"
                . " zone.name as zone_name, restaurant.province, ( 3959 * acos( cos( radians(" . $lat . ") ) "
                . "* cos( radians( x ) ) * cos( radians( y ) - radians(" . $long . ") ) "
                . "+ sin( radians(" . $lat . ") ) * sin( radians( x ) ) ) ) AS distance "
                . "FROM restaurant JOIN zone ON zone.id = restaurant.zone_id "
                . "WHERE zone.name IN (SELECT zone.name FROM zone WHERE id = restaurant.zone_id)"
                . "HAVING distance < 25 ORDER BY distance LIMIT 0 , 20");
        $numrow = $res->num_rows;
    }
    if ($numrow == 0) {
        ?>
        <tr><td colspan="3" style="text-align: center;"><h2>No support!</h2></td></tr>
        <?php
    }
    while ($data = $res->fetch_assoc()) {
        ?>
        <tr>
            <td style="text-align: center;">
                <a class="" href="#">
                    <img 
                        src="<?= ($data["img_path"] == "" ? "../assets/images/default-img150.png" : $data["img_path"]) ?>"
                        style="max-width: 150px; max-height:90px;">
                </a>
            </td>
            <td>
                <h4 class="media-heading"><?= $data["name"] ?></h4>
            </td>
            <td>
                <i class="glyphicon glyphicon-map-marker"></i>&nbsp;<?= ($data["province"] == "กรุงเทพมหานคร") ? 'เขต' . $data["zone_name"] . '&nbsp;' : '' ?> <?= $data["province"] ?> 
                <br><i class="glyphicon glyphicon-flag"></i>&nbsp;รัศมี&nbsp;<?= substr($data["distance"], 0, 5) ?>&nbsp;กิโลเมตร
            </td>
            <td>
                <a href="../view/cus_restaurant_view.php?resId=<?= $data["id"] ?>">
                    <span class="tooltip-r" data-toggle="tooltip" data-placement="top" title="log in to ordet this restaurant">
                        <button class="btn btn-success restaurant_order" id="restaurant_order<?= $data["id"] ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp; สั่งอาหารล่วงหน้า</button>
                    </span>
                </a>
            </td>
        </tr>

        <?php
    }
}
?>