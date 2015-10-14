var currentTab = 1;
var map, geocoder, marker;
var address = new Array();
var defaultlatlng = {lat: 13.6524931, lng: 100.4938914};
var nearbymarker = [];

$(document).ready(function (e) {
    initMap();
    initFoodBox();
    initCalendar();
    initRice();
    initFood();
    showOrderDatail();
    fetchCalendar();

    $('.calendar').fullCalendar({
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



    $("#nextstep5").on('click', function (e) {
        $('#showcalendar').hide();
    });

    $("#add_order").on('click', function (e) {
        if ($(".foodlist:checked").length == 0) {
            $("#errorStep3").html(' <div class="alert alert-danger" role="alert">' +
                    '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกอย่างน้อย 1 รายการ</p></div>');

            return false;
        } else {

            $("#errorStep3").html("");
            saveOrderDetail();
            $('#addNewOrder').show();
            $("#checkout").removeAttr("disabled");
            $("#checkout").show();
            $("#addMenuSuccess").show();
            $("#add_order").hide();
            $('#prevstep3').hide();
            //$('.foodlist').attr("disabled", "disabled");
        }

    });

    $("#prevstep3").click(function (e) {
        $("#errorStep3").html("");
    });


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

    $("#addNewOrder").click(function (e) {
        document.location.reload();
    });
    $("#confirm_orderbtn").on("click", function (e) {
        if ($("input[name=paymentData]:checked").length == 0) {
            $("#errorStep6").html(' <div class="alert alert-danger" role="alert">' +
                    '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกวิธีชำระเงิน</p></div>');

            return false;
        }
        $("#errorStep6").html("");
        saveOrder();
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
    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);
    });

    $('#calendar').click(function (e) {
        checkCalendarOrder();
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
            $("#errorStep1").html(' <div class="alert alert-danger" role="alert">' +
                    '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกชนิดกล่องก่อนไปขั้นตอนถัดไป</p></div>');
            return false;
        }
        if (boxamount.length == 0) {
            $("#errorStep1").html(' <div class="alert alert-danger" role="alert">' +
                    '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณากรอกจำนวนกล่อง</p></div>');

            return false;
        }
        var minimum = $('.getBoxMinimum').val();
        var boxamt = $('#boxamount').val();
        if (parseInt(boxamt) < parseInt(minimum)) {
            $("#errorStep1").html(' <div class="alert alert-danger" role="alert">' +
                    '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;ขั้นต่ำ ' + minimum + ' ชุด/รายการอาหาร</p></div>');
            return false;
        }
        $("#errorStep1").html("");
        checkRice();
    } else if (tab == "step2") {
        var foodbox = $("input[name=foodboxtype]:checked").val();
        if (foodbox < 4) {
            var ricetype = $("input[name=ricetype]:checked").val();
            if (ricetype == undefined) {
                $("#errorStep2").html(' <div class="alert alert-danger" role="alert">' +
                        '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                        '&nbsp;กรุณาเลือกชนิดข้าวก่อนไปขั้นตอนถัดไป</p></div>');

                return false;
            }
            $("#errorStep2").html("");
        }
        $('#addNewOrder').hide();
        $("#addMenuSuccess").hide();
        checkFood();
        checkOrder();
    } else if (tab == "step3") {
       

    } else if (tab == "step4") {
        var addressid = $("#oldaddress").val();
        if (addressid == null) {
            $("#errorStep4").html(' <div class="alert alert-danger" role="alert" style="margin-top: 30px;">' +
                    '<p style="color: red;"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกที่อยู่ก่อนไปขั้นตอนถัดไป</p></div>');

            return false;
        }
        $("#errorStep4").html("");
        $("#nextstep4").removeAttr("disabled");
    } else if (tab == "step5") {
        var date = $('#calendar').datepick('getDate');
        var time = $("#delivery_time").val();
        if (date == "") {
            $("#errorStep5").html(' <div class="alert alert-danger" role="alert" style="margin-top: 30px;">' +
                    '<p style="color: red;"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกวันที่จัดส่งก่อนไปขั้นตอนถัดไป</p></div>');
            return false;
        }
        if (time == null) {
            $("#errorStep5").html(' <div class="alert alert-danger" role="alert" style="margin-top: 30px;">' +
                    '<p style="color: red;"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกเวลาจัดส่งก่อนไปขั้นตอนถัดไป</p></div>');
            return false;
        }
        $("#errorStep5").html("");
    } else if (tab == "step6") {

    }
    return true;
}

function  fetchCalendar() {
    $.ajax({
        url: '/api/showcalendar.php',
        type: 'POST',
        data: {"resid": $(".getResId").val(), "type": "fetch"},
        async: false,
        success: function (response) {
            json_events = response;
        }
    });
}

function initMap() {
    geocoder = new google.maps.Geocoder();

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
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
        var loca = {lat: pos.lat(), lng: pos.lng()};
        processLocation(loca);
    });

    function processLocation(position) {
        $("#showaddress").html('<img src="/assets/images/loader.gif" style="width: 20px;height:20px;">&nbsp;&nbsp;กำลังระบุที่อยู่...');
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
        map.setZoom(13);
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
        var resid = $(".getResId").val();
        var id = $(this).val();
        $.ajax({
            url: "/order/api/addressNormalOrder.php",
            type: "POST",
            dataType: "json",
            data: {"cmd": "getDetail", "id": id, "resid": resid},
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
                    $("#errorStep4").html("");
                    $("#errorStep4").html(' <div class="alert alert-danger" role="alert" style="margin-top: 30px;">' +
                            '<p style="color: red;"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                            '&nbsp;' + data.districtName + '&nbsp;อยู่นอกเขตพื้นที่จัดส่งของร้าน</p></div>');

                    $("#nextstep4").attr("disabled", "disabled");


                } else if (data.result == "2") {
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
                    $("#errorStep4").html("");
                    $("#nextstep4").removeAttr("disabled");
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

function checkAmtboxMinimum() {
    var resid = $(".getResId").val();

    $.ajax({
        url: "/order/normal/check_cart_order.php",
        type: "POST",
        dataType: "json",
        data: {"resid": resid},
        success: function (data) {
            if (data.result == "0") {

            } else {

            }
        }
    });
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
    var moretext = $("input[name=foodboxtype]:checked").val();
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

            if (moretext <= 4) {
                $("#showMoretext").show();
            } else {
                $("#showMoretext").hide();
            }
        }
    });

    var foodboxtype = $("input[name=foodboxtype]:checked").val();
    if (foodboxtype >= 4) {
        $("#showcount").html("1");
    } else {
        $("#showcount").html(foodboxtype);
    }
}


function checkOrder() {
    var resid = $(".getResId").val();
    var cusid = $(".getCusId").val();
    $.ajax({
        url: "/order/normal/check_cart_order.php",
        type: "POST",
        dataType: "json",
        data: {"cusid": cusid, "resid": resid},
        success: function (data) {
            if (data.result == "0") {
                $("#checkout").attr("disabled", "disabled");
            } else {
                $("#checkout").removeAttr("disabled");
            }
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

function showOrderDatail() {
    var resid = $(".getResId").val();
    var cusid = $(".getCusId").val();
    $.ajax({
        url: "/order/normal/cart_order.php",
        type: "POST",
        dataType: "html",
        data: {"cusid": cusid, "resid": resid},
        success: function (data) {
            $("#showOrderDetail").html(data);
            $('[data-toggle="tooltip"]').tooltip();
            blindDelete();
            changeQuantity();
        }
    });
}

function blindDelete() {
    $('#menuOrderList').on('click', '.remove_cart', function (e) {
        var orderDetailId = $(this).attr("id");
        var id = orderDetailId.replace("remove_cart", "");
        $.ajax({
            url: "/order/normal/removeOrderDetail.php",
            type: "POST",
            data: {"id": id},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    showOrderDatail();
                } else {
                    alert(data.error);
                }
            }
        });
    });
}

function changeQuantity() {
    $('#menuOrderList').on('change', '.qty', function (e) {
        var orderDetailId = $(this).attr("id");
        var id = orderDetailId.replace("qty", "");
        var newqty = $(this).val();
        var minimum = $('.getBoxMinimum').val();

        if (parseInt(newqty) < parseInt(minimum)) {
            $("#errorChangeQty").html(' <div class="alert alert-danger" role="alert">' +
                    '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;จำนวนชุดน้อยกว่าจำนวนขั้นต่ำที่ร้านกำหนดไว้</p></div>');
            return false;
        }

        $.ajax({
            url: "/order/normal/changeQuantity.php",
            type: "POST",
            data: {"id": id, "newqty": newqty},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    showOrderDatail();
                    $('#errorChangeQty').html("");
                } else {
                    alert(data.error);
                }
            }
        });
    });


}

function initCalendar() {

    $("#calendar").datepick({
        minDate: new Date(),
        onChangeMonthYear: function (year, month) {
            setTimeout(function () {
                $(".datepick").css("width", "245px");
            }, 0);
        },
        onSelect: function (dates) {
            setTimeout(function () {
                $(".datepick").css("width", "245px");
            }, 0);
        }
    });
    $(".datepick").css("width", "245px");


}

function checkCalendarOrder() {
    //  var date = $('#calendar').datepick('getDate');

}

function saveOrderDetail() {
    var data = {'food[]': []};
    $(".foodlist:checked").each(function () {
        data['food[]'].push($(this).val());
    });
    data['boxtype'] = $("input[name=foodboxtype]:checked").val();
    if (data['boxtype'] < 4) {
        data['ricetype'] = $("input[name=ricetype]:checked").val();
    }
    data['amtbox'] = $("#boxamount").val();
    data['resid'] = $(".getResId").val();
    data['moretext'] = $("#moretext").val();
    $.ajax({
        url: "/order/normal/saveOrderDetail.php",
        type: "POST",
        dataType: "json",
        data: data,
        success: function (data) {

            if (data.result == "1") {
                showOrderDatail();
                $(".foodlist:checked").removeAttr('checked');
                $(".riceselect").removeClass("selected");
                $(".foodboxselect").removeClass("selected");
                $("#boxamount").val("");
                $("#moretext").val("");
            } else {
                alert(data.error);

            }
        }
    });

}

function saveOrder() {
    var data = {'payment[]': []};
    data['resid'] = $(".getResId").val();
    data['address'] = $("#oldaddress").val();
    data['date'] = $('#calendar').datepick('getDate')[0];
    data['time'] = $("#delivery_time").val();
    data['payment[]'] = $("input[name=paymentData]:checked").val();

    $.ajax({
        url: "/order/api/saveNormalOrder.php",
        type: "POST",
        dataType: "html",
        data: data,
        success: function (data) {
            $("#saveOrderSuccessModal").modal('show');
            // document.location = "/";
        }
    });
}