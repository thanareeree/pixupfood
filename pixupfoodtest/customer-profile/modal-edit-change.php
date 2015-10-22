<div class="profilecontainer">
    <div class="headprofile"> 
        <img align="left" class="fb-image-lg" src="/assets/images/pearhead.png" alt="Profile image example"/>
        <img align="left" class="fb-image-profile thumbnail" src="<?= ($data2["img_path"] == "" ? '/assets/images/defaulf-profile.png' : $data2["img_path"]) ?>" id="imgprofile" style="max-width: 175px;" height="175px"/>
        <div class="fb-profile-text">

            <h1><?= $data2["firstName"] ?>  <?= $data2["lastName"] ?> | หมายเลขสมาชิก: <?= $data2["id"] ?></h1>
            <span style="color: white"></span>
            <a href="#" data-toggle="modal" data-target="#editprofilemodal"style="color:orange;">
                <i class="fa fa-pencil"></i> แก้ไขข้อมูลส่วนตัว
            </a>
            <a href="#" data-toggle="modal" data-target="#chpassform" style="color:orange;margin: 0 0 0 30px;">
                <i class="fa fa-asterisk"></i> เปลี่ยนรหัสผ่าน
            </a>
        </div>
    </div>
</div> <!-- /container -->

<!-- Modal customer -->
<div class="modal fade" id="editprofilemodal" tabindex="-1" role="dialog" aria-labelledby="ModalCusLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalCusLabel">Edit Profile<span id="cusidedit" style="display: none"></span></h4>
            </div>
            <div class="modal-body">
                <form action="/customer/update-profile.php?id=<?= $data2["id"] ?>" id="cuseditform" name="cuseditform" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" placeholder="LastName" id="eclname" name="eclname" value="<?= $data2["lastName"] ?>">
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea class="form-control" placeholder="Address" rows="3" id="ecadd" name="ecadd" > <?= $data2["address"] ?></textarea>
                        </div> 
                        <div class="col-md-12 form-group">
                            <input type="tel" class="form-control" placeholder="Phone" id="ecphone" name="ecphone" value="<?= $data2["tel"] ?>">
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

        </div>
    </div>
</div>
<!-- end edit profile-->

<!-- ch pass form -->
<div class="modal fade" id="chpassform" tabindex="-1" role="dialog" aria-labelledby="chpassform">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="chpassform">Change password</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="chpassform" name="chpassform" method="post">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input required type="password" class="form-control" placeholder="Old Password" id="crpass">
                        </div>
                        <div class="col-md-12 form-group">
                            <input required type="password" class="form-control" placeholder="New Password" id="ncrcpass">
                        </div>
                        <div class="col-md-12 form-group">
                            <input required type="password" class="form-control" placeholder="Confirm New Password" id="cncrcpass">
                        </div>
                        <div class="col-md-6 pull-right form-group">
                            <input type="submit" class="form-control text-uppercase" value="Confirm">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end change password -->
