<?php
include '../dbconn.php';
$lat = $_POST["lat"];
$long = $_POST["long"];

if ($lat != "" && $long != "") {
    $res = $con->query("SELECT *, ( 3959 * acos( cos( radians(" . $lat . ") ) "
            . "* cos( radians( x ) ) * cos( radians( y ) - radians(" . $long . ") ) "
            . "+ sin( radians(" . $lat . ") ) * sin( radians( x ) ) ) ) AS distance "
            . "FROM restaurant HAVING distance < 25 ORDER BY distance LIMIT 0 , 12");
    while ($data = $res->fetch_assoc()) {
        ?>


        <li class = "col-sm-3">
            <div class = "fff">
                <div class = "thumbnail">
                    <a href = "#"><img src = "<?= ($data["img_path"]=="")?'assets/images/default-img482.png':substr($data["img_path"], 3)?>" alt = ""></a>
                </div>
                <div class = "caption">
                    <h4><?= $data["name"] ?></h4>
                    
                    <p style="text-align: left"><span class="glyphicon glyphicon-cutlery">&nbsp;</span><?= $data["detail"] ?></p>
                    <p style="text-align: left"><span class="glyphicon glyphicon-map-marker">&nbsp;</span><?= $data["province"] ?></p>
                    <a style = "color:rgba(255,127,0,1)" class = "btn btn-mini" href = "#">» Read More</a>
                </div>
            </div>
        </li>






        <?php
    }
} else {
    $res = $con->query("SELECT * FROM restaurant  ORDER BY name LIMIT 0 , 12");
    while ($data = $res->fetch_assoc()) {
        ?>

        <li class = "col-sm-3">
            <div class = "fff">
                <div class = "thumbnail">
                    <a href = "#"><img src = "../assets/images/default-img360.png" alt = ""></a>
                </div>
                <div class = "caption">
                    <h4><?= $data["name"] ?></h4>
                    <p></p>
                    <p>Nullam Condimentum Nibh Etiam Sem</p>
                    <p>Nullam Condimentum Nibh Etiam Sem</p>
                    <a style = "color:rgba(255,127,0,1)" class = "btn btn-mini" href = "#">» Read More</a>
                </div>
            </div>
        </li>

        <?php
    }
}
?>