<?php
session_start();
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant View</title>

        <?php include '../template/customer-title.php'; ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/restaurant_view.css">
        <link href="http://jondmiles.com/bootstrap-datepaginator/css/bootstrap-datepicker.css" rel="stylesheet" media="screen" type="text/css">
        <link href="http://jondmiles.com/bootstrap-datepaginator/css/bootstrap-datepaginator.min.css" rel="stylesheet" media="screen" type="text/css">
        <style>
            #restaurant_view .fb-image-profile
            {
                margin: -160px 45px 10px 80px;
                z-index: 9;
                width: 13%;
                height: 175px;
                border-radius:50%;
            }
            #restaurant_view .menu_img{
                width: 100%;
                max-width: 100%;
                height: 100px;
            }
        </style>
    </head>
    <body>
        <?php
        $resid = $_GET["resId"];
        $restaurantres = $con->query("SELECT restaurant.id, restaurant.name as resname, restaurant.firstname,"
                . "restaurant.lastname,restaurant.x, restaurant.y, restaurant.img_path, "
                . "restaurant.star, restaurant.address,restaurant.price_prepay, restaurant.province, "
                . "zone.name "
                . "FROM `restaurant` "
                . "JOIN zone ON zone.id = restaurant.zone_id "
                . "where restaurant.id = '$resid' "
                . "and zone.name IN (SELECT zone.name FROM zone WHERE id = restaurant.zone_id)");
        $restaurantdata = $restaurantres->fetch_assoc();

        $cusid = $_SESSION["userdata"]["id"];
        $customerRes = $con->query("select customer.id, customer.firstName, customer.lastName,"
                . " customer.email, customer.tel, customer.address   "
                . "from customer "
                . "where id = '$cusid' ");
        $customerData = $customerRes->fetch_assoc();
        ?>
        <?php include '../template/customer-navbar.php'; ?>

        <!-- start profile -->
        <section id="restaurant_view">
            <div class="profilecontainer">
                <div class="headprofile">
                    <img align="left" class="fb-image-lg" src="../assets/images/city-restaurant-lunch-outside.png" alt="Profile image example"/>
                    <div class="container_status">
                        <h3><i class="glyphicon glyphicon-cutlery"></i>&nbsp;<?= $restaurantdata["resname"] ?></h3><br> 
                        <div id="stars-existing" class="starrr" data-rating='4'></div>
                    </div>
                    <img align="left" class="fb-image-profile thumbnail" src="<?= ($restaurantdata["img_path"] == "" ? '../assets/images/bar/restaurant.png' : $restaurantdata["img_path"]) ?>"  style="max-width: 175px; max-height: 175px" />
                    <div class="fb-profile-text">
                        <br>
                        <div class="row lead">
                            <div id="stars-existing" class="starrr" data-rating='4'></div>
                        </div>
                    </div>
                </div>
            </div> <!-- /container -->
            <!-- edit profile -->

            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">News</a></li>
                            <li role="presentation"><a href="#promo" aria-controls="promo" role="tab" data-toggle="tab">Promotions</a></li>
                            <li role="presentation"><a href="#order" aria-controls="order" role="tab" data-toggle="tab">สั่งอาหาร</a></li>
                            <li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">ข้อมูลร้าน</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="news">
                                <br><div class="row">

                                    <section id="pinBoot">
                                        <article class="white-panel"><img src="../assets/images/res_resall/menuedit/FriedEgg.jpg" alt="">
                                            <h4><a href="#">เมนูใหม่</a></h4>
                                            <p>ทางร้านของเราได้เพิ่มเมนูอาหารใหม่ นั่นก็คือ สปาเก็ดดี้ไวท์ซอท สั่งได้แล้ววันนี้</p>
                                        </article>
                                    </section>

                                </div>
                            </div>
                            <!-- Promotion -->
                            <div role="tabpanel" class="tab-pane" id="promo">
                                <br><div class="row">
                                    <section id="pinBootpromo">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <section id="pinBoot">
                                                    <article class="white-panel"><img src="../assets/images/sixStep/step5.png" alt="">
                                                        <h4><a href="#">ฟรีค่าจัดส่ง</a></h4>
                                                        <p>1 เดือนเท่านั้น</p>
                                                    </article>
                                                </section>
                                            </div>
                                            <!--<div class="col-md-3">
                                                <div class="thumbnail">
                                                    <a href="#"><img src="http://placehold.it/360x240" alt=""></a>
                                                    <div class="caption">
                                                        <h3>Thumbnail label</h3>
                                                        <p>...</p>
                                                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                                    </div>
                                                </div>
                                            </div>     -->                    
                                        </div>
                                    </section>
                                </div>
                            </div>


                            <!-- Order -->
                            <div role="tabpanel" class="tab-pane" id="order">
                                <div class="wizard">
                                    <div class="wizard-inner">
                                        <div class="connecting-line"></div>
                                        <ul class="nav nav-tabs" role="tablist">

                                            <li role="presentation" class="active">
                                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-folder-open"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            <li role="presentation" class="disabled">
                                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-pencil"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-picture"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-picture"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li role="presentation" class="disabled">
                                                <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                                                    <span class="round-tab">
                                                        <i class="glyphicon glyphicon-picture"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>


                                    <div class="tab-content">
                                        <!-- เลือกกล่อง -------------------------------------------------------------->
                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                            <div class="container_field">
                                                <h3>ขั้นตอนที่ 1 : เลือกกล่อง</h3>
                                                <?php
                                                $foodboxRes = $con->query("SELECT food_box.id, food_box.description, "
                                                        . "mapping_food_box.restaurant_id as resid "
                                                        . "FROM mapping_food_box "
                                                        . "LEFT JOIN food_box ON food_box.id = mapping_food_box.food_box_id "
                                                        . "WHERE mapping_food_box.restaurant_id = '$resid' ");

                                                while ($foodboxData = $foodboxRes->fetch_assoc()) {
                                                    ?>
                                                    <input type="radio" name="foodboxtype" value="box<?= $foodboxData["id"] ?>">&nbsp;<?= $foodboxData["description"] ?><br>
                                                <?php } ?>
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                            </ul>
                                        </div>
                                        
                                        <!-- เลือกชนิดข้าวข้าว -------------------------------------------------------------->
                                        <div class="tab-pane" role="tabpanel" id="step2">
                                            <div class="container_field">
                                                <h3>ขั้นตอนที่ 2 : เลือกข้าว</h3>
                                                <?php
                                                $riceListRes = $con->query("SELECT * FROM `menu` where restaurant_id = '$resid' and type = 'ชนิดข้าว'");

                                                while ($riceData = $riceListRes->fetch_assoc()) {
                                                    ?>
                                                <input type="radio" name="ricetype" value="<?= $riceData["name"] ?>">&nbsp;<?= $riceData["name"] ?>&nbsp;&nbsp;(<?= $riceData["price"] ?>&nbsp;บาท)<br>
                                                <?php } ?>

                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step3" >
                                            <div class="container_field">
                                                <h3>ขั้นตอนที่ 3 : เลือกรายการอาหาร</h3>
                                                <h3>ลำดับที่ 1</h3>
                                                <div class="row">
                                                    <?php
                                                    $foodListRes = $con->query("SELECT * FROM `menu` where restaurant_id = '$resid' and type = 'กับข้าว'");

                                                    while ($foddListData = $foodListRes->fetch_assoc()) {
                                                        ?>
                                                        <div class="col-md-3">
                                                            <div class="thumbnail">
                                                                <a href="#"><img class="menu_img" src="<?= ($foddListData["img_path"] == "") ? '../assets/images/default-img360.png' : $foddListData["img_path"] ?>"></a>
                                                                <div class="caption">
                                                                    <h4><?= $foddListData["name"] ?></h4>
                                                                    <p><?= $foddListData["price"] ?>&nbsp;บาท</p>
                                                                    <p style="text-align: right">
                                                                        <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                    }
                                                    ?>
                                                </div> <hr class="hrs">
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                            </ul>
                                        </div>

                                        <div class="tab-pane" role="tabpanel" id="step4">
                                            <div class="tab-pane" role="tabpanel" id="step4">
                                                <div class="container_field">
                                                    <h3>ขั้นตอนที่ 4 : เลือกวัน เวลา และสถานที่จัดส่ง</h3>
                                                    <div>
                                                        <h4>ส่งวันที่:     
                                                            <input type="date" name="senddate">
                                                        </h4>
                                                    </div>
                                                    <div>
                                                        <h4>เวลาประมาณ:     
                                                            <input type="time" name="sendtime">
                                                        </h4>
                                                    </div>
                                                    <h3>สถานที่จัดส่ง:</h3>
                                                    <div class="content2">
                                                        <table class="table table-hover" id="task-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th colspan="3">Address</th>
                                                                    <th>Select</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td colspan="3"><?= $customerData['address'] ?></td>
                                                                    <td><input type="radio" value="<?= $customerData['address'] ?>" name="shipAddress"> </td>
                                                                </tr>
                                                                <?php
                                                                $i = 2;

                                                                $shipAddressRes = $con->query("SELECT CONCAT(shippingAddress.address,' ประเภท',shippingAddress.type,'(', shippingAddress.address_naming,')') AS ship_address, shippingAddress.id FROM `shippingAddress` WHERE customer_id = '$cusid'");

                                                                while ($shipAddressData = $shipAddressRes->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $i++; ?></td>
                                                                        <td colspan="3"><?= $shipAddressData['ship_address'] ?></td>
                                                                        <td><input type="radio"  name="shipAddress" value="<?= $shipAddressData['ship_address'] ?>"> </td>
                                                                    </tr>

                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <div class="row">
                                                            <div id="inbox" style="margin:15% 0 0 0;">
                                                                <div class="fab btn-group show-on-hover dropup" id="add_sa" data-toggle="modal" data-target="#add_address">
                                                                    <button type="button" class="btn btn-danger glyphicon glyphicon-plus btn-io">
                                                                        <span class="fa-stack fa-2x">
                                                                            <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
                                                                            <i class="fa fa-plus fa-stack-1x fa-inverse fab-primary"></i>
                                                                            <i class="fa fa-plus fa-stack-1x fa-inverse fab-secondary"></i>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>

                                                </div>
                                                <ul class="list-inline pull-right">
                                                    <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                    <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                                </ul>
                                            </div>                                   
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step5">
                                            <div class="container_field">
                                                <div class="row">                                                        
                                                    <h3>ขั้นตอนที่ 5 : เลือกวิธีชำระเงิน</h3>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" name="sex" value="male">&nbsp;เงินสด&nbsp;&nbsp;
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" name="sex" value="female">&nbsp;โอนเงินผ่านบัญชีธนาคาร&nbsp;&nbsp;
                                                        <p>เลขที่บัญชี:_____________</p>
                                                        <p>ชื่อบัญชี:_______________</p>
                                                        <p>ธนาคาร:________สาขา_______</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                                <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Promotion -->
                            <div role="tabpanel" class="tab-pane" id="info">
                                <br><div class="row">

                                </div>
                            </div>
                        </div>

                        <!-- Add Shipping address Modal -->
                        <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-labelledby="shipping_address">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdrecl" name="mdrecl"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="shipping_address">Add Other Address</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="addressform" name="addressform" method="post">

                                            <div class="form-group">
                                                <input name="address" type="text" required class="form-control input-lg" id="address" placeholder="Address">
                                            </div>

                                            <div class="modal-footer form-group">
                                                <input type="submit" class="btn btn-primary" name="nextbutton" id="nextbutton" value="Update" >
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="datepaginator" id="paginator"></div><br><hr>
                        <div class="container_field">
                            <h3>Order & Price</h3>
                            <p>บอกรายละเอียดรายการ พร้อมราคาที่ลูกค้าเลือก</p>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">Order</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>

        <script>
            var __slice = [].slice;

            (function ($, window) {
                var Starrr;

                Starrr = (function () {
                    Starrr.prototype.defaults = {
                        rating: void 0,
                        numStars: 5,
                        change: function (e, value) {
                        }
                    };

                    function Starrr($el, options) {
                        var i, _, _ref,
                                _this = this;

                        this.options = $.extend({}, this.defaults, options);
                        this.$el = $el;
                        _ref = this.defaults;
                        for (i in _ref) {
                            _ = _ref[i];
                            if (this.$el.data(i) != null) {
                                this.options[i] = this.$el.data(i);
                            }
                        }
                        this.createStars();
                        this.syncRating();
                        this.$el.on('mouseover.starrr', 'i', function (e) {
                            return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
                        });
                        this.$el.on('mouseout.starrr', function () {
                            return _this.syncRating();
                        });
                        this.$el.on('click.starrr', 'i', function (e) {
                            return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
                        });
                        this.$el.on('starrr:change', this.options.change);
                    }

                    Starrr.prototype.createStars = function () {
                        var _i, _ref, _results;

                        _results = [];
                        for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                            _results.push(this.$el.append("<i class='fa fa-star-o'></i>"));
                        }
                        return _results;
                    };

                    Starrr.prototype.setRating = function (rating) {
                        if (this.options.rating === rating) {
                            rating = void 0;
                        }
                        this.options.rating = rating;
                        this.syncRating();
                        return this.$el.trigger('starrr:change', rating);
                    };

                    Starrr.prototype.syncRating = function (rating) {
                        var i, _i, _j, _ref;

                        rating || (rating = this.options.rating);
                        if (rating) {
                            for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                                this.$el.find('i').eq(i).removeClass('fa-star-o').addClass('fa-star');
                            }
                        }
                        if (rating && rating < 5) {
                            for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                                this.$el.find('i').eq(i).removeClass('fa-star').addClass('fa-star-o');
                            }
                        }
                        if (!rating) {
                            return this.$el.find('i').removeClass('fa-star').addClass('fa-star-o');
                        }
                    };

                    return Starrr;

                })();
                return $.fn.extend({
                    starrr: function () {
                        var args, option;

                        option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                        return this.each(function () {
                            var data;

                            data = $(this).data('star-rating');
                            if (!data) {
                                $(this).data('star-rating', (data = new Starrr($(this), option)));
                            }
                            if (typeof option === 'string') {
                                return data[option].apply(data, args);
                            }
                        });
                    }
                });
            })(window.jQuery, window);

            $(function () {
                return $(".starrr").starrr();
            });

            $(document).ready(function () {

                $('#stars').on('starrr:change', function (e, value) {
                    $('#count').html(value);
                });

                $('#stars-existing').on('starrr:change', function (e, value) {
                    $('#count-existing').html(value);
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                //Initialize tooltips
                $('.nav-tabs > li a[title]').tooltip();

                //Wizard
                $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                    var $target = $(e.target);

                    if ($target.parent().hasClass('disabled')) {
                        return false;
                    }
                });

                $(".next-step").click(function (e) {

                    var $active = $('.wizard .nav-tabs li.active');
                    $active.next().removeClass('disabled');
                    nextTab($active);

                });
                $(".prev-step").click(function (e) {

                    var $active = $('.wizard .nav-tabs li.active');
                    prevTab($active);

                });
            });

            function nextTab(elem) {
                $(elem).next().find('a[data-toggle="tab"]').click();
            }
            function prevTab(elem) {
                $(elem).prev().find('a[data-toggle="tab"]').click();
            }
        </script>
        <script type="text/javascript" src="http://jondmiles.com/bootstrap-datepaginator/js/moment.min.js"></script>
        <script type="text/javascript" src="http://jondmiles.com/bootstrap-datepaginator/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="http://jondmiles.com/bootstrap-datepaginator/js/bootstrap-datepaginator.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#pinBoot').pinterest_grid({
                    no_columns: 4,
                    padding_x: 10,
                    padding_y: 10,
                    margin_bottom: 50,
                    single_column_breakpoint: 700
                });
            });
            $('#paginator').datepaginator();

            $('#info').click(function (e) {
                alert('ccccc');
            });

            /*
             Ref:
             Thanks to:
             http://www.jqueryscript.net/layout/Simple-jQuery-Plugin-To-Create-Pinterest-Style-Grid-Layout-Pinterest-Grid.html
             */

            (function ($, window, document, undefined) {
                var pluginName = 'pinterest_grid',
                        defaults = {
                            padding_x: 10,
                            padding_y: 10,
                            no_columns: 3,
                            margin_bottom: 50,
                            single_column_breakpoint: 700
                        },
                columns,
                        $article,
                        article_width;

                function Plugin(element, options) {
                    this.element = element;
                    this.options = $.extend({}, defaults, options);
                    this._defaults = defaults;
                    this._name = pluginName;
                    this.init();
                }

                Plugin.prototype.init = function () {
                    var self = this,
                            resize_finish;

                    $(window).resize(function () {
                        clearTimeout(resize_finish);
                        resize_finish = setTimeout(function () {
                            self.make_layout_change(self);
                        }, 11);
                    });

                    self.make_layout_change(self);

                    setTimeout(function () {
                        $(window).resize();
                    }, 500);
                };

                Plugin.prototype.calculate = function (single_column_mode) {
                    var self = this,
                            tallest = 0,
                            row = 0,
                            $container = $(this.element),
                            container_width = $container.width();
                    $article = $(this.element).children();

                    if (single_column_mode === true) {
                        article_width = $container.width() - self.options.padding_x;
                    } else {
                        article_width = ($container.width() - self.options.padding_x * self.options.no_columns) / self.options.no_columns;
                    }

                    $article.each(function () {
                        $(this).css('width', article_width);
                    });

                    columns = self.options.no_columns;

                    $article.each(function (index) {
                        var current_column,
                                left_out = 0,
                                top = 0,
                                $this = $(this),
                                prevAll = $this.prevAll(),
                                tallest = 0;

                        if (single_column_mode === false) {
                            current_column = (index % columns);
                        } else {
                            current_column = 0;
                        }

                        for (var t = 0; t < columns; t++) {
                            $this.removeClass('c' + t);
                        }

                        if (index % columns === 0) {
                            row++;
                        }

                        $this.addClass('c' + current_column);
                        $this.addClass('r' + row);

                        prevAll.each(function (index) {
                            if ($(this).hasClass('c' + current_column)) {
                                top += $(this).outerHeight() + self.options.padding_y;
                            }
                        });

                        if (single_column_mode === true) {
                            left_out = 0;
                        } else {
                            left_out = (index % columns) * (article_width + self.options.padding_x);
                        }

                        $this.css({
                            'left': left_out,
                            'top': top
                        });
                    });

                    this.tallest($container);
                    $(window).resize();
                };

                Plugin.prototype.tallest = function (_container) {
                    var column_heights = [],
                            largest = 0;

                    for (var z = 0; z < columns; z++) {
                        var temp_height = 0;
                        _container.find('.c' + z).each(function () {
                            temp_height += $(this).outerHeight();
                        });
                        column_heights[z] = temp_height;
                    }

                    largest = Math.max.apply(Math, column_heights);
                    _container.css('height', largest + (this.options.padding_y + this.options.margin_bottom));
                };

                Plugin.prototype.make_layout_change = function (_self) {
                    if ($(window).width() < _self.options.single_column_breakpoint) {
                        _self.calculate(true);
                    } else {
                        _self.calculate(false);
                    }
                };

                $.fn[pluginName] = function (options) {
                    return this.each(function () {
                        if (!$.data(this, 'plugin_' + pluginName)) {
                            $.data(this, 'plugin_' + pluginName,
                                    new Plugin(this, options));
                        }
                    });
                }

            })(jQuery, window, document);
        </script>

    </body>
</html>
