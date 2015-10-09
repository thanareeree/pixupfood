var currentTab = 1;
var map, geocoder, marker;
var address = new Array();
var defaultlatlng = {lat: 13.6524931, lng: 100.4938914};
var nearbymarker = [];

$(document).ready(function (e) {
    initMap();
    initFoodBox();
    //initCalendar();
    initRice();
    initFood();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev',
            center: 'title',
            right: 'next today'
        },
        events: {
            url: '/customer/showcalendar.php',
            type: 'POST',
            data: {resid: $(".getResId").val()},
        },
        eventColor: 'orange'
    });

    /* $('#hidecalendarbtn').on('click', function (e) {
     $('#showcalendar').hide();
     });*/
    $(".foodboxtype").click(function () {
        var editid = $(this).attr("id");
        var boxid = editid.replace("foodboxtype", "");
        if (boxid == "1") {
            $('#singleMenuList').hide();
            $('#foodListdata').show();
        } else if (boxid == "2") {
            $('#singleMenuList').hide();
            $('#foodListdata').show();
        } else if (boxid == "3") {
            $('#singleMenuList').hide();
            $('#foodListdata').show();
        } else if (boxid == "4") {
            $('#singleMenuList').show();
            $('#foodListdata').hide();
            $('#ricedatalist').hide();
            $('#skip').show();
        }


    });
    $('#boxamount').change(function (e) {

    });

//Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
        if ($target.parent().hasClass('disabled')) {
            //return false;
        } else {
            currentTab++;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        var a = $active.find("a");
        if (validateTab(a.attr("aria-controls"))) {
            $active.next().removeClass('disabled');
            nextTab($active);
        }
        /*if (a.attr("aria-controls") == "step3") {
         var center = map.getCenter();
         google.maps.event.trigger(map, 'resize');
         map.panTo(center)
         var zoom = map.getZoom();
         map.setZoom(20);
         setTimeout(function () {
         map.setZoom(zoom);
         }, 100);
         }*/
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

function validateTab(tab) {
    if (tab == "step1") {
        var foodbox = $("input[name=foodboxtype]:checked").val();
        var boxamount = $("#boxamount").val();
        if (foodbox == undefined) {
            alert("กรุณาเลือกชนิดกล่องก่อนไปขั้นตอนถัดไป");
            return false;
        }
        if (boxamount.length == 0) {
            alert("กรุณากรอกจำนวนกล่อง");
            return false;
        }
        checkRice();
    } else if (tab == "step2") {
        var foodbox = $("input[name=foodboxtype]:checked").val();
        if (foodbox < 4) {
            var ricetype = $("input[name=ricetype]:checked").val();
            if (ricetype == undefined) {
                alert("กรุณาเลือกชนิดข้าวก่อนไปขั้นตอนถัดไป");
                return false;
            }
        }
        checkFood();
    } else if (tab == "step3") {
        if ($(".foodlist:checked").length == 0) {
            alert("กรุณาเลือกกับข้าวอย่างน้อย 1 รายการ");
            return false;
        }
        checkRest();
    } else if (tab == "step4") {
        //var date = $('#calendar').datepick('getDate');
        var time = $("#delivery_time").val();
        if (date == "") {
            alert("กรุณาเลือกวันที่จัดส่งก่อนไปขั้นตอนถัดไป");
            return false;
        }
        if (time == null) {
            alert("กรุณาเลือกเวลาจัดส่งก่อนไปขั้นตอนถัดไป");
            return false;
        }
        var center = map.getCenter();
        google.maps.event.trigger(map, 'resize');
        map.panTo(center)
        var zoom = map.getZoom();
        map.setZoom(20);
        setTimeout(function () {
            map.setZoom(zoom);
        }, 100);
    } else if (tab == "step5") {
        if ($(".foodlist:checked").length == 0) {
            alert("กรุณาเลือกกับข้าวอย่างน้อย 1 รายการ");
            return false;
        }
        checkRest();
    }
    return true;
}




function initMap() {
    geocoder = new google.maps.Geocoder();

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: defaultlatlng
    });

    marker = new google.maps.Marker({
        position: defaultlatlng,
        map: map,
        draggable: true,
        icon: "/assets/images/pin.png"
    });

    google.maps.event.addListener(marker, 'dragstart', function () {
        marker.setAnimation(null);
    });

    google.maps.event.addListener(marker, 'dragend', function () {
        var pos = marker.getPosition();
        console.log(pos);
        var loca = {lat: pos.H, lng: pos.L};
        processLocation(loca);
    });

    function processLocation(position) {
        $("#showaddress").html('<img src="/assets/images/loader.gif" style="height:30px;">&nbsp;&nbsp;กำลังระบุที่อยู่...');
        marker.setPosition(position);
        map.panTo(position);

        geocoder.geocode({
            latLng: position
        }, function (responses) {
            if (responses && responses.length > 0) {
                setTimeout(function () {
                    $("#showaddress").html(responses[0].formatted_address);
                    $("#savenewaddressbtn").removeAttr("disabled");
                }, 500);
                address = new Array();
                address["full"] = responses[0].formatted_address;
                address["position"] = position;
                $.each(responses[0].address_components, function (i, item) {
                    address[item.types[0]] = item.long_name;
                });
                //console.log(address);


                $.ajax({
                    url: "/order/api/address.php",
                    type: "POST",
                    dataType: "json",
                    data: {"cmd": "getNearBy", "x": address["position"].lat, "y": address["position"].lng},
                    success: function (data) {
                        if (data.result == "1") {
                            for (var i = 0; i < nearbymarker.length; i++) {
                                nearbymarker[i].setMap(null);
                            }
                            nearbymarker.length = 0;
                            $.each(data.nearby, function (i, item) {
                                var loca = {lat: parseFloat(item.x), lng: parseFloat(item.y)};
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: loca,
                                    title: item.name,
                                    icon: "/assets/images/pin_res.png"
                                });
                                var infowindow = new google.maps.InfoWindow({
                                    content: ''
                                });
                                bindInfoWindow(marker, map, infowindow, '<b>' + item.name + "</b><br>" + item.detail);
                                nearbymarker.push(marker);
                            });
                        }
                    }
                });


            } else {
                $("#showaddress").html("No Address Found !");
            }
        });
    }

    $("#getlocationbtn").on("click", function (e) {
        $("#getlocationbtn").attr("disabled", "disabled");
        $("#showaddress").html('<img src="/assets/images/loader.gif" style="height:30px;">&nbsp;&nbsp;กำลังดึงที่อยู่ปัจจุบันของคุณ...');
        navigator.geolocation.getCurrentPosition(getUserLocation);
    });

    function getUserLocation(location) {
        var loc = {lat: location.coords.latitude, lng: location.coords.longitude};
        $("#getlocationbtn").removeAttr("disabled");
        processLocation(loc);
        map.setZoom(10);
    }

    function resetMap() {
        $("#showaddress").html("ลากและวางหมุดตรงที่อยู่ในการจัดส่งของคุณ");
        $("#addresstype").val("0");
        $("#addresstxt").val("");
        map.setZoom(5);
        marker.setPosition(defaultlatlng);
        map.setCenter(defaultlatlng);
        $("#savenewaddressbtn").attr("disabled", "disabled");
        address = new Array();
    }

    $("#addaddressbtn").on("click", function (e) {
        marker.setAnimation(google.maps.Animation.BOUNCE);
        $("#oldaddress").attr("disabled", "disabled");
        $("#oldaddressbtn").show();
        $("#addaddressbtn").hide();
        $("#addressoverlay").fadeOut(200);
        $("#oldaddress").val("0");
        $("#getlocationbtn").show();
        $("#savenewaddressbtn").show();
        resetMap();
    });

    $("#oldaddressbtn").on("click", function (e) {
        $("#oldaddressbtn").hide();
        $("#addaddressbtn").show();
        $("#addressoverlay").fadeIn(200);
        $("#oldaddress").removeAttr("disabled");
        $("#oldaddress").val("0");
        $("#getlocationbtn").hide();
        $("#savenewaddressbtn").hide();
        resetMap();
        marker.setAnimation(null);
    });

    $("#savenewaddressbtn").on("click", function (e) {
        var naming = $("#addresstxt").val();
        var type = $("#addresstype").val();
        if (naming.length > 0 & type != null) {
            $("#addressoverlay").fadeIn(200);
            $("#oldaddressbtn").attr("disabled", "disabled");
            $.ajax({
                url: "/order/api/address.php",
                type: "POST",
                dataType: "json",
                data: {"cmd": "addAddress", "administrative_area_level_1": address.administrative_area_level_1,
                    "sublocality_level_1": address.sublocality_level_1, "sublocality_level_2": address.sublocality_level_2,
                    "full": address.full, "country": address.country,
                    "locality": address.locality, "postal_code": address.postal_code, "route": address.route, "type": type,
                    "address_naming": naming, "latitude": address.position.lat, "longitude": address.position.lng},
                success: function (data) {
                    if (data.result == "1") {
                        $("#oldaddressbtn").removeAttr("disabled");
                        $("#oldaddress").removeAttr("disabled");
                        $("#oldaddressbtn").hide();
                        $("#addaddressbtn").show();
                        $("#getlocationbtn").hide();
                        $("#savenewaddressbtn").hide();
                        marker.setAnimation(null);
                        getOldAddress(true);
                    } else {
                        alert("Error at save Address : " + data.errortext);
                    }
                }
            });
        } else {
            alert("กรุณาเลือกประเภทสถานที่ และ กรุณากรอกชื่อสถานที่ / จุดสังเกต");
        }
    });

    function getOldAddress(selectLastItem) {
        $.ajax({
            url: "/order/api/address.php",
            type: "POST",
            dataType: "json",
            data: {"cmd": "getAddress"},
            success: function (data) {
                if (data.result == "1") {
                    var htmloutput = '<option value="0" disabled selected>เลือกที่อยู่ หรือเพิ่มที่อยู่ใหม่</option>';
                    var lastobj;
                    $.each(data.data, function (i, item) {
                        htmloutput += '<option value="' + item.id + '">' + item.address_naming + '</option>';
                        lastobj = item;
                    });
                    $("#oldaddress").html(htmloutput);
                    if (selectLastItem) {
                        $("#oldaddress").val(lastobj.id);
                    }
                } else {
                    alert("Error at get Address");
                }
            }
        });
    }
    getOldAddress(false);

    $("#oldaddress").on("change", function (e) {

        for (var i = 0; i < nearbymarker.length; i++) {
            nearbymarker[i].setMap(null);
        }
        nearbymarker.length = 0;

        var id = $(this).val();
        $.ajax({
            url: "/order/api/address.php",
            type: "POST",
            dataType: "json",
            data: {"cmd": "getDetail", "id": id},
            success: function (data) {
                if (data.result == "1") {
                    var loc = {lat: parseFloat(data.data.latitude), lng: parseFloat(data.data.longitude)};
                    $("#addresstype").val(data.data.type);
                    $("#addresstxt").val(data.data.address_naming);
                    $("#showaddress").html(data.data.full_address);
                    marker.setPosition(loc);
                    map.setCenter(loc);
                    map.setZoom(16);
                    $.each(data.nearby, function (i, item) {
                        var loca = {lat: parseFloat(item.x), lng: parseFloat(item.y)};
                        var marker = new google.maps.Marker({
                            map: map,
                            position: loca,
                            title: item.name,
                            icon: "/assets/images/pin_res.png"
                        });
                        var infowindow = new google.maps.InfoWindow({
                            content: ''
                        });
                        bindInfoWindow(marker, map, infowindow, '<b>' + data.name + "</b><br>" + data.detail);
                        nearbymarker.push(marker);
                    });
                } else {
                    alert("Error at get Detail");
                }
            }
        });
    });

    var bindInfoWindow = function (marker, map, infowindow, html) {
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(html);
            infowindow.open(map, marker);
        });
    }
}

function initFoodBox() {
    $(".foodbox").hide().on("click", function (e) {
        e.stopPropagation();
    });
    $(".foodboxselect").on("click", function (e) {
        $(".foodboxselect").removeClass("selected");
        $(this).addClass("selected").find(".foodbox").click();
    });

    var foodboxtype = $("input[name=foodboxtype]:checked").val();
}

function initRice() {
    $(".rice").hide().on("click", function (e) {
        e.stopPropagation();
    });
    $(".riceselect").on("click", function (e) {
        $(".riceselect").removeClass("selected");
        $(this).addClass("selected").find(".rice").click();
    });

    var foodboxtype = $("input[name=rice]:checked").val();
}

function checkRice() {
    var foodboxtype = $("input[name=foodboxtype]:checked").val();
    if (foodboxtype >= 4) {
        $("#norice").show();
        $(".riceselect").removeClass("selected");
    } else {
        $("#norice").hide();
    }
}

function initFood() {
    //:(
}

function checkFood() {
    $("#showfood").html("<h3 style='margin:0 auto;'>กำลังดึงข้อมูลรายการอาหาร</h3>");
    var resid = $(".getResId").val();
    $.ajax({
        url: "/order/normal/getFoodList.php",
        type: "POST",
        dataType: "html",
        data: {"boxtype": $("input[name=foodboxtype]:checked").val(), "resid": resid},
        success: function (data) {
            $("#showfood").html("");
            $("#showfood").append(data);


            $('.foodlist[value="' + getUrlParameter("menuId") + '"]').attr('checked', 'checked');

            $(".foodlist").on("change", function (e) {
                var foodboxtype = $("input[name=foodboxtype]:checked").val();
                if (foodboxtype >= 4) {
                    foodboxtype = 1;
                }
                if ($(".foodlist:checked").length > foodboxtype) {
                    alert("คุณเลือกกับข้าวเกินจำนวนรายการของกล่อง");
                    $(this).removeAttr('checked');
                    return false;
                }
            });

            $.each($(".foodlist:checked"), function (i, item) {
                if (getUrlParameter("menuId") != $(item).val()) {
                    $(item).removeAttr("checked");
                }
            });
        }
    });

    var foodboxtype = $("input[name=foodboxtype]:checked").val();
    if (foodboxtype >= 4) {
        $("#showcount").html("1");
    } else {
        $("#showcount").html(foodboxtype);
    }
}


function initRest() {

}

function checkRest() {
    $("#showrest").html("<h2 style='margin:0 auto; margin-top:50px; margin-bottom:50px;'>กำลังค้นหาร้านอาหาร...</h2>");
    var data = {'food[]': []};
    $(".foodlist:checked").each(function () {
        data['food[]'].push($(this).val());
    });
    data['boxtype'] = $("input[name=foodboxtype]:checked").val();
    if (data['boxtype'] != 4) {
        data['ricetype'] = $("input[name=ricetype]:checked").val();
    }
    data['amtbox'] = $("#boxamount").val();
    data['address'] = $("#oldaddress").val();
    $.ajax({
        url: "/order/api/getRest.php",
        type: "POST",
        dataType: "html",
        data: data,
        success: function (data) {
            $("#showrest").html(data);
        }
    });
}



var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
/*
 function initCalendar() {
 $("#calendar_datepick").datepick({
 minDate: new Date(),
 onChangeMonthYear: function (year, month) {
 setTimeout(function () {
 $(".datepick").css("width", "407px");
 }, 0);
 },
 onSelect: function (dates) {
 setTimeout(function () {
 $(".datepick").css("width", "407px");
 }, 0);
 }
 });
 $(".datepick").css("width", "407px");
 }*/

