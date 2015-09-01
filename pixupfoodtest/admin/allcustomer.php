<?php
include '../dbconn.php';
$res1 = $con->query("SELECT * FROM `customer`");
while ($data1 = $res1->fetch_assoc()) {
    ?>
    <tr>
        <td><?= $data1["id"] ?></td>
        <td><?= $data1["firstName"] ?> &nbsp; <?= $data1["lastName"] ?></td>
        <td>
            <button class="btn verifybtn"  style="<?= ($data1["available"] == 0) ? '' : 'display: none' ?>">
                <span class="glyphicon glyphicon-ok"></span>
            </button>
            <button class="btn btn-success verifiedbtn"  style="<?= ($data1["available"] >= 1) ? '' : 'display: none' ?>">
                <span class="glyphicon glyphicon-ok"></span>
            </button>
        </td>                                       
        <td>
            <button class="btn blockbtn" id="block<?= $data1["id"] ?>" style="<?= ($data1["block"] == 0) ? '' : 'display: none' ?>" >
                <span class="glyphicon glyphicon-ok"></span>
            </button>
            <button class="btn btn-success blockedbtn" id="blocked<?= $data1["id"] ?>" style="<?= ($data1["block"] == 1) ? '' : 'display: none' ?>">
                <span class="glyphicon glyphicon-ok"></span>
            </button>
        </td> 
        <td>
            <button class="btn btn-success viewbtn" id="view<?= $data1["id"] ?>">
                <span class="glyphicon glyphicon-eye-open"></span>
            </button>
            <button class="btn btn-danger deletebtn"  id="delete<?= $data1["id"] ?>">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </td>
    </tr>
    <?php
}
?>

