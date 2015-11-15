<?php
include '../admin/islogin.php';
include '../template/navbar-admin.php';
include '../dbconn.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <?php addlink("Restaurant Management"); ?>
        <link rel="stylesheet" href="/assets/css/datatables.css">
    </head>
    <body>
        <?php navAdminAfterLogin(); ?>
        <div class="container">

            <div class="toolbar">
                <h3>Edit Images of Main Menu</h3>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin: 20px">
                    <div class="fresh-table">
                        <table id="restDataTable" class="table table-striped table-bordered">
                            <thead style="background-color: #FF9F00">
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="resname"  data-sortable="true">Menu Name</th>
                            <th data-field="img" data-sortable="true" >Image</th>
                            <th data-field="img" data-sortable="true" >Upload New Image</th>
                           <!--<th data-field="actions" >Actions</th>-->
                            </thead>
                            <tbody id="showdata">
                                <?php
                                $res1 = $con->query("SELECT * FROM `main_menu` ");
                                while ($data1 = $res1->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $data1["id"] ?></td>
                                        <td><?= $data1["name"] ?></td>
                                        <td class="text-center"><img src="<?= $data1["img_path"] ?>" style="max-height: 150px;max-width: 150px"></td>
                                        <td style="width: 300px" class="text-right">
                                            <div >
                                                <form action="/admin/edit-image-mainmenu.php?id=<?= $data1["id"] ?>" method="post" enctype="multipart/form-data">

                                                    <input type="file" id="imagerest" class="imagerest" required="" name="imagerest"  accept="image/jpeg,image/pjpeg,image/png"  />
                                                    <button class="btn btn-primary uploadBtn text-right" style="margin-top: 50px" type="submit" id="uploadBtn<?= $data1["id"] ?>">
                                                        <span style="font-family: 'supermarketregular'"><i  class="glyphicon glyphicon-upload"></i>&nbsp;อัพโหลดรูปภาพ</span>
                                                    </button>
                                                    <!--</form>--> 
                                                </form>
                                            </div>
                                        </td>
                                        <!--<td class="text-center">
                                           
                                            <button class="btn btn-danger deletebtn"  id="delete<?= $data1["id"] ?>">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </td>-->
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

        <script src="/assets/js/jquery-2.1.4.min.js"></script>
        <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/js/bootstrap-table.js"></script>
        <script src="/assets/js/dataTables.js"></script>
        <script>
            var table = $('#restDataTable').DataTable({
            });
        </script>
        <script>
            /* $(document).ready(function () {
             $("#showdata").on("change", ".imagerest", function (e){
             
             });
             });*/
        </script>



    </body>
</html>
