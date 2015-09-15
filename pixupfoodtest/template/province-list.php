<select class="form-control " id="provincelist" name="provincelist">
    <?php
    $res = $con->query("SELECT `id`, `name` FROM `province`");
    while ($data = $res->fetch_assoc()) {
        ?>

        <option value="<?= $data['name'] ?>"> <?= $data['name'] ?> </option>

    <?php } ?>
</select>
