<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="baidu-site-verification" content="GR6ucPEbeL" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>
    <link rel="stylesheet" type="text/css" href="http://js.api.here.com/v3/3.0/mapsjs-ui.css" />
    <title>MadBus - real time bus tracker</title>
    <script src="jquery.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body data-spy="scroll" data-target=".main-nav">
<a href= "#section-story" class = "navbar-brand" style><i>Remember to thank the bus driver </i>😁</a>
<div class="container"></br></br></div>
<section id="section-story" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12" style="text-align: center; margin-top:5px">
                <div class="container">
                    <form action="" method="post">
                        Select Route: <input name="route" type="text" style = "color: black;"/>
                        <div class="container"></br></div>
                        <input name="submit" type="submit" value="Submit" style = "color: black;"/>
                    </form>
                    </br>
                </div>
                <div id="map" style="width: 100%; height: 400px; background: grey" />
                <script type="text/javascript" charset="UTF-8" >
                    /* 
                    code for location display, However the development team is poor and cannot afford
                    either an SSL subscription or usage of Google Geolocation API
                    function getLocation() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(showPosition);
                        } else {
                            x.innerHTML = "Geolocation is not supported by this browser.";
                        }
                    }

                    function showPosition(position) {
                        console.log(position.coords.latitude);
                        console.log(position.coords.longitude);
                    }
                    getLocation();
                    */
                    const busChosen = "<?php
                        if (isset($_POST['route']))
                        {
                            echo $_POST["route"];
                        }?> ";
                    foo(callBack, 2);
                    foo(callBack, 3);
                    const shortname = [1,2,3,4,5,6,7,8,10,11,12,13,14,15,16,17,18,19,20,21,22,25,26,27,28,29,30,31,32,33,34,35,36,37
                        ,38,39,40,44,47,48,49,50,51,52,55,56,57,58,59,63,67,68,70,71,72,73,75,78,80,81,82,84];
                    var platform = new H.service.Platform({
                        app_id: 'PDJFmvyexESSMzktjZle',
                        app_code: 'TTRVK2Ip52AywX5o6bcn8w',
                        useHTTPS: true
                    });
                    var pixelRatio = window.devicePixelRatio || 1;
                    var defaultLayers = platform.createDefaultLayers({
                        tileSize: pixelRatio === 1 ? 256 : 512,
                        ppi: pixelRatio === 1 ? undefined : 320
                    });

                    var map = new H.Map(document.getElementById('map'),
                        defaultLayers.normal.map, {
                            pixelRatio: pixelRatio
                        });
                    var ui = H.ui.UI.createDefault(map, defaultLayers);
                    var markerList = [];
                    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

                    var ui = H.ui.UI.createDefault(map, defaultLayers);
                    map.setCenter({
                        lat: 43.0731,
                        lng: -89.4012
                    });
                    map.setZoom(14);
                    var markerList = [];
                    var received = "";
                    var unparsedJSON = "";
                    var tripJSON = "";
                    var stopName = "";
                    function foo(callback, flag, data){
                        var chosen = "chosen=" + busChosen;
                        if(flag == 1){
                            $.ajax({
                                url: "proxy.php",
                                type: "GET",
                                success:function(e){callBack(e, flag);},
                                error:function(request, status, error) {console.log("AJAX error!");}
                            });
                        }
                        else if(flag == 2){
                            $.ajax({
                                url: "stops.php",
                                type: "GET",
                                data: chosen,
                                success:function(e){callBack(e, flag);},
                                error:function(request, status, error) {console.log("AJAX error!");}
                            });
                        }
                        else if(flag == 3){
                            $.ajax({
                                url: "trip.php",
                                type: "GET",
                                success:function(e){callBack(e, flag); },
                                error:function(request, status, error) {console.log("AJAX error!");}
                            });
                        }
                        else if(flag == 4){
                            data = "id=" + data;
                            $.ajax({
                                url: "stopName.php",
                                async: false,
                                type: "GET",
                                data: data,
                                success:function(e){callBack(e, flag);},
                                error:function(request, status, error) {console.log("AJAX error!");}
                            });
                        }
                    }

                    function callBack(result, flag) {
                        if(flag == 1){
                            unparsedJSON = result;
                        }
                        else if (flag == 2){
                            received = result;
                            showStops();
                        }
                        else if (flag == 3){
                            tripJSON = result;
                        }
                        else if (flag == 4){
                            stopName = result;
                        }
                    }

                    const text = 'Latitude: ${parsedJSON.entity[i].vehicle.position.latitude}Id: ${parsedJSON.entity[i].id}Alert: ${parsedJSON.entity[i].alert}';
                    const svgNewMarkup = '<svg  width="24" height="24" xmlns="http://www.w3.org/2000/svg">' +
                        '<rect stroke="black" fill="${FILL}" x="1" y="1" width="35" height="35" />' +
                        '<text x="12" y="18" font-size="12pt" font-family="Arial" font-weight="bold" ' +
                        'text-anchor="middle" fill="${STROKE}" >' + busChosen + '</text></svg>';
                    var busNewIcon = new H.map.Icon(svgNewMarkup.replace('${FILL}', 'blue').replace('${STROKE}', 'red'));
                    var parsedJSON;
                    update();
                    setInterval(update, 1000);
                    function update() {
                        foo(callBack, 1);
                        if(unparsedJSON.length != 0){
                            parsedJSON = JSON.parse(unparsedJSON);
                            if (markerList.length == 0) {
                                for (var i = 0; i < parsedJSON.entity.length; i++) {
                                    const lati = parsedJSON.entity[i].vehicle.position.latitude;
                                    const lngi = parsedJSON.entity[i].vehicle.position.longitude;
                                    const route_id = parsedJSON.entity[i].vehicle.trip.route_id;
                                    const route = shortname[route_id - 8216];
                                    const svgMarkup = '<svg  width="24" height="24" xmlns="http://www.w3.org/2000/svg">' +
                                        '<rect stroke="black" fill="${FILL}" x="1" y="1" width="22" height="22" />' +
                                        '<text x="12" y="18" font-size="12pt" font-family="Arial" font-weight="bold" ' +
                                        'text-anchor="middle" fill="${STROKE}" >' + route + '</text></svg>';

                                    var busIcon = new H.map.Icon(svgMarkup.replace('${FILL}', 'white').replace('${STROKE}', 'red'))
                                    var busMarker = new H.map.Marker({
                                        lat: lati,
                                        lng: lngi
                                    }, {
                                        icon: busIcon
                                    });
                                    busMarker.setData(route);
                                    markerList.push(busMarker);
                                    map.addObject(busMarker);
                                    if(busChosen >= 1 && busChosen <= 84){
                                        for (var element = 0; element < markerList.length; element++) {
                                            if (markerList[element].getData() == busChosen) {
                                                markerList[element].setIcon(busNewIcon);
                                                markerList[element].setZIndex(5);
                                            }
                                        }
                                    }
                                }
                            } else {
                                for (var i = 0; i < markerList.length; i++) {
                                    if(typeof(parsedJSON.entity[i]) != "undefined"){
                                        markerList[i].setPosition({
                                            lat: parsedJSON.entity[i].vehicle.position.latitude,lng: parsedJSON.entity[i].vehicle.position.longitude
                                        });
                                    }
                                }
                            }
                        }
                    }
                    function showStops(){
                        var stops = received.split("?");
                        if(busChosen !== ""){
                            for (var i = 0; i < stops.length - 1; i++) {
                                const lati = parseFloat(stops[i].split("*")[0]);
                                const lngi = parseFloat(stops[i].split("*")[1]);
                                const stopMarker = new H.map.Marker({
                                    lat: lati,
                                    lng: lngi,
                                });
                                stopMarker.setData(stops[i].split("*")[2]);
                                stopMarker.addEventListener('tap', function (evt) {
                                    foo(callBack, 4, evt.target.getData());
                                    var content = stopName + "</br>";
                                    var stopId = 0;
                                    parsedtrip = JSON.parse(tripJSON);
                                    for (var j = 0; j < parsedtrip.entity.length; j++) {
                                        for (var k = 0; k < parsedtrip.entity[j].trip_update.stop_time_update.length; k++) {
                                            //console.log(parsedtrip.entity[j].trip_update.stop_time_update[k]);
                                            //console.log(evt.target.getData());
                                            stopId = parsedtrip.entity[j].trip_update.stop_time_update[k].stop_id;
                                            //console.log(parsedtrip.entity[0].trip_update.stop_time_update[5].stop_id);
                                            if(stopId == evt.target.getData()){
                                                if(parsedtrip.entity[j].trip_update.stop_time_update[k].departure == null){
                                                    var date = new Date(parsedtrip.entity[j].trip_update.stop_time_update[k].arrival.time*1000);
                                                }
                                                else {
                                                    var date = new Date(parsedtrip.entity[j].trip_update.stop_time_update[k].departure.time*1000);
                                                }
                                                var hours = date.getHours();
                                                var minutes = "0" + date.getMinutes();
                                                var seconds = "0" + date.getSeconds();
                                                var routecurrent = shortname[parsedtrip.entity[j].trip_update.trip.route_id - 8216];
                                                var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

                                                content = content + "#" + routecurrent +  " ETA: " + formattedTime + "</br>";
                                                //console.log(routecurrent);
                                                //console.log(formattedTime);
                                            }
                                        }
                                    }
                                    //console.log(formattedTime);
                                    if(typeof(formattedTime) == "undefined"){
                                        content += "<h4>Time estimate not available</h4>";
                                        console.log(evt.target.getData());
                                    }
                                    var bubble =  new H.ui.InfoBubble(evt.target.getPosition(), {
                                        content: content
                                    });
                                    ui.addBubble(bubble);
                                }, false);
                                map.addObject(stopMarker);
                            }
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</section>
<footer id="section-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="socail-link list-inline">
                    <li><a href="images/wechat.jpg"><i class="fa fa-weixin"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://github.com/camppp"><i class="fa fa-github"></i></a></li>
                    <li><a href="http://www.linkedin.com/in/%E5%AE%87%E8%BD%A9-%E5%88%98-669839a5/"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- jQuery (necessary for Bootstrap JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- initialize jQuery Library -->
<script type="text/javascript" src="js/jquery.js"></script>
<!-- Bootstrap jQuery -->
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<!-- PrettyPhoto -->
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<!-- Wow Animation -->
<script type="text/javascript" src="js/wow.min.js"></script>
<!-- singlepagenav -->
<script src="js/jquery.singlePageNav.js"></script>
<!-- Eeasing -->
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<!-- Sticky Menu -->
<script src="js/jquery.sticky.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script>
    $(".main-nav").sticky();
</script>
<!-- Matomo -->
<script type="text/javascript">
    var _paq = _paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//lyuxuan.com/statistics/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<!-- End Matomo Code -->
<script>
    new WOW().init();
</script>
</body>
</html>
