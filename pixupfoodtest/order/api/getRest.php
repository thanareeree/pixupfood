<?php
include '../../dbconn.php';
$address = $_POST["address"];
$res = $con->query("SELECT * FROM shippingAddress WHERE id = '$address'");
$address = $res->fetch_assoc();
$lat = $address["latitude"];
$lng = $address["longitude"];
$code = $address["postal_code"];
$amtbox = (int) $_POST["amtbox"];
$foodarr = $_POST["food"];
$boxtype = $_POST["boxtype"];
$delivery_date = @$_POST["date"];
$date = date("Y-m-d", strtotime(str_replace(" GMT+0700 (SE Asia Standard Time)", "", $delivery_date)));
if ($boxtype < "4") {
    $ricetype = $_POST["ricetype"];
    array_push($foodarr, $ricetype);
}
$restok = array();
$findDistanct = $con->query("SELECT *, 
                     ( 6371 * acos( cos( radians('$lat') ) * cos( radians( restaurant.x ) ) 
                     * cos( radians(restaurant.y) - radians('$lng')) + sin(radians('$lat')) 
                     * sin( radians(restaurant.x)))) AS distance 
                  FROM restaurant 
                  WHERE available = 1 AND close = 0 AND block = 0 
                  AND amount_box_minimum <= '$amtbox'
                  ORDER BY distance");


while ($near = $findDistanct->fetch_assoc()) {
    $rest_id = $near["id"];
    $name = $near["name"];
    $limit = $near["amount_box_limit"];
    $minimum = $near["amount_box_minimum"];
    $limitQty = ($limit - $minimum);


    $limitStatus = 0;
    $limiRes = $con->query("SELECT * FROM `limit_box_daily` WHERE restaurant_id = '$rest_id' and daily_date = '$date'");
    $limitData = $limiRes->fetch_assoc();
    $qtyDaily = $limitData["qty"];

    if ($qtyDaily >= $limitQty) {
        $limitStatus = 0;
    } else if (($qtyDaily + $amtbox) > $limit) {
        $limitStatus = 0;
    } else {
        $limitStatus = 1;
    }


    //check delivery place
    $restDeli = $con->query("SELECT * FROM delivery_place WHERE delivery_place.restaurant_id = '$rest_id'");
    if ($restDeli->num_rows == 0 && $limitStatus == 1) {
        //check if rest have selected food

        $menustr = "(";
        foreach ($foodarr as $i => $value) {
            $menustr.="'" . $value . "'";
            if ($i != sizeof($foodarr) - 1) {
                $menustr.=",";
            }
        }
        $menustr.=")";
        $res = $con->query("SELECT * FROM menu WHERE restaurant_id = '$rest_id' AND main_menu_id IN $menustr");
        if ($res->num_rows == sizeof($foodarr)) {
            $foods = array();
            while ($food = $res->fetch_assoc()) {
                array_push($foods, $food);
            }
            $near["food"] = $foods;
            array_push($restok, $near);
        }
        if (sizeof($restok) == 3) {
            break;
        }
    } else if( $limitStatus == 1){
        $postcodeRes = $con->query("SELECT data_postcode.postcode , data_district.district_name "
                . "FROM delivery_place "
                . "LEFT JOIN data_postcode ON data_postcode.district_ID = delivery_place.district_id "
                . "LEFT JOIN data_district ON data_district.district_id = delivery_place.district_id "
                . "WHERE delivery_place.restaurant_id = '$rest_id' "
                . "AND data_postcode.postcode = '$code' "
                . "GROUP BY data_postcode.postcode");
        if ($postcodeRes->num_rows == 0) {
            continue;
        } else if ($postcodeRes->num_rows > 0) {
            //check if rest have selected food

            $menustr = "(";
            foreach ($foodarr as $i => $value) {
                $menustr.="'" . $value . "'";
                if ($i != sizeof($foodarr) - 1) {
                    $menustr.=",";
                }
            }
            $menustr.=")";
            $res = $con->query("SELECT * FROM menu WHERE restaurant_id = '$rest_id'and menu.status = 0 AND main_menu_id IN $menustr");
            if ($res->num_rows == sizeof($foodarr)) {
                $foods = array();
                while ($food = $res->fetch_assoc()) {
                    array_push($foods, $food);
                }
                $near["food"] = $foods;
                array_push($restok, $near);
            }
            if (sizeof($restok) == 3) {
                break;
            }
        }
    }

    //check วันที่จัดส่ง
}
$amtbox = $_POST["amtbox"];

if (sizeof($restok) == 0) {
    echo "<h1 style='width:100%; text-align:center; margin-top:50px; margin-bottom:50px;'>ไม่พบร้านอาหารที่คุณต้องการ</h1>";
}
foreach ($restok as $key => $rest) {
    $rest_id = $rest["id"];
    $deliveryprice = getDeliveryByRestId($rest_id, $con);
    $foodprice = 0;
    $menustr = "";
    foreach ($rest["food"] as $key => $food) {
        $price = $food["price"];
        $foodprice += $price;
        $id = $food["main_menu_id"];
        $name = getMainMenuById($id, $con);
        $menustr .= $name;
        if ($key != sizeof($rest["food"]) - 1) {
            $menustr.="+";
        }
    }
    $totalfoodprice = $foodprice * $amtbox;
    $prepay = $totalfoodprice * 0.2;
    $sumprice = ($totalfoodprice - $prepay) + $deliveryprice;
    ?>
    <div class="col-md-4">
        <div class = "thumbnail">
            <h2 class="text-center" >  <i class="fa fa-cutlery" style="color: #FF5F00"></i>&nbsp;<?= $rest["name"] ?></h2>
            <hr class="hrs">
            <table class="table table-hover" id="task-table">
                <thead>
                    <tr>
                        <th>ส่งรีเควสออเดอร์</th>
                        <th></th>
                        <th class="text-right"><input type="checkbox"  name="rest[]" class="restselect" value="<?= $rest["id"] ?>" checked data-toggle="toggle" data-on="ส่ง" data-off="ไม่ส่ง" data-onstyle="success" data-offstyle="danger"></th>
                      <!--<th>ลำดับการส่งรีเควส</th>
                      <th>
                          <label><input type="checkbox" name="rest[]" class="restselect priority1 " rest-id="<?= $rest["id"] ?>" value="1<?= $rest["id"] ?>">&nbsp;1 &nbsp;</label>
                          <label><input type="checkbox" name="rest[]" class="restselect priority2  " rest-id="<?= $rest["id"] ?>" value="2<?= $rest["id"] ?>">&nbsp;2 &nbsp;</label>
                          <label><input type="checkbox" name="rest[]" class="restselect priority3 " rest-id="<?= $rest["id"] ?>" value="3<?= $rest["id"] ?>">&nbsp;3</label>
                      </th>
                      <th></th>-->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>เมนูที่เลือก: </td>
                        <td colspan="2"><?= $menustr ?></td>

                    </tr>
                    <tr>
                        <td>จำนวน:</td>
                        <td class="text-center"><?= $amtbox ?></td>
                        <td class="text-right">ชุด</td>
                    </tr>
                    <tr>
                        <td>ราคา/หน่วย: </td>
                        <td class="text-center">
                            <?php
                            $price = 0;
                            foreach ($rest["food"] as $key => $food) {
                                $price += $food["price"];
                            }
                            echo $price;
                            ?>
                        </td>
                        <td class="text-right">บาท</td>
                    </tr>
                    <tr>
                        <td>ราคา: </td>
                        <td class="text-center"><?= $totalfoodprice ?></td>
                        <td class="text-right">บาท</td>
                    </tr>
                    <tr>
                        <td>ค่ามัดจำ 20%: </td>
                        <td class="text-center"><?= $prepay ?></td>
                        <td class="text-right">บาท</td>
                    </tr>
                    <tr>
                        <td>ค่าจัดส่ง: </td>
                        <td class="text-center"><?= $deliveryprice ?></td>
                        <td class="text-right">บาท</td>
                    </tr>
                    <tr class="danger">
                        <td ><div style="width: 100px">ราคาส่วนที่เหลือ: </div></td>
                        <td class="text-center"><?= $sumprice ?></td>
                        <td class="text-right">บาท</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

function getDeliveryByRestId($rest_id, $con) {
    $res = $con->query("SELECT * FROM mapping_delivery_type WHERE restaurant_id = '$rest_id'");
    $data = $res->fetch_assoc();
    $promoRes = $con->query("select * from promotion "
            . "LEFT JOIN promotion_main ON promotion_main.id = promotion.promotion_main_id "
            . "where restaurant_id = '$rest_id' "
            . "and end_time >= date(now()) and start_time <= date(now()) and promotion_main.id = 1");
    if ($promoRes->num_rows > 0) {
        $delivery = "ฟรี";
        return $delivery;
    } else {
        $delivery = $data["deliveryfee"];
        return $delivery;
    }
}

function getMainMenuById($menu_id, $con) {
    $res = $con->query("SELECT * FROM main_menu WHERE id = '$menu_id'");
    if ($res->num_rows > 0) {
        $data = $res->fetch_assoc();
        return $data["name"];
    } else {
        return "";
    }
}
?>