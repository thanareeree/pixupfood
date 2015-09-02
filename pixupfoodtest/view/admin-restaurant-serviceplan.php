<?php
include '../admin/islogin.php';
include '../template/navbar-admin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <meta charset="UTF-8">

        <?php addlink("Service Plan Management"); ?>
    </head>
    <body>
        <?php navAdminAfterLogin(); ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Service Plan of PixupFood</h3>
                </div>

                <div class="col-sm-7">
                    <h4 style="margin-top: 30px">Create New Service Plan:</h4>
                    <div class="content2">
                        <form action="../admin/saveserviceplan.php" method="post">
                            <div class="form-group">
                                <label for="servicename" class="col-sm-3 control-label" style="text-align: right">Service Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="servicename" name="servicename" placeholder="Service Name" required>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label" style="text-align: right">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Detail of Service Plan"required></textarea>
                                </div>
                            </div>          
                            <br><br><br><br><br><br>
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary addbtn">
                                        <span class="glyphicon glyphicon-plus"></span> Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><br><br>

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
                                <tbody id="showalldata" >
                                    <?php
                                    $res1 = $con->query("SELECT * FROM `serviceplan`");
                                    while ($data1 = $res1->fetch_assoc()) {
                                        ?>
                                    <tr class="trow"id="tr<?= $data1["id"] ?>">
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
                                        <?php
                                    }
                                    ?>
                                </tbody> 
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Delete-->
            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Service Plan ID: <span id="showid"></span>?</div>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            <button type="button" class="btn btn-success" id="deleteyes" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        </div>
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>
            
            <!-- Modal View Modal-->
            <div class="modal fade" id="viewmodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Service Plan ID: &nbsp;<span id="showrestid"></span></h4>
                        </div>
                        <div id="viewbody">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


        </div>

        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#showalldata").on("click", ".deletebtn", function (e) {
                    var editid = $(this).attr("id");
                    var id = editid.replace("delete", "");
                    $("#showid").html(id);
                    $("#deletemodal").modal("show");
                });
                $("#deleteyes").on("click", function (e) {
                    $("#deleteyes").attr("disabled", "disabled");
                    $.ajax({
                        url: "../admin/deleteserviceplan.php",
                        type: "POST",
                        data: {"id": $("#showid").html()},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "ok") {
                                $("#deletemodal").modal("hide");
                                document.location.reload();
                            } else {
                                alert("error");
                            }
                        }
                    });
                });
                 $("#showalldata").on("click", ".viewbtn", function (e) {
                    var viewid = $(this).attr("id");
                    var id = viewid.replace("view", "");
                    $("#showrestid").html(id);

                    $.ajax({
                        url: "../admin/view-serviceplan.php",
                        type: "POST",
                        data: {"id": id},
                        dataType: "html",
                        success: function (returndata) {
                            $("#viewbody").html(returndata);
                            $("#viewmodal").modal("show");
                        }
                    });
                });
                
            });
        </script>

    </body>
</html>
