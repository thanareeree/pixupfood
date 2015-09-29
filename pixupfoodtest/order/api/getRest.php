<?php
include '../../dbconn.php';
$address = $_POST["address"];
$res = $con->query("SELECT * FROM shippingAddress WHERE id = '$address'");
$address = $res->fetch_assoc();
$lat = $address["latitude"];
$lng = $address["longitude"];

$foodarr = $_POST["food"];
$boxtype = $_POST["boxtype"];
if ($boxtype != "4") {
    $ricetype = $_POST["ricetype"];
    array_push($foodarr, $ricetype);
}
$restok = array();
$findDistanct = $con->query("SELECT *, 
                     ( 6371 * acos( cos( radians('$lat') ) * cos( radians( restaurant.x ) ) 
                     * cos( radians(restaurant.y) - radians('$lng')) + sin(radians('$lat')) 
                     * sin( radians(restaurant.x)))) AS distance 
                  FROM restaurant 
                  WHERE available = 1 AND close = 0 
                  ORDER BY distance");
while ($near = $findDistanct->fetch_assoc()) {
    $rest_id = $near["id"];
    $name = $near["name"];
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
}
$amtbox = $_POST["amtbox"];

if(sizeof($restok)==0){
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
        if($key != sizeof($rest["food"])-1){
            $menustr.="+";
        }
    }
    $totalfoodprice = $foodprice*$amtbox;
    $sumprice = $totalfoodprice+$deliveryprice;
    ?>
    <div class="col-md-4">
        <h1><?=$rest["name"]?>&nbsp;&nbsp;<input type="checkbox" name="rest[]" class="restselect" value="<?=$rest["id"]?>"></h1>
        <hr class="hrs">
        <table class="table table-hover" id="task-table">
            <thead>
                <tr>
                    <th>Order List</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>เมนูที่เลือก: </td>
                    <td><?=$menustr?></td>
                    <td><?=$amtbox?> กล่อง</td>
                </tr>
                <tr>
                    <td>ราคา: </td>
                    <td><?=$totalfoodprice?></td>
                    <td>บาท</td>
                </tr>
                <tr>
                    <td>ค่าจัดส่ง: </td>
                    <td><?=$deliveryprice?></td>
                    <td>บาท</td>
                </tr>
                <tr>
                    <td>ราคารวม: </td>
                    <td><?=$sumprice?></td>
                    <td>บาท</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

function getDeliveryByRestId($rest_id,$con){
    $res = $con->query("SELECT * FROM mapping_delivery_type WHERE restaurant_id = '$rest_id'");
    if($res->num_rows > 0){
        $data = $res->fetch_assoc();
        return $data["deliveryfee"];
    }else{
        return "0";
    }
}

function getMainMenuById($menu_id,$con){
    $res = $con->query("SELECT * FROM main_menu WHERE id = '$menu_id'");
    if($res->num_rows > 0){
        $data = $res->fetch_assoc();
        return $data["name"];
    }else{
        return "";
    }
}
?>