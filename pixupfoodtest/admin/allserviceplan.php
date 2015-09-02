<?php
include '../dbconn.php';
$res1 = $con->query("SELECT * FROM `serviceplan`");
while ($data1 = $res1->fetch_assoc()) {
    ?>
    <div class="col-sm-12">
        <div class="panel panel-success" style="margin:10px 0 10px 0;">
            <div class="panel-heading">
                <h3 class="panel-title">All Service Plan</h3>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    <table class="table table-hovere">
                        <thead>
                            <tr>
                                <th class="col-sm-1">ID</th>
                                <th class="col-sm-3">name</th>
                                <th class="col-sm-3">Actions</th> 
                            </tr>
                        </thead>
                        <tbody >
                            <tr>
                                <td >
                                    <?= $data1["id"] ?>
                                </td>
                                <td >
                                    <?= $data1["name"] ?>
                                </td>

                                <td>
                                    <button class="btn btn-primary editbtn" id="edit<?= $data1["id"] ?>">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </button>
                                    <button class="btn btn-success viewbtn" id="view<?= $data1["id"] ?>">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </button>
                                    <button class="btn btn-danger deletebtn"  id="delete<?= $data1["id"] ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody> 
                    </table>

                </div>
            </div>
        </div>
    </div>










        <?php
    }
    ?>