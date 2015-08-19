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

    </div>



   
</body>
</html>
