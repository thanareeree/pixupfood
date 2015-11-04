<?php
include '../dbconn.php';
$lat = @$_POST["lat"];
$long = @$_POST["long"];
$type = @$_POST["type"];

if ($type == "nearby") {
    $res = $con->query("SELECT DISTINCT restaurant.id, restaurant.name ,restaurant.address, "
            . "restaurant.detail,  restaurant.tel,restaurant.img_path, restaurant.zone_id,"
            . " zone.name as zone_name, restaurant.province, ( 3959 * acos( cos( radians(" . $lat . ") ) "
            . "* cos( radians( x ) ) * cos( radians( y ) - radians(" . $long . ") ) "
            . "+ sin( radians(" . $lat . ") ) * sin( radians( x ) ) ) ) AS distance "
            . "FROM restaurant JOIN zone ON zone.id = restaurant.zone_id "
            . "RIGHT JOIN menu ON menu.restaurant_id = restaurant.id"
            . " WHERE restaurant.available = 1  "
            . "AND zone.name IN (SELECT zone.name FROM zone WHERE id = restaurant.zone_id)"
            . "HAVING distance < 25 ORDER BY distance LIMIT 0 , 8");
    while ($data = $res->fetch_assoc()) {
        ?>
        <li class = "col-sm-3">
            <div class = "card-action">
                <div class = "thumbnail">
                    <a href = "/view/cus_restaurant_view.php?resId=<?= $data["id"] ?>"><img src = "<?= ($data["img_path"] == "") ? 'assets/images/default-img360.png' : $data["img_path"] ?>" style="max-width:100% ;max-height:162px ;min-width: 243px;min-height: 162px;"></a>
                </div>
                <div class = "caption">
                    <p style="text-align: left"><span class="glyphicon glyphicon-cutlery">&nbsp;</span><?= $data["name"] ?></p>
                    <p style="text-align: left"><span class="glyphicon glyphicon-map-marker">&nbsp;</span><?= $data["province"] ?></p>
                    <a style = "color:rgba(255,127,0,1)" class = "btn btn-mini"  href = "/view/cus_restaurant_view.php?resId=<?= $data["id"] ?>" class="tooltip-r" data-toggle="tooltip" data-placement="right" title="เข้าสู่ระบบเพื่อเข้าเยี่ยมชมร้านอาหาร">» ไปที่ร้านนี้</a>
                </div>
            </div>
        </li>
        <?php
    }
} else {
    $res2 = $con->query("SELECT DISTINCT restaurant.id, restaurant.name ,restaurant.address, "
                . "restaurant.detail,  restaurant.tel,restaurant.img_path, restaurant.zone_id,"
                . " zone.name as zone_name, restaurant.province "
                . "FROM restaurant "
                . "JOIN zone ON zone.id = restaurant.zone_id "
                . "RIGHT JOIN menu ON menu.restaurant_id = restaurant.id "
                . "WHERE restaurant.block = 0 LIMIT 0 , 8");
    while ($data2 = $res2->fetch_assoc()) {
        ?>
        <li class = "col-sm-3">
            <div class = "card-action">
                <div class = "thumbnail">
                    <a href = "/view/cus_restaurant_view.php?resId=<?= $data2["id"] ?>"><img src = "<?= ($data2["img_path"] == "") ? 'assets/images/default-img360.png' : $data2["img_path"] ?>" style="max-width:100% ;max-height:162px ;min-width: 243px;min-height: 162px;"></a>
                </div>
                <div class = "caption">
                    <p style="text-align: left"><span class="glyphicon glyphicon-cutlery">&nbsp;</span><?= $data2["name"] ?></p>
                    <p style="text-align: left"><span class="glyphicon glyphicon-map-marker">&nbsp;</span><?= $data2["province"] ?></p>
                    <a style = "color:rgba(255,127,0,1)" class = "btn btn-mini"  href = "/view/cus_restaurant_view.php?resId=<?= $data2["id"] ?>" class="tooltip-r" data-toggle="tooltip" data-placement="right" title="เข้าสู่ระบบเพื่อเข้าเยี่ยมชมร้านอาหาร">» ไปที่ร้านนี้</a>
                </div>
            </div>
        </li>

        <?php
    }
}
?>
