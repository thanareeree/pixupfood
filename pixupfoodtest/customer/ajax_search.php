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
    $foodtypeq = " AND menu.id IN (SELECT menu_id FROM mapping_food_type WHERE food_type_id = '$foodtype') ";
}
if ($searchby == "foodname") {
    $numrow = 0;
    if ($searchtxt != "") {
        $res = $con->query("SELECT menu.id, menu.name as menuname, restaurant.name as resname, restaurant.address, restaurant.tel, menu.img_path  "
                . "FROM restaurant "
                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                . "WHERE menu.name LIKE '%$searchtxt%' $foodtypeq ");
        $numrow = $res->num_rows;
    }else if($searchtxt == ""){
         $res = $con->query("SELECT menu.id, menu.name as menuname, restaurant.name as resname, restaurant.address, restaurant.tel, menu.img_path  "
                . "FROM restaurant "
                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
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
            </td>
            <td>
                <p><?= $data["address"] ?><br><?= $data["tel"] ?></p>
            </td>
        </tr>
        <?php
    }
} else if ($searchby == "rest") {
    $numrow = 0;
    if ($searchtxt != "") {
        $res = $con->query("SELECT DISTINCT restaurant.id, restaurant.name ,restaurant.address, restaurant.tel ,restaurant.img_path "
                . "FROM restaurant "
                . "LEFT JOIN menu ON menu.restaurant_id = restaurant.id "
                . "WHERE restaurant.name LIKE '%$searchtxt%'");
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
                <p><?= $data["address"] ?><br><?= $data["tel"] ?></p>
            </td>
        </tr>

        <?php
    }
} else if ($searchby == "nearbyfood") {
    $numrow = 0;
    if ($lat != "" && $long != "") {
        $res = $con->query("SELECT *, ( 3959 * acos( cos( radians(" . $lat . ") ) "
            . "* cos( radians( x ) ) * cos( radians( y ) - radians(" . $long . ") ) "
            . "+ sin( radians(" . $lat . ") ) * sin( radians( x ) ) ) ) AS distance "
            . "FROM restaurant HAVING distance < 25 ORDER BY distance LIMIT 0 , 20");
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
                <p><?= $data["address"] ?><br><?= $data["tel"] ?></p>
            </td>
        </tr>

        <?php
    }
   
}
?>