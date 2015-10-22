<?php




function provincelist() {
    $res = $con->query("SELECT * FROM `order_status` WHERE id = 2 or id = 5 or id = 8 or id = 4");

    while ($data = $res->fetch_assoc()) {
        ?>
        <select class="form-control" id="provincelist">
            <option value="<?= $data['id'] ?>"> <?= $data['description'] ?> </option>   
        </select>
        <?php
    }
}
?>