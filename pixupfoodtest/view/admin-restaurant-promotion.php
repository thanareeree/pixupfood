<?php
include '../admin/islogin.php';
include '../template/navbar-admin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <meta charset="UTF-8">

        <?php addlink("Promotion Management"); ?>
        <style>
            .content2 
            {
                margin-left: 20px;
                margin-right: 20px;
                padding: 30px 0;
                padding-left: 40px;
                padding-right: 40px;
                background-color:rgba(255,246,143,0.3);
                border-top-left-radius:25px;
                border-top-right-radius:25px;
                border-bottom-left-radius:25px;
                border-bottom-right-radius:25px;
                height:auto;
            }
        </style>
    </head>
    <body>
        <?php navAdminAfterLogin(); ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                </div>

                <div class="col-sm-5">
                    <h4>Add payment:</h4>
                    <div class="panel panel-default">
                        <div class="panel-body form-horizontal payment-form">
                            <div class="form-group">
                                <label for="concept" class="col-sm-3 control-label">Concept</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="concept" name="concept">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="description" name="description">
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="amount" class="col-sm-3 control-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="amount" name="amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="status" name="status">
                                        <option>Paid</option>
                                        <option>Unpaid</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="date" class="col-sm-3 control-label">Date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>
                            </div>   
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn btn-default preview-add-button">
                                        <span class="glyphicon glyphicon-plus"></span> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div> <!-- / panel preview -->
                <div class="col-sm-7">
                    <h4>Preview:</h4>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table preview-table">
                                    <thead>
                                        <tr>
                                            <th>Concept</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody> <!-- preview content goes here-->
                                </table>
                            </div>                            
                        </div>
                    </div>
                    <div class="row text-right">
                        <div class="col-xs-12">
                            <h4>Total: <strong><span class="preview-total"></span></strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <hr style="border:1px dashed #dddddd;">
                            <button type="button" class="btn btn-primary btn-block">Submit all and finish</button>
                        </div>                
                    </div>
                </div>
            </div>


        </div>
        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/bootstrap-table.js"></script>
    </body>
</html>
