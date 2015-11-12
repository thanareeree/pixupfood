var map, geocoder, marker;
var address = new Array();
var defaultlatlng = {lat: 13.6524931, lng: 100.4938914};
$(document).ready(function () {
    


    function fetchdata() {

        $.ajax({
            url: "/customer/shipaddresslist.php",
            type: "POST",
            dataType: "html",
            success: function (returndata) {
                $(".shiplist").html(returndata);
            }
        });
    }
    fetchdata();

  //initMap();

    $(".deleteadd").click(function (e) {
        var delid = $(this).attr("id");
        var add_id = delid.replace("deleteadd", "");
        $("#showadddel_id").html(add_id);
        $("#delete-addmodal").modal('show');

    });

    $("#deleteaddyes").click(function (e) {
        //$("#deleteaddyes").attr("disabled", "disabled");
        $.ajax({
            url: "/customer/delete-shipping-address.php",
            type: "POST",
            data: {"id": $("#showadddel_id").html()},
            dataType: "html",
            success: function (returndata) {
                if (returndata == "ok") {
                    $("#delete-addmodal").modal('hide');
                    document.location.reload();
                    //fetchdataShowall();

                } else {
                    alert(returndata);
                }

            }
        });
    });
    $(".editadd").click(function (e) {
        var editid = $(this).attr("id");
        var add_id = editid.replace("editadd", "");
        $("#showadd_id").html(add_id);
        $.ajax({
            url: "/customer/shipping-formmodal.php",
            type: "POST",
            data: {"id": add_id},
            dataType: "html",
            success: function (returndata) {
                $("#formeditaddrsss").html(returndata);
                $("#edit_addshipmodal").modal('show'); 
               // $("#map").css("width: 500px, height: 300px")
                initMap();
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






    var bindInfoWindow = function (marker, map, infowindow, html) {
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(html);
            infowindow.open(map, marker);
        });
    }
}

