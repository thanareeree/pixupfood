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
                            <th data-field="plantype" data-sortable="true">Service Plan Type</th>
                            <th data-field="approve">Approve</th>
                            <th data-field="block">Block</th>
                            <th data-field="actions" >Actions</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Dakota Rice</td>
                                    <td>$36,738</td>
                                    <td>Niger</td>
                                    <td>Oud-Turnhout</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Minerva Hooper</td>
                                    <td>$23,789</td>
                                    <td>Curaçao</td>
                                    <td>Sinaai-Waas</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Sage Rodriguez</td>
                                    <td>$56,142</td>
                                    <td>Netherlands</td>
                                    <td>Baileux</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Philip Chaney</td>
                                    <td>$38,735</td>
                                    <td>Korea, South</td>
                                    <td>Overland Park</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Doris Greene</td>
                                    <td>$63,542</td>
                                    <td>Malawi</td>
                                    <td>Feldkirchen in Kärnten</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Mason Porter</td>
                                    <td>$78,615</td>
                                    <td>Chile</td>
                                    <td>Gloucester</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Alden Chen</td>
                                    <td>$63,929</td>
                                    <td>Finland</td>
                                    <td>Gary</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Colton Hodges</td>
                                    <td>$93,961</td>
                                    <td>Nicaragua</td>
                                    <td>Delft</td>
                                    <td></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
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
                    showColumns: true,
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

    </body>
</html>
