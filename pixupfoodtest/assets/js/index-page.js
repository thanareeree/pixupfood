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
    
    $("#contactform").on("submit", function (e) {
        $.ajax({
            type: "POST",
            url: "/customer/contact-send-email.php",
            data: {"nameinput": $("#nameinput").val(),
                "emailinput": $("#emailinput").val(),
                "subjectinput": $("#subjectinput").val(),
                "contentinput": $("#contentinput").val()},
            dataType: "json",
            success: function (data) {
               if (data.result == "1") {
                   $("#contactform").trigger("reset");
                    $("#sendemailSuccessModal").modal('show');
                    $("#showdetail").html('<div class="alert alert-success" role="alert"><h4 class="modal-title">ส่งอีเมลล์เรียบร้อยเเล้ว</h4></div>')
                } else {
                      $("#showdetail").html('<div class="alert alert-danger" role="alert"><h4 class="modal-title">'+data.error+'</h4></div>')
                } //alert(data);
            }
        });
        e.preventDefault();
        return false;
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
}
