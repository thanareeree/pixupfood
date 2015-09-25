<nav class="navbar navbar-default navbar-fixed-top templatemo-nav" role="navigation">
        <div class="container" style="margin-left:100px;margin-right:40px;height:70px;width:auto;">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                </button>
                <a href="/index.php" style="color:rgba(255,127,0,1)" class="navbar-brand">Pixup</a>
                <a href="/index.php" class="navbar-brand" style="color:black;padding-left: 0px;">Food</a>
                <div class="col-md-4" style="margin:7px 0 0 15%;">
                    <form action="/view/search_page.php" method="get">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" name="search" value="<?= @$_GET["search"] ?>" class="form-control input-lg" placeholder="ค้นหาร้านอาหารที่นี่" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>

                            </div>
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-nav navbar-right text-uppercase" id="logindiv">
                   
                    <li class="dropdown">
                        <a href="/api/logout.php"  >
                            <span class="glyphicon glyphicon-home" style="width:40px;height:40px;"></span>
                        </a>
                       
                    </li>
                </ul>
            </div>
        </div>
    </nav><!-- end navigation -->