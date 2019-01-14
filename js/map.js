/* 
code for GPS location display, However the development team is poor and cannot 
afford either an SSL subscription or usage of Google Geolocation API

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
var busChosen = document.getElementById("route").value;
ajax(callBack, 2);
ajax(callBack, 3);
// first fetch the JSON stops file from Madison open data and then show the stops

const shortname = [1, 2, 3, 4, 5, 6, 7, 8, 10, 11, 12, 13, 14, 15, 16, 17, 18, 
    19, 20, 21, 22, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 
    40, 44, 47, 48, 49, 50, 51, 52, 55, 56, 57, 58, 59, 63, 67, 68, 70, 71, 72, 
    73, 75, 78, 80, 81, 82, 84];
// All the possible short_names for Madison Transit
var platform = new H.service.Platform({
    app_id: "PDJFmvyexESSMzktjZle",
    app_code: "TTRVK2Ip52AywX5o6bcn8w",
    useHTTPS: true
});
// App ID authentication
var pixelRatio = window.devicePixelRatio || 1;
var defaultLayers = platform.createDefaultLayers({
    tileSize: (pixelRatio === 1) 
    ? 256 : 512,
    ppi: (pixelRatio === 1) 
    ? undefined : 320
});
var map = new H.Map(document.getElementById("map"),
    defaultLayers.normal.map, {
        pixelRatio: pixelRatio
    });
// initialize the map
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
var ui = H.ui.UI.createDefault(map, defaultLayers);
map.setCenter({
    lat: 43.0750,
    lng: -89.4100
});
map.setZoom(14);
// set UI, center and zoom level of map
var markerList = [];
// the set of stop markers on the map
var unparsedJSON = "";
// GPS JSON reveived from Madison Open data
var tripJSON = "";
// JSON stops reveived
var stopName = "";
// the name of the selected stop
const svgNewMarkup = '<svg  width="24" height="24" xmlns="http://www.w3.org/2000/svg">' +
'<rect stroke="black" fill="${FILL}" x="1" y="1" width="35" height="35" />' +
'<text x="12" y="18" font-size="12pt" font-family="Arial" font-weight="bold" ' +
'text-anchor="middle" fill="${STROKE}" >' + busChosen + '</text></svg>';
// the icon for selected buses
var parsedJSON = "";
update();
setInterval(update, 1000);
// sets the bus location update every 1 second. However in reality this parameter
// can be set to 20s because the minimum update interval of bus GPS is 20s

/**
 * displays KML route on the map, receives ajax data and parse
 */
function displayKML(lineStrings) {
    var lineString = 0;
    lineStrings = lineStrings.replace("</MultiGeometry>", "");
    lineStrings = lineStrings.replace("<MultiGeometry>", "");
    lineStrings = lineStrings.substring(0, lineStrings.length - 28);
    //trim stirng beginning and end
    var lines = lineStrings.split("</coordinates></LineString>");
    lines[0] = lines[0].trim();
    for (var i = 0; i < lines.length; i++) {
        lines[i] = lines[i].substring(25, lines[i].length);
        var points = lines[i].split(" ");
        lineString = new H.geo.LineString();
        for (var j = 0; j < points.length; j++) {
            var xy = points[j].split(",");
            lineString.pushPoint(new H.geo.Point(xy[1], xy[0]));
        }
        map.addObject(new H.map.Polyline(
            lineString, {
                style: {
                    lineWidth: 4
                }
            }
        ));
    }
    //console.log(map + " " + lines[11]);
}

/**
 * manages all ajax calls
 * 
 **/
function ajax(callback, flag, data) {
    var chosen = "chosen=" + busChosen;
    if (flag == 1) {
        $.ajax({
            url: "proxy.php",
            type: "GET",
            success: function (e) {
                callBack(e, flag);
            },
            error: function (request, status, error) {
                console.log("AJAX error! Flag:" + flag);
            }
        });
    } else if (flag == 2) {
        $.ajax({
            url: "stops.php",
            type: "GET",
            data: chosen,
            success: function (e) {
                callBack(e, flag);
            },
            error: function (request, status, error) {
                console.log("AJAX error! Flag:" + flag);
            }
        });
    } else if (flag == 3) {
        $.ajax({
            url: "trip.php",
            type: "GET",
            success: function (e) {
                callBack(e, flag);
            },
            error: function (request, status, error) {
                console.log("AJAX error! Flag:" + flag);
            }
        });
    } else if (flag == 4) {
        data = "id=" + data;
        $.ajax({
            url: "stopName.php",
            async: false,
            type: "GET",
            data: data,
            success: function (e) {
                callBack(e, flag);
            },
            error: function (request, status, error) {
                console.log("AJAX error! Flag:" + flag);
            }
        });
    } else if (flag == 5) {
        data = "route=" + data;
        $.ajax({
            url: "parseKML.php",
            type: "GET",
            data: data,
            success: function (e) {
                callBack(e, flag);
            },
            error: function (request, status, error) {
                console.log("AJAX error! Flag:" + flag);
            }
        });
    }
}

/**
 * call back functions for each ajax flag
 * */
function callBack(result, flag) {
    if (flag == 1) {
        unparsedJSON = result;
    } else if (flag == 2) {
        if (busChosen !== "") {
            showStops(result);
        }
    } else if (flag == 3) {
        tripJSON = result;
    } else if (flag == 4) {
        stopName = result;
    } else if (flag == 5) {
        if (busChosen !== ""){
            displayKML(result);
        }
    }
}

/**
 * update the bus postion every second, makes ajax calls to fetch position JSON
 * */
function update() {
    ajax(callBack, 1);
    if (unparsedJSON.length !== 0) {
        parsedJSON = JSON.parse(unparsedJSON);
        if (markerList.length === 0) {
            for (var i = 0; i < parsedJSON.entity.length; i++) {
                const lati = parsedJSON.entity[i].vehicle.position.latitude;
                const lngi = parsedJSON.entity[i].vehicle.position.longitude;
                const route_id = parsedJSON.entity[i].vehicle.trip.route_id;
                const route = shortname[route_id - 8216];
                // hard code for Madison bus special encoding
                var svgMarkup = '<svg  width="24" height="24" xmlns="http://www.w3.org/2000/svg">' +
                    '<rect stroke="black" fill="${FILL}" x="1" y="1" width="22" height="22" />' +
                    '<text x="12" y="18" font-size="12pt" font-family="Arial" font-weight="bold" ' +
                    'text-anchor="middle" fill="${STROKE}" >' + route + '</text></svg>';
                var busIcon = new H.map.Icon(svgMarkup.replace("${FILL}", "white").replace("${STROKE}", "red"));
                var busMarker = new H.map.Marker({
                    lat: lati,
                    lng: lngi
                }, {
                    icon: busIcon
                });
                busMarker.setData(route);
                markerList.push(busMarker);
                map.addObject(busMarker);
                // add the bus markers
                if (busChosen >= 1 && busChosen <= 84) {
                    for (var element = 0; element < markerList.length; element++) {
                        if (markerList[element].getData() == busChosen) {
                            markerList[element].setIcon(new H.map.Icon(svgNewMarkup.replace("${FILL}", "blue").replace("${STROKE}", "red")));
                            markerList[element].setZIndex(5);
                        }
                        // make the selected buses look different
                    }
                }
            }
        } else {
            for (var j = 0; j < markerList.length; j++) {
                if (typeof (parsedJSON.entity[j]) != "undefined") {
                    markerList[j].setPosition({
                        lat: parsedJSON.entity[j].vehicle.position.latitude,
                        lng: parsedJSON.entity[j].vehicle.position.longitude
                    });
                }
                // the actual update function, get called after the first if 
                // every secomd
            }
        }
    }
}

/**
 * displaus the stops information, including the stop name and estimated 
 * arrival time of  buses at this stop
 **/ 
function showStops(received) {
    ajax(callBack, 5, busChosen);
    var stops = received.split("?");
    for (var i = 0; i < stops.length - 1; i++) {
        const lati = parseFloat(stops[i].split("*")[0]);
        const lngi = parseFloat(stops[i].split("*")[1]);
        const stopMarker = new H.map.Marker({
            lat: lati,
            lng: lngi,
        });
        stopMarker.setData(stops[i].split("*")[2]);
        stopMarker.addEventListener("tap", function (evt) {
            // make every bus stop clickable
            ajax(callBack, 4, evt.target.getData());
            var content = stopName + "</br>";
            var stopId = 0;
            parsedtrip = JSON.parse(tripJSON);
            for (var j = 0; j < parsedtrip.entity.length; j++) {
                for (var k = 0; k < parsedtrip.entity[j].trip_update.stop_time_update.length; k++) {
                    stopId = parsedtrip.entity[j].trip_update.stop_time_update[k].stop_id;
                    // get the stop id
                    if (stopId == evt.target.getData()) {
                        var date = 0;
                        if (parsedtrip.entity[j].trip_update.stop_time_update[k].departure === null) {
                            date = new Date(parsedtrip.entity[j].trip_update.stop_time_update[k].arrival.time * 1000);
                        } else {
                            date = new Date(parsedtrip.entity[j].trip_update.stop_time_update[k].departure.time * 1000);
                        }
                        var hours = date.getHours();
                        var minutes = "0" + date.getMinutes();
                        var seconds = "0" + date.getSeconds();
                        var routecurrent = shortname[parsedtrip.entity[j].trip_update.trip.route_id - 8216];
                        var formattedTime = hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);
                        // convert from unix time stamp
                        content = content + "#" + routecurrent + " ETA: " + formattedTime + "</br>";
                    }
                }
            }
            if (typeof (formattedTime) == "undefined") {
                content += "<h4>Time estimate not available</h4>";
                console.log(evt.target.getData());
                // invalid input handling, sometimes Madison Open data doesn't 
                // provide estimated times for many stations (MANY), so
                // this part will come in handy
            }
            var bubble = new H.ui.InfoBubble(evt.target.getPosition(), {
                content: content
            });
            ui.addBubble(bubble);
        }, false);
        map.addObject(stopMarker);
    }
}

