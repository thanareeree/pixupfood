<?php
include '../admin/islogin.php';
include '../template/navbar-admin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <meta charset="UTF-8">

        <?php addlink("Edit Menu"); ?>
    </head>
    <body>
        <?php navAdminAfterLogin(); ?>
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h4 style="margin-top: 30px">Add New Food Type:</h4>
                    <div class="content2 col-sm-7">
                        <form action="../admin/save-newfoodtype.php" method="post">
                            <div class="form-group">
                                <label for="newfoodtype" class="col-sm-3 control-label" style="text-align: right">New Food Type</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="newfoodtype" name="newfoodtype" placeholder="Food Type" required>
                                </div>
                            </div><br><br><br>                        
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="reset" class="btn btn-warning resetbtn">Reset </button>
                                    <button type="submit" class="btn btn-primary addbtn"> Add </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12">
                    <h4 style="margin-top: 30px">Delete Food Type:</h4>
                    <div class="content2 col-sm-7">
                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="delfoodtype" class="col-sm-3 control-label" style="text-align: right">Food Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control foodtypelist" >
                                        <?php
                                        $res1 = $con->query("SELECT * FROM `food_type`");
                                        while ($data1 = $res1->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $data1['id'] ?>"> <?= $data1['description'] ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div><br><br><br>                        
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn btn-danger delbtn"> Delete </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/bootstrap-table.js"></script>
        <script>
            $(document).ready(function () {
                $(".delbtn").on("click", function (e) {
                   
                    $.ajax({
                        url: "../admin/delete-foodtype.php",
                        type: "POST",
                        data: {"id": $(".foodtypelist").val()},
                        dataType: "html",
                        success: function (returndata) {
                            if (returndata == "ok") {
                                document.location.reload();
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
