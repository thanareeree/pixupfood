var map, geocoder, marker;
var address = new Array();
var defaultlatlng = {lat: 13.6524931, lng: 100.4938914};
$(document).ready(function () {


    initMap();


    $("#updateaddbtn").on("click", function (e) {
         var shipid = $("#shipid").val();
        $.ajax({
            type: "POST",
            url: "/customer/edit-shipping-address.php",
            data: {"id": shipid,
                "addtype": $("#addtype").val(),
                "addnaming": $("#addnaming").val(),
                "administrative_area_level_1": address.administrative_area_level_1,
                "sublocality_level_1": address.sublocality_level_1,
                "sublocality_level_2": address.sublocality_level_2,
                "full": $("#address").val(),
                "country": address.country,
                "locality": address.locality,
                "postal_code": address.postal_code,
                "route": address.route,
                "latitude": address.position.lat,
                "longitude": address.position.lng
            },
            dataType: "json",
            success: function (data) {
                if (data.result == "1") {
                   document.location = "/view/cus_customer_profile_shippingAddress.php";
                } else {
                    alert("ไม่สามารถบันทึกข้อมูลได้\nError : " + data.error);
                } //alert(data);
            }
        });
    });

});

function initMap() {
    geocoder = new google.maps.Geocoder();

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: {lat: 13.6524931, lng: 100.4938914}
    });

    marker = new google.maps.Marker({
        position: {lat: 13.6524931, lng: 100.4938914},
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
                    $("#address").removeAttr("disabled");
                    $("#address").html("");
                    $("#address").val("");
                    $("#address").val(responses[0].formatted_address);
                    $("#savenewaddressbtn").removeAttr("disabled");
                    $("#showaddress").html("กรุณาวางมุดในตำแหน่งที่ถูกต้องก่อนแก้ไขข้อมูลที่อยู่");
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
        map.setZoom(14);
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

    function getOldAddress() {
        var shipid = $("#shipid").val();
        $.ajax({
            url: "/order/api/address.php",
            type: "POST",
            dataType: "json",
            data: {"cmd": "getDetail", "id": shipid},
            success: function (data) {
                if (data.result == "1") {
                    var loc = {lat: parseFloat(data.data.latitude), lng: parseFloat(data.data.longitude)};
                    marker.setPosition(loc);
                    map.setCenter(loc);
                    map.setZoom(16);
                } else {
                    alert("Error at get Detail");
                }
            }
        });
    }
    getOldAddress();






    var bindInfoWindow = function (marker, map, infowindow, html) {
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(html);
            infowindow.open(map, marker);
        });
    }
}

