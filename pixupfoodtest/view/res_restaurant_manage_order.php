<?php
include '../api/islogin.php';
include '../view/navbar.php';
include '../dbconn.php';
?>




<html>
    <head>
        <title>Pixupfood - Restaurant Order Management</title>

        <?php
        include '../template/customer-title.php';
        ?>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/res_restaurant_manage.css">

    </head>
    <body>

        <?php include '../template/restaurant-navbar.php'; ?>


        <!-- start profile -->
        <section id="head">
            <div id="myCarousel" class="carousel slide">
                <!-- Indicators -->
                <div class="item active">
                    <img src="../assets/images/slide/aa.png" class="img-responsive" style="margin-top:0px;">
                    <div class="container white">
                        <div class="carousel-caption-new">
                            <div class="RestaurantHeader" style="font-family:supermarket">
                                ร้านนายใหญ่โภชนา
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </section>

        <!-- Menu Bar-->
        <!--Menu Item-->
    <scetion id="menu">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" id="today" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    <div class="hidden-xs">วันนี้</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="order" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
                    <div class="hidden-xs">รายการสั่งซื้อ</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    <div class="hidden-xs">ปฏิทิน</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="following" class="btn btn-default" href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <div class="hidden-xs">รายการอาหาร</div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="following" class="btn btn-default" href="#tab5" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <div class="hidden-xs">การตั้งค่า</div>
                </button>
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
                                            <a href="#tab_default_1_2" data-toggle="tab">
                                                รายการสั่งซื้อใหม่ </a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_2_2" data-toggle="tab">
                                                รายการสั่งซื้ออยู่ระหว่างการดำเนินการ </a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_3_2" data-toggle="tab">
                                                รายการสั่งซื้อเสร็จสมบูรณ์ </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_default_1_2">
                                            <p>
                                                I'm in Tab 1.
                                            </p>
                                            <p>
                                                Duis autem eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.
                                            </p>
                                            <p>
                                                <a class="btn btn-success" href="http://j.mp/metronictheme" target="_blank">
                                                    Learn more...
                                                </a>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="tab_default_2_2">
                                            <p>
                                                Howdy, I'm in Tab 2.
                                            </p>
                                            <p>
                                                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation.
                                            </p>
                                            <p>
                                                <a class="btn btn-warning" href="http://j.mp/metronictheme" target="_blank">
                                                    Click for more features...
                                                </a>
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="tab_default_3_2">
                                            <p>
                                                Howdy, I'm in Tab 3.
                                            </p>
                                            <p>
                                                Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
                                            </p>
                                            <p>
                                                <a class="btn btn-info" href="http://j.mp/metronictheme" target="_blank">
                                                    Learn more...
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade in" id="tab3">

                <!--   <div class="row" style="
                        margin-top: 5px;
                        ">
                       <div class="col-md-12">
                           <div class="page-header"style="
   
                                margin-top: 10px;
                                ">
   
                               <h2>ปฏิทิน</h2>
                           </div>
   
                           <div class="datepaginator" id="paginator">
   
                           </div>
                           <hr>
   
                           <div class="container">
   
                               <div class="row" style="
                                    margin-top: 10px;
                                    ">
                                   <div class="col-md-12">
                                       <div class="panel panel-primary">
                                           <div class="panel-heading">
                                               <h3 class="panel-title">Developers</h3>
                                               <div class="pull-right">
                                                   <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                       <i class="glyphicon glyphicon-filter"></i>
                                                   </span>
                                               </div>
                                           </div>
                                           <div class="panel-body">
                                               <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
                                           </div>
                                           <table class="table table-hover" id="dev-table">
                                               <thead>
                                                   <tr>
                                                       <th>#</th>
                                                       <th>First Name</th>
                                                       <th>Last Name</th>
                                                       <th>Username</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   <tr>
                                                       <td>1</td>
                                                       <td>Kilgore</td>
                                                       <td>Trout</td>
                                                       <td>kilgore</td>
                                                   </tr>
                                                   <tr>
                                                       <td>2</td>
                                                       <td>Bob</td>
                                                       <td>Loblaw</td>
                                                       <td>boblahblah</td>
                                                   </tr>
                                                   <tr>
                                                       <td>3</td>
                                                       <td>Holden</td>
                                                       <td>Caulfield</td>
                                                       <td>penceyreject</td>
                                                   </tr>
                                               </tbody>
                                           </table>
                                       </div>
                                   </div>
                               </div>
                           </div>
                -->
            </div>
        </div>
    </div>

<!-- start footer -->
<?php
show_footer();
?>
<script src="../assets/js/jquery.singlePageNav.min.js"></script>

<script>
    $(document).ready(function () {
        $(".btn-pref .btn").click(function () {
            $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
            $(".tab").addClass("active"); // instead of this do the below 
            $(this).removeClass("btn-default").addClass("btn-warning");
        });
    });
</script>


<!--for old News-->
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
        };

    })(jQuery, window, document);
</script>
<script>
    $(document).ready(function () {
        $('#characterLeft').text('140 characters left');
        $('#message').keydown(function () {
            var max = 140;
            var len = $(this).val().length;
            if (len >= max) {
                $('#characterLeft').text('You have reached the limit');
                $('#characterLeft').addClass('red');
                $('#btnSubmit').addClass('disabled');
            }
            else {
                var ch = max - len;
                $('#characterLeft').text(ch + ' characters left');
                $('#btnSubmit').removeClass('disabled');
                $('#characterLeft').removeClass('red');
            }
        });
    });


</script>

<script>
    +function ($) {
        'use strict';
        var uploadForm = document.getElementById('js-upload-form');

        var startUpload = function (files) {
            console.log(files)
        }

        uploadForm.addEventListener('submit', function (e) {
            var uploadFiles = document.getElementById('js-upload-files').files;
            e.preventDefault()

            startUpload(uploadFiles)
        })
    }(jQuery);
</script>

<!-- Compost Button-->
<script>
    $('.fab').hover(function () {
        $(this).toggleClass('active');
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>
            /**
             *   I don't recommend using this plugin on large tables, I just wrote it to make the demo useable. It will work fine for smaller tables 
             *   but will likely encounter performance issues on larger tables.
             *
             *		<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
             *		$(input-element).filterTable()
             *		
             *	The important attributes are 'data-action="filter"' and 'data-filters="#table-selector"'
             */
                    (function () {
                        'use strict';
                        var $ = jQuery;
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
            })
                    /* Calendar Table */

                            /**
                             *   I don't recommend using this plugin on large tables, I just wrote it to make the demo useable. It will work fine for smaller tables 
                             *   but will likely encounter performance issues on larger tables.
                             *
                             *		<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
                             *		$(input-element).filterTable()
                             *		
                             *	The important attributes are 'data-action="filter"' and 'data-filters="#table-selector"'
                             */
                                    (function () {
                                        'use strict';
                                        var $ = jQuery;
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
                            })


</script>

</body>
</html>
