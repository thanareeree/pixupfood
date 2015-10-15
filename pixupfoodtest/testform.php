<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" >
        <title></title>
    </head>
    <body>
        <div class="container">
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
            <script type="text/javascript">
                var map;
                var mk;
                var x = 13.6415824;
                var y = 100.4963968;
                var cir;
                var infoWindow;
                var isSearch = false;
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
                    } else {
                        alert("not support");
                    }
                }
                function successFunction(position) {
                    x = position.coords.latitude;
                    y = position.coords.longitude;
                    if (mk != null)
                        mk.setMap(null);
                    mk = new google.maps.Marker({position: new google.maps.LatLng(x, y), map: map, draggable: false, animation: google.maps.Animation.DROP});
                    console.log(x + ',' + y);
                    var r = document.getElementById("map-radius").value;
                    setCircle(r);
                }
                function errorFunction() {
                    alert("not support");
                }
                function initialize() {
                    getLocation();
                    var mapOptions = {
                        center: new google.maps.LatLng(x, y),
                        zoom: 15
                    };
                    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
                    infoWindow = new google.maps.InfoWindow();
                    google.maps.event.addListener(map, "click", function (event) {
                        if (!isSearch) {
                            if (mk != null)
                                mk.setMap(null);
                            mk = new google.maps.Marker({position: event.latLng, map: map, draggable: false, animation: google.maps.Animation.DROP});
                            x = event.latLng.lat();
                            y = event.latLng.lng();
                            console.log(x + ',' + y);
                            var r = document.getElementById("map-radius").value;
                            setCircle(r);
                        }
                    });

                }
                google.maps.event.addDomListener(window, 'load', initialize);

                function setCircle(radius) {
                    if (!isSearch) {
                        if (radius.length == 0) {
                            radius = 0.5;
                            $('#map-radius').val(radius);
                        }
                        radius = radius * 1000;
                        if (cir != null)
                            cir.setMap(null);
                        var r = parseInt(radius);
                        cir = new google.maps.Circle({
                            strokeColor: '#FF8F00',
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: '#FF8F00',
                            fillOpacity: 0.35,
                            map: map,
                            center: new google.maps.LatLng(x, y),
                            radius: r
                        });
                        map.setCenter(new google.maps.LatLng(x, y));
                        if (mk != null)
                            search(x, y, r);
                    }
                }
            </script>
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <es:csBreadcrumb page="home"/>
                        <es:csBreadcrumb page="nearby-search" active="true"/>
                    </ul>
                </div>
                <div class="col-xs-12">
                    <h3 class="text-center">กดบนแผนที่เพื่อค้นหาตรงนั้น</h3>
                    <h3 class="text-center">ค้นหาใน: 
                        <input type="number" id="map-radius" onchange="setCircle(this.value);" value="0.5" style="width: 100px"> 
                        กิโลเมตร
                    </h3>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="map-canvas" style="width: 100%;height: 500px"></div>
                        </div>
                        <div class="col-md-12">
                            <h1 class="text-center hidden" id="h1-loader"><i class="fa fa-spin fa-circle-o-notch fa-3x"></i></h1>
                            <div id="div-result-search">
                                <span id="span-result-search"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<img src='/assets/images/loader.gif' style='height:15px; margin:0 auto;'>
    </div>





    <script>
        var markers = [];
        function search(x, y, radius) {
            removeResultSearch();
            $('#h1-loader').removeClass('hidden').hide().slideDown(500);
            isSearch = true;
            $.getJSON('apisrsbl?x=' + x + '&y=' + y + '&radius=' + radius, function (json) {
                isSearch = false;
                $('#h1-loader').slideUp(500);
                $(json).each(function (k, v) {
                    addRestaurant(v);
                });
            });
        }
        function addRestaurant(rs) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(rs.x, rs.y),
                map: map,
                animation: google.maps.Animation.DROP,
                icon: rs.cuisinePic + "-marker.png"
            });
            var cuisineImg = '';
            $(rs.cuisine).each(function (k, cu) {
                cuisineImg += '<span><img src="' + cu.picPath + '" style="width: 25px" alt="' + cu.name + '"></span>';
            });
            var htmlForMap = '<div class="row">' +
                    '<div class="col-sm-6">' +
                    '<img src="' + rs.picPath + '" class="img-responsive">' +
                    '</div>' +
                    '<div class="col-sm-6">' +
                    '<h3 class="text-center">ร้าน "' + rs.name + '"</h3>' +
                    '<div class="text-center"' + cuisineImg + "</div>" +
                    '<dl>' +
                    '<dt>คำอธิบาย</dt>' +
                    '<dd>' + rs.detail + '</dd>' +
                    '</dl>' +
                    '<dl>' +
                    '<dt>ระดับ</dt>' +
                    '<dd>' + rs.star + ' ดาว</dd>' +
                    '</dl>' +
                    '<dl>' +
                    '<dt>ติดต่อ</dt>' +
                    (rs.tel != null ?
                            '<dd><i class="fa fa-phone"></i> ' + rs.tel + '</dd>' : ''
                            ) +
                    (rs.email != null ?
                            '<dd><i class="fa fa-envelope"></i> ' + rs.email + '</dd>' : ''
                            ) +
                    (rs.website != null ?
                            '<dd><i class="fa fa-globe"></i> ' + rs.website + '</dd>' : ''
                            ) +
                    '</dl>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-12">' +
                    '<a href="cvrs?id=' + rs.id + '" class="btn btn-primary btn-block"><i class="fa fa-arrow-right"></i> เข้าสู่หน้าร้าน</button>';
            '</div>' +
                    '</div>';
            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.setContent(htmlForMap);
                infoWindow.open(map, marker);
            });
            var htmlForList =
                    '<div class="col-md-3 col-xs-6">' +
                    '<div class="well fix-h-400">' +
                    '<div class="col-xs-12  fix-h-150" style="overflow-y: hidden;">' +
                    '<a href="cvrs?id=' + rs.id + '">' +
                    '<img src="' + rs.picPath + '" class="img-responsive img-full">' +
                    '</a>' +
                    '</div>' +
                    '<div class="col-xs-12">' +
                    '<h4 class="text-center"><a href="cvrs?id=' + rs.id + '">' + rs.name + '</a></h4>' +
                    '<div class="text-center">' +
                    '<input type="hidden" class="rating" data-filled="fa fa-star text-primary" data-empty="fa fa-star-o text-primary" value="' + (rs.rating - 1) + '" disabled>' +
                    '</div>' +
                    (rs.tel != null ? '<h6 class="help-block"><i class="fa fa-phone"></i> ' + rs.tel + '<h6>' : '') +
                    (rs.email != null ? '<h6 class="help-block"><i class="fa fa-envelope"></i> ' + rs.email + '<h6>' : '') +
                    (rs.website != null ? '<h6 class="help-block"><i class="fa fa-globe"></i> ' + rs.website + '<h6>' : '') +
                    (rs.detail != null ? '<p>' + rs.detail + '</p>' : '') +
                    '</div>' +
                    '</div>' +
                    '</div>';
            $(htmlForList).insertBefore($('#span-result-search'));
            markers.push(marker);
        }
        function removeResultSearch() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
            $('#div-result-search').html('<span id="span-result-search"></span>');
        }
    </script>
</body>
</html>
