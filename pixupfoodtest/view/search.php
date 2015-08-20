<?php include '../api/islogin.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
        <title>PixupFood - Login and Register Page</title>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <!-- animate css -->
        <link rel="stylesheet" href="../assets/css/animate.min.css">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <!-- font-awesome -->
        <!--<link rel="stylesheet" href="../assets/css/font-awesome.min.css"> -->


        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/search.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/simple-sidebar.css" />
         <script>
			$(document).ready(function(){
				$("#navshoplist").click(function(){
					$("#shoplist").fadeIn(5000);
					$("#favlist").hide();
					$("#history").hide();
					$("#shipadd").hide();
				})
				
				$("#navfavlist").click(function(){
					$("#shoplist").hide();
					$("#favlist").fadeIn(5000);
					$("#history").hide();
					$("#shipadd").hide();
				})				
				
				$("#navhistory").click(function(){
					$("#shoplist").hide();
					$("#favlist").hide();
					$("#history").fadeIn(5000);
					$("#shipadd").hide();													
				})
				
				$("#navshipadd").click(function(){
					$("#shoplist").hide();
					$("#favlist").hide();
					$("#history").hide();
					$("#shipadd").fadeIn(5000);													
				})
			})
			
			$(document).ready(function(){ 
				ReDeskMap(); 
			});
			function ReDeskMap() { 
			var f = document.getElementById("gmap"); 
				if (f != null) 
					f.src=f.src; 				
			} 									
			
        </script> 
    </head>
    <body>
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
                        <li><a href="#home"></a></li>
                        <li>
                            <img src="../assets/images/bar/user.png" style="width:40px; height:40px; margin-top:15px;margin-left:30px;">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navigation -->
       
       <!-- start profile -->
       <section id="profile">
       	<div class="container">
        	<div class="row fadeInUp wow">
            	<div class="col-lg-3 col-md-3" style="padding-top:4%;">
                	<hr style="size:10px;">
                </div>
                <div class="col-lg-6 col-md-6">
                	<h3 class="text-uppercase">p r o f i l e</h3>
                </div>
                <div class="col-lg-3 col-md-3" style="padding-top:4%;">
                	<hr>
                </div>
        	</div>
            <div class="row">
            	<div class="col-lg-3 fadeInLeft" align="center">
                	<img class="img-circle img-responsive" src="../../../../Pictures/10570304_10152675703406840_773243819717095299_n.jpg">
                </div>
                <div class="col-lg-8 fadeInRight">
                	<p>
                    	ธนวัฒน์  รอดสิน<br>
                        0877056769<br>
                        technomann11@gmail.com<br>
                        123 ม.4 ต.ยยยยยยยย
                    </p>
                </div>
            </div>
            <div class="row">
            	<div class="col-lg-12 fadeInRight" style="text-align:right">
                	<a href="#" class="text-uppercase" style="color:rgba(255,127,0,1); padding-top:90%">edit</a>
                </div>
            </div>
            <div class="row">
            	<div class="col-lg-12 fadeInUp">
                	<hr>
                </div>
            </div>
        </div>
       </section>
       <!-- end profile-->
       
       <!-- 4 element -->
       <div class="row">
       <div class="col-md-3">
       	<img>
       </div>
       <div class="col-md-3">
       	<img>       
       </div>
       <div class="col-md-3">
       	<img>
       </div>
       <div class="col-md-3">
       	<img>
       </div>
       </div>
       <!-- end 4 element -->
       
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/scripts.js"></script>
        <script>
            $("#menu-toggle").click(function (e) {
            	e.preventDefault();
            	$("#wrapper").toggleClass("toggled");
            });
        </script>
        <script src="../assets/js/jquery.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/jquery.singlePageNav.min.js"></script>
        <script src="../assets/js/custom.js"></script>
    
    </body>
</html>
