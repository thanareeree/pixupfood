var map, geocoder, marker;
var address = new Array();
var defaultlatlng = {lat: 13.6524931, lng: 100.4938914};
$(document).ready(function () {
    initMap();
    $(function () {

        var $sidebar = $("#slider-l"),
                $window = $(window),
                offset = $sidebar.offset(),
                topPadding = 15;
    });
    //Handles menu drop down
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
    });

    /* var lat = 13.6415824;
     var long = 100.4963968;
     function startMap() {
     
     map = new google.maps.Map(document.getElementById("map"));
     if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(getPosition, errorFunction);
     //navigator.geolocation.watchPosition(updatePosition);
     } else {
     alert("ไม่สามารถใช้งาน Search by nearby ได้");
     document.getElementById("latinput").value = "";
     document.getElementById("longinput").value = "";
     }
     }
     
     startMap();
     
     function getPosition(pos) {
     globalPosition = pos;
     lat = pos.coords.latitude;
     long = pos.coords.longitude;
     // alert($("#latinput").val() + "\n" + $("#longinput").val());
     console.log(pos);
     
     }
     
     function errorFunction() {
     alert("ไม่สามารถใช้งาน Search by nearby ได้");
     document.getElementById("latinput").value = "";
     document.getElementById("longinput").value = "";
     }
     
     function showlist() {
     $.ajax({
     url: '/customer/customer-search-nearby.php',
     type: "POST",
     data: {"lat": lat,
     "long": long, "type": "nearby"},
     dataType: "html",
     success: function (returndata) {
     if (returndata == "error") {
     alert("123459859859656");
     } else {
     $("#shownearbylist").append(returndata);
     $('[data-toggle="tooltip"]').tooltip()
     }
     }
     });
     }
     showlist();*/

    $("#searchbtn").click(function (e) {
        var searchkeyword = $("#searchinput").val();
        document.location = "view/search_page.php?search=" + searchkeyword;
    });

    $("#searchinput").on("keyup", function (e) {
        if (e.keyCode == "13") {
            var searchkeyword = $(this).val();
            document.location = "view/search_page.php?search=" + searchkeyword;
        }
    });

});


function initMap() {
    geocoder = new google.maps.Geocoder();

    navigator.geolocation.getCurrentPosition(getUserLocation, errorFunction);
    function getUserLocation(location) {
        var loc = {lat: location.coords.latitude, lng: location.coords.longitude};

        processLocation(loc);
    }

    function errorFunction() {
        $.ajax({
            url: "/customer/customer-search-nearby.php",
            type: "POST",
            dataType: "html",
            data: {"type": "restlist"},
            success: function (returndata) {
                if (returndata == "error") {
                    alert("123459859859656");
                } else {
                    $("#shownearbylist").append(returndata);
                     $("#showtext").html("ร้านอาหาร");
                    $('[data-toggle="tooltip"]').tooltip()
                }

            }
        });
    }

    function processLocation(position) {
        //  $("#showaddress").html('<img src="/assets/images/loader.gif" style="height:30px;">&nbsp;&nbsp;กำลังระบุที่อยู่...');
        // marker.setPosition(position);
        // map.panTo(position);

        geocoder.geocode({
            latLng: position
        }, function (responses) {
            if (responses && responses.length > 0) {

                address = new Array();
                address["full"] = responses[0].formatted_address;
                address["position"] = position;
                $.each(responses[0].address_components, function (i, item) {
                    address[item.types[0]] = item.long_name;
                });
                //console.log(address);


                $.ajax({
                    url: "/customer/customer-search-nearby.php",
                    type: "POST",
                    dataType: "html",
                    data: {"type": "nearby", "lat": address["position"].lat, "long": address["position"].lng},
                    success: function (returndata) {
                        if (returndata == "error") {
                            alert("123459859859656");
                        } else {
                            $("#shownearbylist").append(returndata);
                            $("#showtext").html("ร้านอาหารใกล้ๆ คุณ");
                            $('[data-toggle="tooltip"]').tooltip()
                        }

                    }
                });


            } else {
                alert("No Address Found !");
            }
        });
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
