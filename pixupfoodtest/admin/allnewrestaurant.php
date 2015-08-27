<?php
include '../dbconn.php';
$res1 = $con->query("SELECT * FROM `restaurant`");
while ($data1 = $res1->fetch_assoc()) {
    ?>
    <tr>
        <td><?= $data1["id"] ?></td>
        <td><?= $data1["name"] ?></td>
        <td><?= $data1["serviceplan_id"] ?></td>
        <td>
            <button class="btn  btn-xs" id="openconfirmbtn" >
                <span class="glyphicon glyphicon-eye-open"></span>
            </button>
        </td>                                       
        <td class="">
            <button class="btn btn-xs" id="blockbtn" >
                <span class="glyphicon glyphicon-ok"></span>
            </button>
        </td> 
        <td>
            <a href="#">
                <button class="btn btn-primary managebtn" id="manage<?= $data1["id"] ?>">
                    <span class="glyphicon glyphicon-edit"></span>
                </button>
            </a>
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
