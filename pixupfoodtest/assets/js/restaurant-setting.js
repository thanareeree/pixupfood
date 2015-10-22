$(document).ready(function () {
    initMap();
    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-warning").addClass("btn-default");
        $(".tab").addClass("active"); // instead of this do the below 
        $(this).removeClass("btn-default").addClass("btn-warning");
    });

    $('#imagerest').on('change', function (e) {
        var filename = $('#imagerest').val();
        var fname = filename.substring(12);
        var name = "File: " + fname;
        $("#uploadtext").html(name);
        $("#chooseimgbtn").hide();
        $("#uploadimgbtn").show();
    });

    $("#switchClose").click(function (e) {
        if ($('#switchClose').is(":checked")) {
            var isClose = 0;
        } else {
            isClose = 1;
        }
        $.ajax({
            type: "POST",
            url: "/restaurant/edit-close-restaurant.php",
            data: {"resId": $("#resIdvalue").val(),
                "close": isClose},
            dataType: "json",
            success: function (data) {
                // $("#switchClose").removeAttr("checked");
                if (data.result == "1") {
                    $("#switchClose").attr('checked', true);
                    //document.location.reload();
                } else if (data.result == "0") {
                    $("#switchClose").removeAttr("checked");
                    $("#switchClose").html()
                } else {
                    alert("ไม่สามารถบันทึกข้อมูลได้\nError : " + data.error);
                }
            }
        });
    });
});

var mapwrapper = document.createElement('div');
mapwrapper.className = 'mapwrapper';
// statement that tests for device functionality
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, error);
} else {
    error('not supported');
}
// Primary function for the Geo location app
function success(position) {
    // create a simple variable for the ID
    var s = document.querySelector('#geostatus');

    if (s.className == 'success') {
        return;
    }

    // Replaces text with new message
    s.innerHTML = "พบตำแหน่งของคุณแล้ว!";
    // Adds new class to the ID status block
    s.className = 'success';

    // creates map wrapper for responsiveness
    var mapwrapper = document.createElement('div');
    mapwrapper.className = 'mapwrapper';

    // creates the block element at sets the width and height
    var mapcanvas = document.createElement('div');
    // Adds ID to the new div
    mapcanvas.id = 'mapcanvas';

    // Adds the new block element as the last thing within the article block
    document.querySelector('.map').appendChild(mapwrapper);

    // Adds the new block element as the last thing within the mapwrapper block
    document.querySelector('.mapwrapper').appendChild(mapcanvas);


    // creates a new variable 'latlng' off of the google maps object
    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

    // create new variable that contains options in key:value pairs
    var myOptions = {
        zoom: 15,
        center: latlng,
        // ROADMAP is set by default, other options are HYBRID, SATELLITE and TERRAIN
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // creates the new 'map' variable using the google object
    // then using the 'mapcanvas' ID appending the options
    var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

    // creates new 'marker' variable
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: "You are here! (at least within a " + position.coords.accuracy + " meter radius)"
    });


}

// Function that displays the error message
function error(msg) {

    // sets simple variable to the status ID
    var s = document.querySelector('#geostatus');
    // designates typ eof message and passes in value                         s.innerHTML = typeof msg == 'string' ? msg : "ไม่สามารถค้นหาตำแหน่งได้";
    s.className = 'fail';
}

function initMap() {
    navigator.geolocation.getCurrentPosition(getUserLocation);
    geocoder = new google.maps.Geocoder();


    function processLocation(position) {

        geocoder.geocode({
            latLng: position
        }, function (responses) {
            if (responses && responses.length > 0) {
                setTimeout(function () {
                    $("#showaddress").html(responses[0].formatted_address);

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

    function getUserLocation(location) {
        var loc = {lat: location.coords.latitude, lng: location.coords.longitude};
        processLocation(loc);
    }

    $("#savenewaddressbtn").on("click", function (e) {
        $.ajax({
            url: "/restaurant-setting/update-address.php",
            type: "POST",
            dataType: "json",
            data: {"administrative_area_level_1": address.administrative_area_level_1,
                "sublocality_level_1": address.sublocality_level_1, "sublocality_level_2": address.sublocality_level_2,
                "full": address.full, "country": address.country,
                "locality": address.locality, "postal_code": address.postal_code, "route": address.route,
                 "latitude": address.position.lat, "longitude": address.position.lng},
            success: function (data) {
                if (data.result == "1") {
                    document.location.reload();
                } else {
                    alert("Error at save Address : " + data.reason);
                }
            }
        });
    });
}




