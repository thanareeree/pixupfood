var lat = "";
var long = "";
$(document).ready(function () {

    startMap();
    $('.favunlogin').tooltip();
    $("#searchby").on("change", function (e) {
        var searchby = $(this).val();
        if (searchby == "foodname") {
            $("#foodtype").val("all");
            $("#foodtype").removeAttr("disabled");
        } else {
            $("#foodtype").val(0);
            $("#foodtype").attr("disabled", "disabled");
        }
    });
    $("#searchtxt").on("keyup", function (e) {
        if (e.keyCode == 13) {
            $("#searchbtn").click();
        }
    });
    $("input[type=checkbox]").removeAttr("checked");
    $("#searchbtn").on("click", function (e) {
        $("#result").html('<tr><td colspan="3" style="text-align: center;"><h2>Searching...</h2></td></tr>');
        var searchby = $("#searchby").val();
        var foodtype = $("#foodtype").val();
        var searchtxt = $("#searchtxt").val();
        $("input[type=checkbox]").removeAttr("checked");
        $.ajax({
            url: "/customer/ajax_search.php",
            type: 'POST',
            dataType: 'html',
            data: {"searchby": searchby, "foodtype": foodtype, "searchtxt": searchtxt, "lat": lat, "long": long},
            success: function (data, textStatus, jqXHR) {
                $("#showsearchtext").html(searchtxt);
                $("#result").html(data);
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });
    $("input[type=checkbox]").on("click", function (e) {
        $("#result").html('<tr><td colspan="3" style="text-align: center;"><h2>Searching...</h2></td></tr>');
        var searchoption = $("input:checked").val();
        $.ajax({
            url: "/customer/ajax_search_option.php",
            type: 'POST',
            dataType: 'html',
            data: {"searchoption": searchoption},
            success: function (data, textStatus, jqXHR) {
                $("#result").html(data);
                $('[data-toggle="tooltip"]').tooltip();
                
            }
        });
    });
    $(".favmenu").on("click", function (e) {
        var elem_span = $(this).find('span');
        var elem_i = $(this).find('i');
        var menuid = $(elem_i).attr("data-menuid");
        var favid = $(elem_i).attr("data-favid");
        if (favid == "") {
            $.ajax({
                url: "/customer/favorite.php?menuid=" + menuid,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.result == "1") {
                        $(elem_span).removeClass("unfav");
                        $(elem_i).removeClass("unfav");
                        $(elem_span).addClass("faved");
                        $(elem_i).addClass("faved");
                        $(elem_i).attr("data-favid", data.favid);
                        console.log(menuid);
                    } else {
                        

                    }
                }
            });
        } else {
            $.ajax({
                url: "/customer/unfavorite.php?favid=" + favid,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.result == "1") {
                        $(elem_span).removeClass("faved");
                        $(elem_i).removeClass("faved");
                        $(elem_span).addClass("unfav");
                        $(elem_i).addClass("unfav");
                        $(elem_i).attr("data-favid", "");
                        console.log(menuid);
                    } else {
                        alert(data.error);
                    }

                }
            });
        }

    });
});
function startMap() {

    map = new google.maps.Map(document.getElementById("map"));
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getPosition);
        //navigator.geolocation.watchPosition(updatePosition);
    } else {
        lat = "";
        long = "";
    }
}

function getPosition(pos) {
    globalPosition = pos;
    lat = pos.coords.latitude;
    long = pos.coords.longitude;
    // alert($("#latinput").val() + "\n" + $("#longinput").val());
    console.log(pos);
}