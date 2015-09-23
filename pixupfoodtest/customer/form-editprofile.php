<?php

$id = $_POST["cusid"];
$res2 = $con->query("select * from customer where id = '$id' ");
$data2 = $res2->fetch_assoc();
?>

<div class="modal-body">
    <form action="/customer/update-profile.php" id="cuseditform" name="cuseditform" method="post">
        <h4>Select Your New Profile Picture</h4>

        <div class="form-group">
            <input type="file" name="imgpro" id="imgpro" >
            <p id="output" style="color: red"></p>
        </div>

        <div class="row">
            <div class="col-md-12 form-group">
                <input type="email" class="form-control" placeholder="Email" id="ecemail" name="ecemail" value="<?= $data2["email"] ?>">
            </div>
            <div class="col-md-6 form-group">
                <input type="text" class="form-control" placeholder="FirstName" id="ecfname" name="ecfname" value="<?= $data2["firstName"] ?>">
            </div>
            <div class="col-md-6 form-group">
                <input type="text" class="form-control" placeholder="LastName" id="eclname" value="<?= $data2["lastName"] ?>">
            </div>
            <div class="col-md-12 form-group">
                <textarea class="form-control" placeholder="Address" rows="3" id="ecadd" > <?= $data2["address"] ?></textarea>
            </div> 
            <div class="col-md-12 form-group">
                <input type="tel" class="form-control" placeholder="Phone" id="ecphone" value="<?= $data2["tel"] ?>">
            </div><br>
            <div class="col-md-3 pull-right form-group">
                <input type="submit" class="form-control text-uppercase" id="updateprobtn" value="Update">
            </div>
            <div class="col-md-3 pull-right form-group">
                <input type="button"  class="form-control btn-danger text-uppercase"  id="canceleditpro" value="Cancel">
            </div>
        </div>
    </form>
</div>
