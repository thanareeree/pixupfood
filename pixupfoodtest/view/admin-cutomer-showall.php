<?php
include '../admin/islogin.php';
include '../template/navbar-admin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <?php addlink("Customer Management"); ?>
    </head>
    <body>
        <?php navAdminAfterLogin(); ?>
        <div class="container">

            <div class="toolbar">
                <h3>All Restaurant</h3>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin: 20px">

                    <div class="fresh-table">
                        <table id="fresh-table" class="table">
                            <thead style="background-color: #FF9F00">
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="resname"  data-sortable="true">Customer Name</th>
                            <th data-field="approve">Approve</th>
                            <th data-field="block">Block</th>
                            <th data-field="actions" >Actions</th>
                            </thead>
                            <tbody id="showdata">
                                <?php
                                $res1 = $con->query("SELECT * FROM `customer`");
                                while ($data1 = $res1->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $data1["id"] ?></td>
                                        <td><?= $data1["name"] ?></td>
                                        <td><?= $data1["serviceplan_id"] ?></td>
                                        <td>
                                            <button class="btn openconfirmbtn" id="openconfirm<?= $data1["name"] ?>" style="<?= ($data1["available"] == 0) ? '' : 'display: none' ?>">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </button>
                                            <button class="btn btn-success approvebtn" id="approvebtn" style="<?= ($data1["available"] == 1) ? '' : 'display: none' ?>">
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
                            </tbody>
                        </table>
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

                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this restaurant ID: <span id="showid"></span>?</div>

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

            <!-- Modal open Confirm-->
            <div class="modal fade" id="openconfirmmodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Restaurant: &nbsp;<span id="showrestaurantname"></span></h4>
                        </div>
                        <div class="modal-body">
                            <p>Image Preview:</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"></span>cancel</button>
                            <button type="button" class="btn btn-success" id="approveyes" ></span>Approve</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- Modal block Restaurant -->
            <div class="modal fade" id="blockmodal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Block this entry</h4>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to block this restaurant ID: <span id="showblockid"></span>?</div>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            <button type="button" class="btn btn-success" id="blockyes" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        </div>
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>

            <!-- Modal blocked Restaurant -->
            <div class="modal fade" id="blockedmodal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h4 class="modal-title custom_align" id="Heading">Block this entry</h4>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to unblock this restaurant ID: <span id="showblockedid"></span>?</div>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            <button type="button" class="btn btn-success" id="unblockyes" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
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
                            <h4 class="modal-title">Restaurant ID: &nbsp;<span id="showrestid"></span></h4>
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
        <script src="../assets/js/bootstrap-table.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#fresh-table').bootstrapTable({
                    toolbar: ".toolbar",
                    showRefresh: false,
                    search: true,
                    showToggle: true,
                    showColumns: false,
                    pagination: true,
                    striped: true,
                    pageSize: 12,
                    pageList: [12, 25, 50, 100],
                    formatShowingRows: function (pageFrom, pageTo, totalRows) {
                        //do nothing here, we don't want to show the text "showing x of y from..." 
                    },
                    formatRecordsPerPage: function (pageNumber) {
                        return pageNumber + " rows visible";
                    },
                    icons: {
                        refresh: 'fa fa-refresh',
                        toggle: 'fa fa-th-list',
                        columns: 'fa fa-columns',
                        detailOpen: 'fa fa-plus-circle',
                        detailClose: 'fa fa-minus-circle'
                    }
                });

                function fetchdataShowall() {
                    $.ajax({
                        url: "../admin/allrestaurant.php",
                        type: "POST",
                        dataType: "html",
                        success: function (returndata) {
                            $("#showdata").html(returndata);
                        }
                    });
                }

                $("#showdata").on("click", ".viewbtn", function (e) {
                    var viewid = $(this).attr("id");
                    var id = viewid.replace("view", "");
                    $("#showrestid").html(id);

                    $.ajax({
                        url: "../admin/view-restaurant.php",
                        type: "POST",
                        data: {"id": id},
                        dataType: "html",
                        success: function (returndata) {
                            $("#viewbody").html(returndata);
                            $("#viewmodal").modal("show");
                        }
                    });
                });
                $("#showdata").on("click", ".deletebtn", function (e) {
                    var editid = $(this).attr("id");
                    var id = editid.replace("delete", "");
                    $("#showid").html(id);
                    $("#deletemodal").modal("show");

                });


                $("#deleteyes").on("click", function (e) {
                    $("#deleteyes").attr("disabled", "disabled");
                    $.ajax({
                        url: "../admin/deleterestaurant.php",
                        type: "POST",
                        data: {"id": $("#showid").html()},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "ok") {
                                $("#deletemodal").modal("hide");
                                fetchdataShowall();
                            } else {
                                alert("error");
                            }
                        }
                    });
                });

                $("#showdata").on("click", ".openconfirmbtn", function (e) {
                    var approvename = $(this).attr("id");
                    var name = approvename.replace("openconfirm", "");
                    $("#showrestaurantname").html(name);
                    $("#openconfirmmodal").modal('show');
                });

                $("#approveyes").on("click", function (e) {
                    $("#approveyes").html("<img src='../assets/images/loader.gif' style='width:25px; margin:0 auto;'>");
                    $.ajax({
                        url: "../admin/approverestaurant.php",
                        type: "POST",
                        data: {"name": $("#showrestaurantname").html()},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "ok") {
                                $("#openconfirmmodal").modal("hide");
                                fetchdataShowall();
                            } else {
                                alert("error");
                            }
                        }
                    });
                });

                $("#showdata").on("click", ".blockbtn", function (e) {
                    var blockid = $(this).attr("id");
                    var id = blockid.replace("block", "");
                    $("#showblockid").html(id);
                    $("#blockmodal").modal('show');
                });

                $("#blockyes").on("click", function (e) {

                    $.ajax({
                        url: "../admin/blockrestaurant.php",
                        type: "POST",
                        data: {"id": $("#showblockid").html()},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "ok") {
                                $("#blockmodal").modal("hide");
                                fetchdataShowall();
                            } else {
                                alert("error");
                            }
                        }
                    });
                });
                $("#showdata").on("click", ".blockedbtn", function (e) {
                    var blockedid = $(this).attr("id");
                    var id = blockedid.replace("blocked", "");
                    $("#showblockedid").html(id);
                    $("#blockedmodal").modal('show');
                });

                $("#unblockyes").on("click", function (e) {

                    $.ajax({
                        url: "../admin/blockrestaurant.php",
                        type: "POST",
                        data: {"id": $("#showblockedid").html()},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "ok") {
                                $("#blockedmodal").modal("hide");
                                fetchdataShowall();
                            } else {
                                alert("error");
                            }
                        }
                    });
                });

            });
        </script>
    </body>
</html>
