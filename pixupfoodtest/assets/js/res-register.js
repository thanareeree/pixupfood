
var map, geocoder, marker;
var address = new Array();
var defaultlatlng = {lat: 13.6524931, lng: 100.4938914};
$(document).ready(function () {
    //initMap();
     $('#termsmodal').modal({
     backdrop: 'static',
     keyboard: false
     });
    $("#termsmodal").modal('show');

    $("input[type=checkbox]").on("click", function (e) {
        $("#nextregisbtn").removeAttr("disabled");
    });
    $("#nextregisbtn").click(function (e) {
        $("#termsmodal").modal('hide');
    });

    $("#resemail").on("keyup", function (e) {
        $.ajax({
            type: "POST",
            url: "/register/check-mail-restaurant.php",
            data: {"resemail": $("#resemail").val()},
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                    $(".errorEmail").show();
                    $("#nextbtn").attr("disabled", "disabled");
                } else if (data.result == "0") {
                    $(".errorEmail").hide();
                    checkValidEmail();
                }
            }
        });
    });


    $("#resphone").on("keyup", function (e) {
        checkPhone();
    });

    $("#resconfirmpwd").on("keyup", function (e) {
        checkPasswordMatching();
    });

    $("#nextbtn").on("click", function (e) {
        checkPhone();
        checkPasswordMatching();
        checkValidEmail();
        if ($("#resemail").val() == "" || $("#respassword").val() == "" ||
                $("#resconfirmpwd").val() == "" || $("#resphone").val() == "" ||
                $("#resfname").val() == "" || $("#reslname").val() == "") {
            alert("กรอกข้อมูลไม่ครบ");
            $("#nextbtn").add("disabled");


        } else {
            initMap();
            $(".firststep").hide();
            $(".secondstep").fadeIn(500);
        }

    });
    $("#backbtn").on("click", function (e) {
        $(".firststep").fadeIn(500);
        $(".secondstep").hide();
    });

    $("#restaurantformregis").on("submit", function (e) {

        $.ajax({
            type: "POST",
            url: "/restaurant/restaurant-save.php",
            data: {"resemail": $("#resemail").val(),
                "respassword": $("#respassword").val(),
                "resfname": $("#resfname").val(),
                "reslname": $("#reslname").val(),
                "resphone": $("#resphone").val(),
                "restaurantname": $("#restaurantname").val(),
                "detail": $("#detail").val(),
                "planlist": $("#planlist").val(),
                "administrative_area_level_1": address.administrative_area_level_1,
                "sublocality_level_1": address.sublocality_level_1,
                "sublocality_level_2": address.sublocality_level_2,
                "full": $("#resaddress").val(),
                "country": address.country,
                "locality": address.locality,
                "postal_code": address.postal_code,
                "route": address.route,
                "latitude": address.position.lat,
                "longitude": address.position.lng
            },
            dataType: "html",
            success: function (data) {
                if (data.result == "1") {
                    document.location = "/view/res_confirmform.php?id=" + data.id;
                } else {
                    alert("ไม่สามารถบันทึกข้อมูลได้\nError : " + data.error);

                }
                alert(data);
            }
        });
        e.preventDefault();
        return false;
    });


    //Handles menu drop down
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
    });
    $("#backstep").click(function () {
        $("#firststep").fadeIn(500);
        $("#secondstep").hide();
    });

    $("#nextstep").click(function () {
        $("#firststep").hide();
        $("#secondstep").fadeIn(500);
    });

});
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
        $("#showaddress").html('<img src="/assets/images/loader.gif" style="height:30px;">&nbsp;&nbsp;กำลังระบุที่อยู่...');
        marker.setPosition(position);
        map.panTo(position);

        geocoder.geocode({
            latLng: position
        }, function (responses) {
            if (responses && responses.length > 0) {
                setTimeout(function () {
                    $("#resaddress").removeAttr("disabled");
                    $("#resaddress").html("");
                    $("#resaddress").val("");
                    $("#resaddress").val(responses[0].formatted_address);
                    $("#savenewaddressbtn").removeAttr("disabled");
                    $("#showaddress").html("");
                }, 500);
                address = new Array();
                address["full"] = responses[0].formatted_address;
                address["position"] = position;
                $.each(responses[0].address_components, function (i, item) {
                    address[item.types[0]] = item.long_name;
                });
                console.log(address);
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



    var bindInfoWindow = function (marker, map, infowindow, html) {
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(html);
            infowindow.open(map, marker);
        });
    }
}

function checkValidEmail() {
    var emil = $('#resemail').val();
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (!emailReg.test(emil)) {
        $(".errorEmailInvalid").show();
        $("#nextbtn").attr("disabled", "disabled");
    } else {
        $(".errorEmailInvalid").hide();
        $("#nextbtn").removeAttr("disabled");
    }
}

function checkPhone() {

    var emil = $('#resphone').val();
    var emailReg = /^[0-9\+]{1,}[0-9\-]{9,15}$/;
    if (!emailReg.test(emil)) {
        $(".errorPhoneInvalid").show();
        $("#nextbtn").attr("disabled", "disabled");
    } else {
        $(".errorPhoneInvalid").hide();
        $("#nextbtn").removeAttr("disabled");
    }

}

function checkPasswordMatching() {
    var pwd = $("#respassword").val();
    var confirmpwd = $("#resconfirmpwd").val();
    if (pwd != confirmpwd) {
        $(".errorConfirmpwd").show();
        $("#nextbtn").attr("disabled", "disabled");
    } else {
        $(".errorConfirmpwd").hide();
        $("#nextbtn").removeAttr("disabled");
    }
}