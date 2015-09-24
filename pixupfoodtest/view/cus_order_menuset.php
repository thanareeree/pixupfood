<?php
include '../api/islogin.php';
include '../dbconn.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Pixupfood - Order</title>
        <?php include '../template/customer-title.php'; ?>

        <!-- custom css -->
        <link rel="stylesheet" href="/assets/css/fast_order.css">
        <style>
            .connecting-line {
                height: 2px;
                background: #e0e0e0;
                position: absolute;
                width: 60%;
                left: 0;
                right: 0;
                top: 50%;
                z-index: 1;
                margin-left: 60;
            }
        </style>

    </head>
    <body>
        <?php
        $menuSetId = $_GET["menuSetId"];
        $menusetRes = $con->query("SELECT DISTINCT main_menu.id,  main_menu.name as menusetname, menu.price,main_menu.type,"
                . " restaurant.id as resid, restaurant.name as resname, restaurant.img_path "
                . "FROM menu "
                . "JOIN restaurant ON menu.restaurant_id = restaurant.id "
                . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                . "WHERE main_menu.id = '$menuSetId'");
        $menusetData = $menusetRes->fetch_assoc();

        $cusid = $_SESSION["userdata"]["id"];
        $customerRes = $con->query("select customer.id, customer.firstName, customer.lastName,"
                . " customer.email, customer.tel, customer.address   "
                . "from customer "
                . "where id = '$cusid' ");
        $customerData = $customerRes->fetch_assoc();
        ?>
        <?php include '../template/customer-navbar.php'; ?>

        <!-- start profile -->
        <section id="fast_order">
            <div class="profilecontainer">
                <div class="headprofile">
                    <img align="left" class="fb-image-lg" src="/assets/images/city-restaurant-lunch-outside.png" alt="Profile image example"/>
                </div>
            </div> <!-- /container -->
            <!-- edit profile -->
            <div class="container">
                <h2>Fast Order Menu: "<?= $menusetData["menusetname"] ?>"</h2>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
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
                                        <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="step4">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="step5">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span>
                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <form role="form" action="#">
                                <div class="tab-content">
                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                        <div class="container_field">
                                            <h3>ขั้นตอนที่ 1 : จำนวนกล่อง</h3>
                                            <h5>จำนวนกล่อง: &nbsp;<input type="number" name="boxamount" id="boxamount" value="" ></h5>
                                        </div>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" role="tabpanel" id="step2">
                                        <div class="container_field">
                                            <h3>ขั้นตอนที่ 2 : เลือกวันที่และสถานที่จัดส่ง</h3>
                                            <div>
                                                <h3>ส่งวันที่ :     
                                                    <input type="date" name="senddate">
                                                </h3>
                                                <h3>เวลา :     
                                                    <input type="time" name="sendtime">
                                                </h3>
                                            </div>
                                            <h3>เลือกจากสถานที่ของคุณ</h3>
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
                                    <div class="tab-pane" role="tabpanel" id="step3">
                                        <div class="container_field">
                                            <h3>ขั้นตอนที่ 3 : เลือกวิธีชำระเงิน</h3>
                                            <input type="checkbox" name="sex" value="male">&nbsp;เงินสด&nbsp;&nbsp;
                                            <input type="checkbox" name="sex" value="female">&nbsp;โอนเงินผ่านบัญชีธนาคาร&nbsp;&nbsp;
                                        </div>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                            <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" role="tabpanel" id="step4">
                                        <div class="container_field">
                                            <h3>ขั้นตอนที่ 4 : เลือกร้านอาหาร</h3>
                                            <div class="row">
                                                <?php
                                                $resfromMenuRes = $con->query("SELECT DISTINCT main_menu.id,  main_menu.name as menuname, menu.price,main_menu.type,"
                                                        . " restaurant.id as resid, restaurant.name as resname, restaurant.img_path "
                                                        . "FROM menu "
                                                        . "JOIN restaurant ON menu.restaurant_id = restaurant.id "
                                                        . "JOIN main_menu ON main_menu.id = menu.main_menu_id "
                                                        . "JOIN mapping_food_type ON mapping_food_type.menu_id = main_menu.id "
                                                        . "JOIN food_type ON food_type.id = mapping_food_type.food_type_id "
                                                        . "WHERE main_menu.id = '$menuSetId'");
                                                while ($resData = $resfromMenuRes->fetch_assoc()) {
                                                    ?>
                                                    <div class="col-md-2">
                                                        <div class="thumbnail">
                                                            <img src="<?= ($resData["img_path"] == "") ? '/assets/images/default-img150.png' : $resData["img_path"] ?>" alt="">
                                                            <div class="caption">
                                                                <h4><?= $resData["resname"] ?></h4>
                                                                <p><input type="checkbox" ></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>       
                                            </div>
                                        </div>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                            <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" role="tabpanel" id="step5">
                                        <div class="container_field">
                                            <h3>ขั้นตอนที่ 5 : ตรวจสอบข้อมูลความถูกต้อง</h3><br>
                                            <div class="row">
                                                <form action="#" style="margin: 0;">
                                                    <div class="col-md-4">
                                                        <h1>ร้านป้าลมัย</h1><hr class="hrs">
                                                        <table class="table table-hover" id="task-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order List</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>เมนูที่เลือก: </td>
                                                                    <td>ข้าวผัดกระเพรา+หมูกระเทียม</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>จำนวน: </td>
                                                                    <td>300</td>
                                                                    <td>กล่อง</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ราคา: </td>
                                                                    <td>10000</td>
                                                                    <td>บาท</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ค่าจัดส่ง: </td>
                                                                    <td>100</td>
                                                                    <td>บาท</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ราคารวม: </td>
                                                                    <td>10100</td>
                                                                    <td>บาท</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </form>
                                                <form action="#" style="margin: 0;">
                                                    <div class="col-md-4">
                                                        <h1>ร้านป้าสมัย</h1><hr class="hrs">
                                                        <table class="table table-hover" id="task-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order List</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>เมนูที่เลือก: </td>
                                                                    <td>ข้าวผัดกระเพรา+หมูกระเทียม</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>จำนวน: </td>
                                                                    <td>300</td>
                                                                    <td>กล่อง</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ราคา: </td>
                                                                    <td>10000</td>
                                                                    <td>บาท</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ค่าจัดส่ง: </td>
                                                                    <td>100</td>
                                                                    <td>บาท</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ราคารวม: </td>
                                                                    <td>10100</td>
                                                                    <td>บาท</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </form>
                                                <form  action="#">
                                                    <div class="col-md-4">
                                                        <h1>ร้านป้าสมร</h1><hr class="hrs">
                                                        <table class="table table-hover" id="task-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order List</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>เมนูที่เลือก: </td>
                                                                    <td>ข้าวผัดกระเพรา+หมูกระเทียม</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>จำนวน: </td>
                                                                    <td>300</td>
                                                                    <td>กล่อง</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ราคา: </td>
                                                                    <td>10000</td>
                                                                    <td>บาท</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ค่าจัดส่ง: </td>
                                                                    <td>100</td>
                                                                    <td>บาท</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ราคารวม: </td>
                                                                    <td>10100</td>
                                                                    <td>บาท</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                            <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section> 


        <?php include '../template/footer.php'; ?>

        <script>
            (function () {
                'use strict';
                $.fn.extend({filterTable: function () {
                        return this.each(function () {
                            $(this).on('keyup', function (e) {
                                $('.filterTable_no_results').remove();
                                var $this = $(this),
                                        search = $this.val().toLowerCase(),
                                        target = $this.attr('data-filters'),
                                        $target = $(target),
                                        $rows = $target.find('tbody tr');

                                if (search == '') {
                                    $rows.show();
                                } else {
                                    $rows.each(function () {
                                        var $this = $(this);
                                        $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                                    })
                                    if ($target.find('tbody tr:visible').size() === 0) {
                                        var col_count = $target.find('tr').first().find('td').size();
                                        var no_results = $('<tr class="filterTable_no_results"><td colspan="' + col_count + '">No results found</td></tr>')
                                        $target.find('tbody').append(no_results);
                                    }
                                }
                            });
                        });
                    }
                });
                $('[data-action="filter"]').filterTable();
            })(jQuery);

            $(function () {
                // attach table filter plugin to inputs
                $('[data-action="filter"]').filterTable();

                $('.container').on('click', '.panel-heading span.filter', function (e) {
                    var $this = $(this),
                            $panel = $this.parents('.panel');

                    $panel.find('.panel-body').slideToggle();
                    if ($this.css('display') != 'none') {
                        $panel.find('.panel-body input').focus();
                    }
                });
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
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


    </body>
</html>
