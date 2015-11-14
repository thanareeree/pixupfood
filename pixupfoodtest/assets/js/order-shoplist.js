var currentTab = 1;
var map, geocoder, marker;
var address = new Array();
var defaultlatlng = {lat: 13.6524931, lng: 100.4938914};
var nearbymarker = [];

$(document).ready(function (e) {
    initMap();

    initCalendar();

    showOrderDatail();
    fetchCalendar();

    $('[data-toggle="tooltip"]').tooltip();
    $('.calendar').fullCalendar({
        header: {
            left: 'prev',
            center: 'title',
            right: 'next today'
        },
        events: JSON.parse(json_events),
        lang: 'th',
        eventColor: 'orange',
        eventLimit: true,
        eventAfterRender: function (event, element, view) {
            if (event.status == 0) {
                //event.color = "#FFB347"; //Em andamento
                element.css('background-color', 'red');
                element.css('border-color', 'red');
            }
        }
    });



    $("#nextstep5").on('click', function (e) {
        $('#showcalendar').hide();
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
    if (tab == "step4") {
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
            $("#errorStep5").show();
            return false;
        }
        if (time == null) {
            $("#errorStep5").html(' <div class="alert alert-danger" role="alert" style="margin-top: 30px;">' +
                    '<p style="color: red;"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกเวลาจัดส่งก่อนไปขั้นตอนถัดไป</p></div>');
            $("#errorStep5").show();
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
                    $("#addressinput").removeAttr("disabled");
                    $("#addressinput").html("");
                    $("#addressinput").val("");
                    $("#addressinput").val(responses[0].formatted_address);
                    $("#showaddress").html("");
                    //$("#showaddress").html(responses[0].formatted_address);
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
                    "full": $("#addressinput").val(), "country": address.country,
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
                    $("#addressinput").attr("disabled", "disabled");
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
                    $("#addressinput").attr("disabled", "disabled");
                    //$("#addressinput").removeAttr("disabled");
                    $("#addressinput").html("");
                    $("#addressinput").val("");
                    $("#addressinput").val(data.data.full_address);
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
                    $("#addressinput").attr("disabled", "disabled");
                    // $("#addressinput").removeAttr("disabled");
                    $("#addressinput").html("");
                    $("#addressinput").val("");
                    $("#addressinput").val(data.data.full_address);
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
            $("#confirm_orderbtn").attr("disabled", "disabled");
            return false;
        } else {
            $('#errorChangeQty').html("");
            $("#confirm_orderbtn").removeAttr("disabled");
        }

        $.ajax({
            url: "/order/normal/changeQuantity.php",
            type: "POST",
            data: {"id": id, "newqty": newqty},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    showOrderDatail();
                    checkCalendarOrder();
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
    var date = $('#calendar').datepick('getDate')[0];
    //console.log(date);
    $.ajax({
        url: "/order/normal/checkCalendarOrder.php",
        type: "POST",
        dataType: "json",
        data: {"resid": $(".getResId").val(), "date": date},
        success: function (data) {
            if (data.result == "3") {
               // alert(data.error);
              //  $("#errorStep5").html("");
                  $("#errorStep5").children().remove();
                $("#errorStep5").show();
                $("#errorStep5").html(' <div class="alert alert-danger" role="alert" style="margin-top: 30px;">' +
                        '<p style="color: red;"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                        '&nbsp;' + data.error + '<br></p></div>');
                //  alert(data.error);
                $("#nextstep5").attr("disabled", "disabled");
            } else if (data.result == "1") {
                $("#errorStep5").children().remove();
                $("#errorStep5").hide();
                $("#nextstep5").removeAttr("disabled");
            } 

        }
    });

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