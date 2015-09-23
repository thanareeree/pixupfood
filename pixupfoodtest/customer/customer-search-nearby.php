<?php
include '../dbconn.php';
$lat = $_POST["lat"];
$long = $_POST["long"];

if ($lat != "" && $long != "") {
    $res = $con->query("SELECT *, ( 3959 * acos( cos( radians(" . $lat . ") ) "
            . "* cos( radians( x ) ) * cos( radians( y ) - radians(" . $long . ") ) "
            . "+ sin( radians(" . $lat . ") ) * sin( radians( x ) ) ) ) AS distance "
            . "FROM restaurant where available = 1 HAVING distance < 25 ORDER BY distance LIMIT 0 , 8");
    while ($data = $res->fetch_assoc()) {
        ?>
        <li class = "col-sm-3">
            <div class = "card-action">
                <div class = "thumbnail">
                    <a href = "/view/cus_restaurant_view.php?resId=<?= $data["id"]?>"><img src = "<?= ($data["img_path"] == "") ? 'assets/images/default-img360.png' : substr($data["img_path"], 3) ?>" style="max-width:100% ;max-height:162px "></a>
                </div>
                <div class = "caption">
                    <h4><?= $data["name"] ?></h4>
                    <p style="text-align: left"><span class="glyphicon glyphicon-cutlery">&nbsp;</span><?= $data["detail"] ?></p>
                    <p style="text-align: left"><span class="glyphicon glyphicon-map-marker">&nbsp;</span><?= $data["province"] ?></p>
                    <a style = "color:rgba(255,127,0,1)" class = "btn btn-mini" href = "/view/cus_restaurant_view.php?resId=<?= $data["id"]?>">» ไปที่ร้านนี้</a>
                </div>
            </div>
        </li>
        <?php
    }
} else {
    $res2 = $con->query("SELECT * FROM restaurant  ORDER BY name LIMIT 0 , 8");
    while ($data2 = $res2->fetch_assoc()) {
        ?>

        <li class = "col-sm-3">
            <div class = "fff">
                <div class = "thumbnail">
                    <a href = "/view/cus_restaurant_view.php?resId=<?= $data2["id"]?>"><img src = "/assets/images/default-img360.png" alt = ""></a>
                </div>
                <div class = "caption">
                    <h4><?= $data2["name"] ?></h4>
                    <p style="text-align: left"><span class="glyphicon glyphicon-cutlery">&nbsp;</span><?= $data2["detail"] ?></p>
                    <p style="text-align: left"><span class="glyphicon glyphicon-map-marker">&nbsp;</span><?= $data2["province"] ?></p>
                    <a style = "color:rgba(255,127,0,1)" class = "btn btn-mini" href = "/view/cus_restaurant_view.php?resId=<?= $data2["id"]?>">» ไปที่ร้านนี้</a>
                </div>
            </div>
        </li>

        <?php
    }
}
?>
