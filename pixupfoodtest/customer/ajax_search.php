<?php
include '../dbconn.php';
session_start();
$cusid = @$_SESSION["userdata"]["id"];
$searchby = $con->real_escape_string(@$_POST["searchby"]);
$foodtype = $con->real_escape_string(@$_POST["foodtype"]);
$searchtxt = $con->real_escape_string(@$_POST["searchtxt"]);
$lat = @$_POST["lat"];
$long = @$_POST["long"];
//$islogin = $_SESSION["islogin"];


if ($foodtype == "all") {
    $foodtypeq = "";
} else {
    $foodtypeq = "AND food_type.description IN (SELECT food_type.description FROM food_type WHERE food_type.id = '$foodtype')";
}
if ($searchby == "foodname") {
    $numrow = 0;
    if ($searchtxt != "") {
        $res = $con->query("SELECT DISTINCT restaurant.id,menu.img_path, main_menu.name as menuname,"
                . " menu.price, food_type.description as foodtype, main_menu.type, restaurant.name"
                . " as resname, menu.id as menuid, main_menu.img_path as img "
                . "FROM menu "
                . "LEFT JOIN restaurant ON menu.restaurant_id = restaurant.id "
                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id "
                . "LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                . "WHERE main_menu.name LIKE '%$searchtxt%' AND main_menu.type NOT LIKE '%ชนิดข้าว%'"
                . "AND (restaurant.close = 0 AND restaurant.block = 0 AND menu.status = 0)  $foodtypeq ");
        $numrow = $res->num_rows;
    } /* else if ($searchtxt == "") {
      $res = $con->query("SELECT DISTINCT restaurant.id,menu.img_path, main_menu.name as menuname,"
      . " menu.price, food_type.description as foodtype, main_menu.type, restaurant.name"
      . " as resname, main_menu.id as menuid "
      . "FROM menu "
      . "LEFT JOIN restaurant ON menu.restaurant_id = restaurant.id "
      . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
      . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
      . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
      . "WHERE main_menu.name LIKE '%' AND main_menu.type NOT LIKE '%ชนิดข้าว%'"
      . "AND (restaurant.close = 0 AND restaurant.block = 0) $foodtypeq ");
      $numrow = $res->num_rows;
      } */
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
                    <img src="<?= ($data["img_path"] == "" ? $data["img"] : $data["img_path"]) ?>" style="max-width: 150px; max-height:90px; min-height: 90px; min-width: 150px">
                </a>
            </td>
            <td>
                <h4 class="media-heading"><?= $data["resname"] ?> / <?= $data["menuname"] ?></h4>
                <br><br><p style="color: #ffaa3e"><?= ($data["type"] != '' ? "#" . $data["type"] : '' ) ?>&nbsp;
                    <?= ($data["foodtype"] != '' ? "#" . $data["foodtype"] : '' ) ?></p>
            </td>
            <td>
                <p style="font-size: 20px"><?= $data["price"] ?>&nbsp;บาท<br></p>
            </td>
            <td style="padding-left: 50px">
                <a href="/view/cus_restaurant_view.php?menuId=<?= $data["menuid"] ?>&resId=<?= $data["id"] ?>" <?= (isset($_SESSION["islogin"])) ? "" : "onclick=\"return false;\"" ?>>
                    <span class="tooltip-r"<?= (isset($_SESSION["islogin"])) ? "" : " data-toggle=\"tooltip\" " ?>data-placement="top" title="log in to ordet this restaurant">
                        <button class="btn btn-success menu_order" id="menu_order<?= $data["menuid"] ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp; สั่งรายการอาหารนี้</button>
                    </span>
                </a>
                <span class="pull-right">
                    <?php
                    if (isset($_SESSION["islogin"])) {
                        $menuid = $data["menuid"];
                        $favRes = $con->query("SELECT * FROM `favorite_menu` WHERE  customer_id = '$cusid' and menu_id ='$menuid' ");
                        if ($favRes->num_rows > 0) {
                            while ($favData = $favRes->fetch_assoc()) {
                                ?>
                                <button class="btn favmenu btn-default  " >
                                    <i class="glyphicon glyphicon-heart faved"  data-menuid="<?= $data["menuid"] ?>" data-favid="<?= $favData["id"] ?>" data-faved="1" ></i>&nbsp;<span class="faved"> ชื่นชอบ</span>
                                </button>
                                <?php
                            }
                        } else {
                            ?>
                            <button class="btn favmenu btn-default">
                                <i class="glyphicon glyphicon-heart unfav"  data-menuid="<?= $data["menuid"] ?>" data-favid="" data-faved="0"  ></i>&nbsp;<span class="unfav"> ชื่นชอบ</span>
                            </button>
                            <?php
                        }
                    } else {
                        ?>
                        <button class="btn favunlogin btn-default" class="tooltip-r " data-toggle="tooltip" data-placement="top" title="log in to favorite this menu" data-menuid="<?= $data["menuid"] ?>" data-favid="" data-faved="0"  >
                            <i class="glyphicon glyphicon-heart  unfav" ></i>&nbsp;<span class="unfav"> ชื่นชอบ</span>
                        </button>
                    <?php } ?>
                </span>
            </td>
        </tr>
        <?php
    }
} else if ($searchby == "rest") {
    $numrow = 0;
    if ($searchtxt != "") {
        $res = $con->query("SELECT DISTINCT restaurant.id, restaurant.name ,restaurant.address,restaurant.detail,"
                . " restaurant.tel,restaurant.img_path, restaurant.province, sublocality_level_1 as zone_name "
                . "FROM menu"
                . " LEFT JOIN restaurant ON menu.restaurant_id = restaurant.id "
                . "LEFT JOIN main_menu ON main_menu.id = menu.main_menu_id"
                . " LEFT JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                . "LEFT JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                . "WHERE restaurant.name LIKE '%$searchtxt%' "
                . "AND restaurant.block = 0 AND menu.status = 0");
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
                    <img src="<?= ($data["img_path"] == "" ? "/assets/images/default-img150.png" : $data["img_path"]) ?>" style="max-width: 150px; max-height:90px; min-height: 90px; min-width: 150px">
                </a>
            </td>
            <td>
                <h4 class="media-heading"><?= $data["name"] ?></h4>
            </td>
            <td>
                <i class="glyphicon glyphicon-map-marker"></i>&nbsp;<?=  $data["zone_name"] ?> <?= $data["province"] ?> 

            </td>
            <td>
                <a href="/view/cus_restaurant_view.php?resId=<?= $data["id"] ?>" <?= (isset($_SESSION["islogin"])) ? "" : "onclick=\"return false;\"" ?>>
                    <span class="tooltip-r"<?= (isset($_SESSION["islogin"])) ? "" : " data-toggle=\"tooltip\" " ?> data-placement="top" title="log in to ordet this restaurant">
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
                . "restaurant.detail,  restaurant.tel,restaurant.img_path,"
                . " sublocality_level_1 as zone_name, restaurant.province, ( 3959 * acos( cos( radians(" . $lat . ") ) "
                . "* cos( radians( x ) ) * cos( radians( y ) - radians(" . $long . ") ) "
                . "+ sin( radians(" . $lat . ") ) * sin( radians( x ) ) ) ) AS distance "
                . "FROM restaurant  "
                . "RIGHT JOIN menu ON menu.restaurant_id = restaurant.id"
                . " WHERE (restaurant.available = 1  AND restaurant.block = 0 and restaurant.close = 0)"
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
                        src="<?= ($data["img_path"] == "" ? "/assets/images/default-img150.png" : $data["img_path"]) ?>"  style="max-width: 150px; max-height:90px; min-height: 90px; min-width: 150px">
                </a>
            </td>
            <td>
                <h4 class="media-heading"><?= $data["name"] ?></h4>
            </td>
            <td>
                <i class="glyphicon glyphicon-map-marker"></i>&nbsp;<?=  $data["zone_name"]  ?> <?= $data["province"] ?> 
                <br><i class="glyphicon glyphicon-flag"></i>&nbsp;รัศมี&nbsp;<?= substr($data["distance"], 0, 5) ?>&nbsp;กิโลเมตร
            </td>
            <td>
                <a href="/view/cus_restaurant_view.php?resId=<?= $data["id"] ?>" <?= (isset($_SESSION["islogin"])) ? "" : "onclick=\"return false;\"" ?>>
                    <span class="tooltip-r" <?= (isset($_SESSION["islogin"])) ? "" : " data-toggle=\"tooltip\" " ?> data-placement="top" title="log in to ordet this restaurant">
                        <button class="btn btn-success restaurant_order" id="restaurant_order<?= $data["id"] ?>"><i class="glyphicon glyphicon-plus" ></i>&nbsp; สั่งอาหารล่วงหน้า</button>
                    </span>
                </a>
            </td>
        </tr>

        <?php
    }
}
?>