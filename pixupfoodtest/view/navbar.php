<?php

function show_navbar() { ?>
    <!-- start preloader -->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
        <div class="navbar-header" style="padding-left:10px;" >
            <a href="#menu-toggle" id="menu-toggle">
                <img src="../assets/images/bar/menu.png" width="50" height="50" style="margin-top:8px;"/>
            </a>
        </div>
        <div id="wrapper" class="toggled menubox">
            <div id="sidebar-wrapper">
                <ul style="padding-left:0;font-weight:bold;">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#feature">Features</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#download">Download</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Pixup</a>
                <a href="#" class="navbar-brand" style="color:rgba(0,0,32,1);padding-left: 0px;">Food</a>
                <div class="col-md-4" style="margin:7px 0 0 15%;">
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control input-lg" placeholder="Search.." />
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="button">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <ul class="nav navbar-nav navbar-right text-uppercase">
                    <li><a href="index.php">Home</a></li>
                    <li>
                        <img src="../assets/images/bar/user.png" style="width:40px; height:40px; margin-top:15px;margin-left:30px;">
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navigation -->


<?php } ?>



<?php

function show_footer() { ?>

    <!-- start footer -->
    <footer>
        <div class="container" style="margin-top:90px">
            <div class="row">
                <p>Copyright © 2015 PixupFood</p>
                <p>School of Information Technology</p>
                <p>King Mongkut’s University of Technology Thonburi</p>
            </div>
        </div>
    </footer>
    <!-- end footer -->

    <!-- script references -->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/jquery.singlePageNav.min.js"></script>
    <script src="../assets/js/custom.js"></script>

<?php } ?>

    
<?php

function cusnavbar() { ?>
    <!-- start preloader -->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!-- end preloader -->
    <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
        <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                </button>
                
                <a href="index.php" class="navbar-brand">Pixup</a>
                <a href="#" class="navbar-brand" style="color:rgba(0,0,32,1);padding-left: 0px;">Food</a>
                <div class="col-md-4" style="margin:7px 0 0 15%;">
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control input-lg" placeholder="Search.." />
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="button">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <ul class="nav navbar-nav navbar-right text-uppercase">
                    <li><a href="index.php" class="nav-link"><?= $_SESSION["userdata"]["firstName"] ?> &nbsp; <?= $_SESSION["userdata"]["lastName"] ?> </a></li>
                    <li>
                        <img src="../assets/images/bar/user.png" style="width:40px; height:40px; margin-top:15px;margin-left:30px;">
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navigation -->


<?php } ?>

    
    