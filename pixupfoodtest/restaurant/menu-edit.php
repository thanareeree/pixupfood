<?php 


?>
<div class="modal-body">
    <form action="/restaurant/menu-edit-image.php" method="post" enctype="enctype="multipart/form-data"">
    <div class="row" style="margin:15px -15px;">
        <div class="col-md-12">
            <div class="card" style="margin-top: 1px;">
                <div class="card-action">
                    <div class="page-header" style="font-size:18px;margin-top: 0px;">
                        แก้ไขราคา
                    </div>
                    <div class="row" style="margin:10px 0 0 5px;">
                        <input type="text">&nbsp; บาท 
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin:15px -15px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-action">
                    <div class="page-header" style="font-size:18px;margin-top: 0px;">
                        รูปภาพ
                    </div> 
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="thumbnails">
                                <div class="span4">
                                    <div class="thumbnail">
                                            <!-- <input type="file" name="img"> --->
                                        <img src="/assets/images/res_resall/menuedit/FriedEgg.jpg" alt="ALT NAME">
                                    </div>                                                                                    
                                </div>
                            </div>
                        </div>
                            <span id="uploadtext" ></span>
                            <p align="center" ><button type="button" name="img" id="chooseimgbtn"  onClick="imagerest.click()" onMouseOut="uploadtext.value = imagerest.value" class="btn btn-primary btn-block" style="font-style:normal">เลือกรูป</button></p>
                            <input type="file" id="imagerest" name="imagerest" style="display:none" accept="image/jpeg,image/pjpeg,image/png"  />
                            <button type="submit" name="img" id="uploadimgbtn"   class="btn btn-success btn-block" style="font-style:normal;display: none">อัพเดตรูปภาพ</button>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin:15px -15px;">
            <div class="col-md-6">
                <div class="card" style="margin-top: 1px;">
                    <div class="card-action">
                        <div class="page-header" style="font-size:18px;margin-top: 0px;">สถานะ</div>


                        <div class="material-switch ">
                            <span style="margin-left: 33px;"> สินค้าหมด </span> &nbsp;
                            <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox"/>
                            <label for="someSwitchOptionSuccess" class="label-success"></label>
                            &nbsp; <span>มีสินค้า</span>
                        </div>
                    </div>
                </div>
            </div>
       
    </div> 
</form>
</div>



