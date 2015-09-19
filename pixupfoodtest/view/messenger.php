<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../api/function.php';
include '../dbconn.php';
?>




<html>
    <head>
        <meta charset="UTF-8">


        <!-- 
        Boxer Template
        http://www.templatemo.com/preview/templatemo_446_boxer
        -->
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->

        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <?php
        addlink("Test Title");
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/messenger.css">
        <link href="http://jondmiles.com/bootstrap-datepaginator/css/bootstrap-datepicker.css" rel="stylesheet" media="screen" type="text/css">
        <link href="http://jondmiles.com/bootstrap-datepaginator/css/bootstrap-datepaginator.min.css" rel="stylesheet" media="screen" type="text/css">

    </head>
    <body>
        <!-- start preloader -->
        <div class="preloader">
            <div class="loader"></div>
        </div>
        <!-- end preloader -->
        <!-- start navigation -->
        <nav class="navbar navbar-default navbar-fixed-top templatemo-nav" style="width: 360px;">
            <div class="container" style="height:60px;width:90%;">
                <div class="navbar-header">
                    <a href="../index.php" style="color:rgba(255,127,0,1);padding:20px 0 15px 0;" class="navbar-brand">Pixup</a>
                    <a href="../index.php" class="navbar-brand" style="color:black;padding:20px 15px 15px 0;">Food</a>
                    <ul class="nav navbar-nav navbar-right text-uppercase pull-right">
                        <li>
                            <a  <?= (!isset($_SESSION["islogin"])) ? 'href="#"' : 'href="../api/logout.php" class="nav-link"' ?> ><?= (!isset($_SESSION["islogin"])) ? 'สมัครสมาชิก | เข้าสู่ระบบ >>' : $_SESSION["userdata"]["firstName"] . " " . $_SESSION["userdata"]["lastName"] ?> <img src="../assets/images/bar/user.png" style="width:40px;height:40px;"/> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- start profile -->
        <section id="messenger">
            <div class="profilecontainer">
                <div class="headprofile">
                    <img align="left" class="fb-image-lg" src="../assets/images/city-restaurant-lunch-outside.png" alt="Profile image example"/>
                    <div class="container_status">
                        <span></span><br>
                    </div>
                    <img align="left" class="fb-image-profile thumbnail" src="http://lorempixel.com/180/180/people/9/" alt="Profile image example"/>
                    <div class="fb-profile-text">
                        <br><h1><?= $_SESSION["userdata"]["firstName"] ?>  <?= $_SESSION["userdata"]["lastName"] ?></h1>
                        <h6>ร้านป้าลมัย</h6>
                    </div>
                    <div class="container_status">
                        <form action="#">
                            <h4>ชื่อผู้รับ: </h4><span>นายลมุน ลูกป้าลมัย</span>
                            <h4>รหัสรายการ: </h4><span>LM00010</span>
                            <h4>รหัสยืนยัน:</h4>
                            <input type="text" name="otpaccept">
                            <button type="button" class="btn btn-primary">confirm</button>
                        </form>
                    </div>
                </div>
            </div> <!-- /container -->
            <!-- edit profile -->

            <div class="container">

            </div>
        </section> 


        <?php
        show_footer();
        iconscript();
        ?>

        <script>
            (function () {
                'use strict';
                $.fn.extend({
                    filterTable: function () {
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
        <script>
            $(document).ready(function () {

                // This will wait for the DOM (your HTML) to be loaded before executing aFunction

                /* uncomment to use optios
                 var options = {
                 selectedDate: '2013-01-01',
                 selectedDateFormat: 'YYYY-MM-DD'
                 }
                 
                 $('#paginator').datepaginator(options);
                 
                 */

                //  defatult settings, i.e. today's date etc.

                $('#paginator').datepaginator();


                /* uncomment to add event if date is changed
                 $('#paginator').on('selectedDateChanged', function(event, date) {
                 // Your logic goes here
                 alert('Date was changed.');
                 });
                 */

            });
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

            /*
             Ref:
             Thanks to:
             http://www.jqueryscript.net/layout/Simple-jQuery-Plugin-To-Create-Pinterest-Style-Grid-Layout-Pinterest-Grid.html
             */


            /*
             Pinterest Grid Plugin
             Copyright 2014 Mediademons
             @author smm 16/04/2014
             
             usage:
             
             $(document).ready(function() {
             
             $('#blog-landing').pinterest_grid({
             no_columns: 4
             });
             
             });
             
             
             */
            ;
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
