<?php
include '../dbconn.php';
$searchoption = $con->real_escape_string(@$_POST["searchoption"]);

if($searchoption == 'orderFromMenu'){
    $numrow = 0;
    
        $res = $con->query("SELECT DISTINCT main_menu.id, menu.img_path,  main_menu.name as menuname, "
                . "food_type.description as foodtype, main_menu.type, main_menu.img_path as img "
                . "FROM menu JOIN restaurant ON menu.restaurant_id = restaurant.id "
                . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                . "WHERE main_menu.type != 'เมนูเซต'"
                . " GROUP BY main_menu.name");
        $numrow = $res->num_rows;
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
                    <img src="<?= ($data["img_path"] == "" ? $data["img"] : $data["img_path"]) ?>" style="max-width: 150px; max-height:90px;">
                </a>
            </td>
            <td>
                <h4 class="media-heading"><?= $data["menuname"] ?></h4>
                
            </td>
            <td>
                <h4 style="color: #ffaa3e"><?= ($data["foodtype"] != '' ? "#" . $data["foodtype"] : '' ) ?></h4>
            </td>
            <td>
                <a href="/order/fast/?menuSetId=<?= $data["id"]?>" <?=(isset($_SESSION["islogin"])) ? "":"onclick=\"return false;\""?> >
                    <span class="tooltip-r"<?=(isset($_SESSION["islogin"])) ? "":" data-toggle=\"tooltip\" "?>data-placement="top" title="log in to ordet this restaurant">
                        <button class="btn btn-success menu_order" id="menuset_order<?= $data["id"] ?>"><i class="glyphicon glyphicon-plus"  ></i>&nbsp; สั่งรายการอาหารนี้</button>
                    </span>
                </a>
            </td>
        </tr>
        <?php
    }
}else if($searchoption==""){
    ?>
        <script>
        document.location.reload();
        </script>
        
    <?php
}



