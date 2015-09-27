// 1
        $(document).ready(function () {
            var activeSystemClass = $('.list-group-item.active');

            //something is entered in search form
            $('#system-search').keyup(function () {
                var that = this;
                // affect all table rows on in systems table
                var tableBody = $('.table-list-search tbody');
                var tableRowsClass = $('.table-list-search tbody tr');
                $('.search-sf').remove();
                tableRowsClass.each(function (i, val) {

                    //Lower text for case insensitive
                    var rowText = $(val).text().toLowerCase();
                    var inputText = $(that).val().toLowerCase();
                    if (inputText != '')
                    {
                        $('.search-query-sf').remove();
                        tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>ผลลัพท์ของ: "'
                                + $(that).val()
                                + '"</strong></td></tr>');
                    }
                    else
                    {
                        $('.search-query-sf').remove();
                    }

                    if (rowText.indexOf(inputText) == -1)
                    {
                        //hide rows
                        tableRowsClass.eq(i).hide();

                    }
                    else
                    {
                        $('.search-sf').remove();
                        tableRowsClass.eq(i).show();
                    }
                });
                //all tr elements are hidden
                if (tableRowsClass.children(':visible').length == 0)
                {
                    tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="12">ไม่พบข้อมูล</td></tr>');
                }
            });
        });
        
// 2
 $(document).ready(function () {
            var activeSystemClass = $('.list-group-item.active');

            //something is entered in search form
            $('#system-search2').keyup(function () {
                var that = this;
                // affect all table rows on in systems table
                var tableBody = $('.table-list-search2 tbody');
                var tableRowsClass = $('.table-list-search2 tbody tr');
                $('.search-sf2').remove();
                tableRowsClass.each(function (i, val) {

                    //Lower text for case insensitive
                    var rowText = $(val).text().toLowerCase();
                    var inputText = $(that).val().toLowerCase();
                    if (inputText != '')
                    {
                        $('.search-query-sf2').remove();
                        tableBody.prepend('<tr class="search-query-sf2"><td colspan="6"><strong>ผลลัพท์ของ: "'
                                + $(that).val()
                                + '"</strong></td></tr>');
                    }
                    else
                    {
                        $('.search-query-sf2').remove();
                    }

                    if (rowText.indexOf(inputText) == -1)
                    {
                        //hide rows
                        tableRowsClass.eq(i).hide();

                    }
                    else
                    {
                        $('.search-sf2').remove();
                        tableRowsClass.eq(i).show();
                    }
                });
                //all tr elements are hidden
                if (tableRowsClass.children(':visible').length == 0)
                {
                    tableBody.append('<tr class="search-sf2"><td class="text-muted" colspan="12">ไม่พบข้อมูล</td></tr>');
                }
            });
        });
        
//3
$(document).ready(function () {
            var activeSystemClass = $('.list-group-item.active');

            //something is entered in search form
            $('#system-search3').keyup(function () {
                var that = this;
                // affect all table rows on in systems table
                var tableBody = $('.table-list-search3 tbody');
                var tableRowsClass = $('.table-list-search3 tbody tr');
                $('.search-sf3').remove();
                tableRowsClass.each(function (i, val) {

                    //Lower text for case insensitive
                    var rowText = $(val).text().toLowerCase();
                    var inputText = $(that).val().toLowerCase();
                    if (inputText != '')
                    {
                        $('.search-query-sf3').remove();
                        tableBody.prepend('<tr class="search-query-sf3"><td colspan="6"><strong>ผลลัพท์ของ: "'
                                + $(that).val()
                                + '"</strong></td></tr>');
                    }
                    else
                    {
                        $('.search-query-sf3').remove();
                    }

                    if (rowText.indexOf(inputText) == -1)
                    {
                        //hide rows
                        tableRowsClass.eq(i).hide();

                    }
                    else
                    {
                        $('.search-sf3').remove();
                        tableRowsClass.eq(i).show();
                    }
                });
                //all tr elements are hidden
                if (tableRowsClass.children(':visible').length == 0)
                {
                    tableBody.append('<tr class="search-sf3"><td class="text-muted" colspan="12">ไม่พบข้อมูล</td></tr>');
                }
            });
        });
        
        //4
$(document).ready(function () {
            var activeSystemClass = $('.list-group-item.active');

            //something is entered in search form
            $('#system-search4').keyup(function () {
                var that = this;
                // affect all table rows on in systems table
                var tableBody = $('.table-list-search4 tbody');
                var tableRowsClass = $('.table-list-search4 tbody tr');
                $('.search-sf4').remove();
                tableRowsClass.each(function (i, val) {

                    //Lower text for case insensitive
                    var rowText = $(val).text().toLowerCase();
                    var inputText = $(that).val().toLowerCase();
                    if (inputText != '')
                    {
                        $('.search-query-sf4').remove();
                        tableBody.prepend('<tr class="search-query-sf4"><td colspan="6"><strong>ผลลัพท์ของ: "'
                                + $(that).val()
                                + '"</strong></td></tr>');
                    }
                    else
                    {
                        $('.search-query-sf4').remove();
                    }

                    if (rowText.indexOf(inputText) == -1)
                    {
                        //hide rows
                        tableRowsClass.eq(i).hide();

                    }
                    else
                    {
                        $('.search-sf4').remove();
                        tableRowsClass.eq(i).show();
                    }
                });
                //all tr elements are hidden
                if (tableRowsClass.children(':visible').length == 0)
                {
                    tableBody.append('<tr class="search-sf4"><td class="text-muted" colspan="12">ไม่พบข้อมูล</td></tr>');
                }
            });
        });