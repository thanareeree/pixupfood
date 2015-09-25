<select class="foodtypelist" name="foodtypelist" style="width: 150px;  margin-left: 5px;font-size: 18px">
    <option>--ตัวเลือก--</option>
    <?php
    $res1 = $con->query("SELECT * FROM `food_type`");
    while ($data1 = $res1->fetch_assoc()) {
        ?>
        <option value="<?= $data1['id'] ?>"> <?= $data1['description'] ?> </option>
    <?php } ?>
</select>
