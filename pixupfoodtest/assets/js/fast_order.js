var currentTab = 1;
$(document).ready(function (e) {

    initMap();
    initFoodBox();
    initCalendar();
    initRice();
    initFood();
    priority();



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



    $("#placeorderbtn").on("click", function (e) {
        if ($(".restselect:checked").length == 0) {
            alert("กรุณาเลือกร้านอาหารอย่างน้อย 1 ร้าน");
            return false;
        } else {
            $("#paymentmodal").modal("show");
        }
    });

    $("#confirmorderbtn").on("click", function (e) {
        if ($("input[name=paymentData]:checked").length == 0) {
            alert("กรุณาเลือกวิธีชำระเงิน");
            return false;
        } else {
            saveOrder();
        }
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
        var addressid = $("#oldaddress").val();
        if (addressid == null) {
            $("#errorStep1").html(' <div class="alert alert-danger" role="alert" style="margin-top: 30px;">' +
                    '<p style="color: red;"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกที่อยู่ก่อนไปขั้นตอนถัดไป</p></div>');
            return false;
        }
         $("#errorStep1").html("");
    } else if (tab == "step2") {
        var date = $('#calendar').datepick('getDate');
        var time = $("#delivery_time").val();
        if (date == "") {
          $("#errorStep2").html(' <div class="alert alert-danger" role="alert" style="margin-top: 30px;">' +
                    '<p style="color: red;"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกวันที่จัดส่งก่อนไปขั้นตอนถัดไป</p></div>');
            return false;
        }
        if (time == null) {
             $("#errorStep2").html(' <div class="alert alert-danger" role="alert" style="margin-top: 30px;">' +
                    '<p style="color: red;"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกเวลาจัดส่งก่อนไปขั้นตอนถัดไป</p></div>');
            return false;
        }
        $("#errorStep2").html("");
    } else if (tab == "step3") {
        var foodbox = $("input[name=foodboxtype]:checked").val();
        var boxamount = $("#boxamount").val();
        if (foodbox == undefined) {
           $("#errorStep3").html(' <div class="alert alert-danger" role="alert">' +
                    '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกชนิดกล่องก่อนไปขั้นตอนถัดไป</p></div>');
            return false;
        }
        if (boxamount.length == 0) {
           $("#errorStep3").html(' <div class="alert alert-danger" role="alert">' +
                    '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณากรอกจำนวนกล่อง</p></div>');
            return false;
        }
        $("#errorStep3").html("");
        checkRice();
    } else if (tab == "step4") {
        var foodbox = $("input[name=foodboxtype]:checked").val();
        if (foodbox != 4) {
            var ricetype = $("input[name=ricetype]:checked").val();
            if (ricetype == undefined) {
                $("#errorStep4").html(' <div class="alert alert-danger" role="alert">' +
                        '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                        '&nbsp;กรุณาเลือกชนิดข้าวก่อนไปขั้นตอนถัดไป</p></div>');
                return false;
            }
        }
         $("#errorStep4").html("");
        checkFood();
    } else if (tab == "step5") {
        if ($(".foodlist:checked").length == 0) {
            $("#errorStep5").html(' <div class="alert alert-danger" role="alert">' +
                    '<p style="color: red"><i class="glyphicon glyphicon-exclamation-sign"></i>' +
                    '&nbsp;กรุณาเลือกอย่างน้อย 1 รายการ</p></div>');
            return false;
        }
         $("#errorStep5").html("");
        checkRest();
    }
    return true;
}



var map, geocoder, marker;
var address = new Array();
var defaultlatlng = {lat: 13.6524931, lng: 100.4938914};
var nearbymarker = [];
function initMap() {
    geocoder = new google.maps.Geocoder();

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: defaultlatlng
    });

    marker = new google.maps.Marker({
        position: map.getCenter(),
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
        map.setZoom(16);
    }

    function resetMap() {
        $("#showaddress").html("ลากและวางหมุดตรงที่อยู่ในการจัดส่งของคุณ");
        $("#addresstype").val("0");
        $("#addresstxt").val("");
        map.setZoom(12);
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

function initCalendar() {
    $("#calendar").datepick({
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
    if (foodboxtype == 4) {
        $("#norice").show();
    } else {
        $("#norice").hide();
    }
}

function initFood() {
    //:(
}

function checkFood() {
    $("#showfood").html("<h3 style='margin:0 auto;'>กำลังดึงข้อมูลรายการอาหาร</h3>");
    $.ajax({
        url: "/order/api/getFood.php",
        type: "POST",
        dataType: "json",
        data: {"boxtype": $("input[name=foodboxtype]:checked").val()},
        success: function (data) {
            $("#showfood").html("");
            $.each(data, function (i, food) {
                var output = '<div class="col-md-2"><div class="thumbnail"><a href="#">';
                output += '<img class="menu_img" src="' + food.img + '" style="max-height: 101px;min-height: 101px"></a>';
                output += '<div class="caption"><h4>' + food.name + '</h4>';
                output += '<p style="text-align: right"><input type="checkbox" name="foodlist[]" class="foodlist" value="' + food.id + '"></p>';
                output += '</div></div></div>';
                $("#showfood").append(output);
            });

            $('.foodlist[value="' + getUrlParameter("menuSetId") + '"]').attr('checked', 'checked');

            $(".foodlist").on("change", function (e) {
                var foodboxtype = $("input[name=foodboxtype]:checked").val();
                if (foodboxtype == 4) {
                    foodboxtype = 1;
                }
                if ($(".foodlist:checked").length > foodboxtype) {
                    alert("คุณเลือกกับข้าวเกินจำนวนรายการของกล่อง");
                    $(this).removeAttr('checked');
                    return false;
                }
            });

            $.each($(".foodlist:checked"), function (i, item) {
                if (getUrlParameter("menuSetId") != $(item).val()) {
                    $(item).removeAttr("checked");
                }
            });
        }
    });

    var foodboxtype = $("input[name=foodboxtype]:checked").val();
    if (foodboxtype == 4) {
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

function saveOrder() {
    var data = {'food[]': [], 'rest[]': [], 'priority[]':[], 'value[]':[]};
    $(".foodlist:checked").each(function () {
        data['food[]'].push($(this).val());
    });
    $(".restselect:checked").each(function () {
        var str = $(this).val();
        var restid = str.substring(1);
        var pri = str.substring(0,1);
        data['rest[]'].push(restid);
        data['priority[]'].push(pri);
    });
    data['boxtype'] = $("input[name=foodboxtype]:checked").val();
    if (data['boxtype'] != 4) {
        data['ricetype'] = $("input[name=ricetype]:checked").val();
    }
    data['amtbox'] = $("#boxamount").val();
    data['address'] = $("#oldaddress").val();
    data['date'] = $('#calendar').datepick('getDate')[0];
    data['time'] = $("#delivery_time").val();
    data['moretext'] = $("#moretext").val();
    data['payment'] = $("input[name=paymentData]:checked").val();

    $.ajax({
        url: "/order/api/saveOrder.php",
        type: "POST",
        dataType: "html",
        data: data,
        success: function (data) {
           // alert(data); 
            $("#paymentmodal").modal("hide");
              $("#saveOrderSuccessModal").modal('show');
             
          
        }
    });
}

function priority(){
  //  $(".foodlist:checked")
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