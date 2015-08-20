<?php
include '../dbconn.php';

$result = $con->query("SELECT * FROM `shippingAddress`");
$i = 0;
?>

<table class="table table-hover" id="task-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Address</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($data = $result->fetch_assoc()) { ?>
            <tr>
                <td><?=$i++;?></td>
                <td><?=$data['address']?></td>
                <td>
                    <p>
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit" disabled="disabled">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                    </p>
                </td>
                <td>
                    <p>
                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </p>
                </td>
            </tr>
            <?php
        }
        ?>

    </tbody>
</table>

