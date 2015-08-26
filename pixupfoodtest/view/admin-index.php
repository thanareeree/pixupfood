<?php
include '../admin/islogin.php';
include '../template/navbar-admin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <meta charset="UTF-8">

        <?php addlink("Admin Management"); ?>
    </head>
    <body>
        <?php navAdminAfterLogin(); ?>
        <div class="container">

            <div class="toolbar">
                <h3>New Restaurant</h3>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin: 20px">

                    <div class="fresh-table">
                        <table id="fresh-table" class="table">
                            <thead style="background-color: #FF9F00">
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="resname"  data-sortable="true">Restaurant Name</th>
                            <th data-field="plantype" data-sortable="true" data-toggle="tooltip" data-placement="top" title="1 = ทดลองใช้ 1 ปี">Service Plan Type</th>
                            <th data-field="approve">Approve</th>
                            <th data-field="block">Block</th>
                            <th data-field="actions" >Actions</th>
                            </thead>
                            <tbody>

                                <?php
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this restaurant?</div>

                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-success" id="yesbtn" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            </div>
                        </div>
                        <!-- /.modal-content --> 
                    </div>
                    <!-- /.modal-dialog --> 
                </div>

            
            
            
        </div>


        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
       <script src="../assets/js/bootstrap-table.js"></script>
        <script type="text/javascript">
            var $table = $('#fresh-table'),
                    full_screen = false;

            $().ready(function () {
                $table.bootstrapTable({
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



                $(window).resize(function () {
                    $table.bootstrapTable('resetView');
                });


            });
      </script>
      <script>
      $(".deletebtn").on("click", function (e){
               $("#deletemodal").modal('show'); 
                
            });
      </script>
         
    </body>
</html>
