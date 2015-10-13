<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant Calendar Management</title>

        <?php
        include '../template/customer-title.php';
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/res_restaurant_manage.css">
        <link href='/assets/css/fullcalendar.css' rel='stylesheet' />
        <link href='/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
        <style>
            #calendar {
                max-width: 900px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <?php
        $resid = $_SESSION["restdata"]["id"];
        $result = $con->query("select * from restaurant where id = '$resid' ");
        $resdata = $result->fetch_assoc();
        ?>
        <?php include '../template/restaurant-navbar.php'; ?>
        <form>
            <input type="hidden" id="residValue" value="<?= $resid ?>">
        </form>

        <!-- start head -->
        <section id="RestaurantHeader">
            <div class="overlay">
                <div class="container text-center">
                    <h1><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= $resdata["name"] ?></h1>
                </div>
            </div>
        </section>
        <!-- end head-->

        <!-- Menu Bar-->
        <!--Menu Item-->
    <scetion id="menu">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_order.php">
                    <button type="button" id="orders" class="btn btn-default" >
                        <span class="glyphicon glyphicon-align-left" aria-hidden="true" ></span>
                        <div class="hidden-xs">รายการสั่งซื้อ</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_today.php">
                    <button type="button" id="today" class="btn btn-default">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <div class="hidden-xs">วันนี้</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_menulist.php">
                    <button type="button" id="menulist" class="btn btn-default" >
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <div class="hidden-xs">รายการอาหาร</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_calendar.php">
                    <button type="button" id="calendarbtn" class="btn btn-warning" >
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        <div class="hidden-xs">ปฏิทิน</div>
                    </button>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a href="res_restaurant_manage_edit.php">
                    <button type="button" id="editres" class="btn btn-default">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <div class="hidden-xs">การตั้งค่า</div>
                    </button>
                </a>
            </div>
        </div>
    </scetion>
    <!--End Menu Item-->

    <div class="well white">
        <div class="tab-content">
            <!-- Start Content in Order List--> 
            <div class="tab-pane fade in active" id="tab2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">


                            <div class="tabbable-panel">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        <li class="active">
                                            <a href="/view/res_restaurant_manage_calendar.php" >ตารางเวลา </a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_default_1_2">
                                            <div id="calendar">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- start footer -->
    <?php
    include '../template/footer.php';
    ?>


    <script>
        $(document).ready(function () {
            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
                $(".tab").addClass("active"); // instead of this do the below 
                $(this).removeClass("btn-default").addClass("btn-warning");
            });
            /*$('#calendar').fullCalendar({
             header: {
             left: 'prev',
             center: 'title',
             right: 'next today'
             },
             events: {
             url: '/api/showcalendar.php',
             type: 'POST',
             data: {
             resid: $("#residValue").val()
             }, error: function () {
             alert('there was an error while fetching events!');
             }
             },
             eventColor: 'orange'
             });*/

            function  fetchCalendar() {
                $.ajax({
                    url: '/api/calendar-restaurant.php',
                    type: 'POST',
                    data: 'type=fetch',
                    async: false,
                    success: function (response) {
                        json_events = response;
                    }
                });
            }
            fetchCalendar();

            //var zone = "05:30";
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev',
                    center: 'title',
                    right: 'next today'
                },
                events: JSON.parse(json_events),
                lang: 'th',
                eventColor: 'orange',
                eventLimit: true
            });
        });

    </script>
</body>
</html>
