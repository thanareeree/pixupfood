<?php




function provincelist() {
    $res = $con->query("SELECT `id`, `name` FROM `province`");

    while ($data = $res->fetch_assoc()) {
        ?>

        <select class="form-control" id="provincelist">
            <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>   
        </select>

        <?php
    }
}
?>