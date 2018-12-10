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
      <title>MadBus - real time bus checker</title>
      <script src="jquery.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="assets/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body data-spy="scroll" data-target=".main-nav">
      <a href= "#section-story" class = "navbar-brand" style><i>Don't forget to thank the bus driver </i>😁</a>
      <div class="container"></br></br></div>
      <section id="section-story" class="section-padding">
         <div class="container">
         <div class="row">
            <div class="col-md-12 col-sm-12 pull-left" style="text-align: center; margin-top:5px">
               <div class="container">
                  <form action="" method="post">
                     Find Route: <input name="route" type="text" style = "color: black;"/>
			<div class="container"></br></div>
                     <input name="submit" type="submit" value="Submit" style = "color: black;"/>
                  </form>
                  </br>
               </div>
               <div id="map" style="width: 100%; height: 400px; background: grey" />
                  <script  type="text/javascript" charset="UTF-8" >            
                     function moveMapToMadison(map) {
                     	map.setCenter({
                     		lat: 43.0731,
                     		lng: -89.4012
                     	});
                     	map.setZoom(14);
                     }
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
                     
                     var markerList = [];
                     var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
                     
                     var ui = H.ui.UI.createDefault(map, defaultLayers);
                     moveMapToMadison(map);
                     
                     var markerList = [];
                     var markerBusNum = [];
                     var length = 0;
                     var x = 0;
                     var y = 0;
                     var sf;
                     function showPosition(position) {
                     	x = position.coords.latitude;
                     	y = position.coords.longitude;
                     	console.log(x);
                     	console.log(y);
                     }
                     var ss = "";
                     
                     var busChosen = "<?php 
                        if (isset($_POST['route']))
                        {
                        echo $_POST["route"];
                        }?> ";
                      function getPosition() {
                       $.ajax({
                     url: "proxy.php",
                     type: "GET",
                     success:function(e){
                         console.log(e);
                         return e;
                     }
                     ,
                     error:function(request, status, error) {
                         console.log(error);
                     }
                     });
                     }      
                     function foo(callback) {
                     $.ajax({
                     url: "proxy.php",
                     type: "GET",
                     success:function(e){
                         myCallback(e);
                         
                     }
                     ,
                     error:function(request, status, error) {
                     }
                     });
                     }
                     function myCallback(result) {
                     ss = result;
                     }
                     
                     var var1_obj;
                     function update() {
                     	foo(myCallback); 
                     	if(ss.length != 0){
                     	var1_obj = JSON.parse(ss);     	
                     	if (markerList.length == 0) {
                     			         var lines = '<?php                         
                        				$result = "";
                        				$file = fopen("route.csv", "r");
                        				$line = "";
                        				$count = 0;
                        				while (!feof($file)) {
                        			    		$line = fgetcsv($file);
                            					if($count!=0){
                               						$route = $line[1];
                      							$label = $line[2];
                            						$result = $result . "*" . $route ."," . $label;
                             					}
                             						$count = $count+1;
                        				}
                        				fclose($file);
                       					echo $result;
                        			?>';
                     				var split_routes = lines.split("*");
                     				for(var i = 1; i < split_routes.length; i++){
                     					split_routes[i] = split_routes[i].split(",");
                     				}
                     			for (var i = 0; i < var1_obj.entity.length; i++) {
                     				var lati = var1_obj.entity[i].vehicle.position.latitude;
                     				var lngi = var1_obj.entity[i].vehicle.position.longitude;
                     				var routesIndex = parseInt(var1_obj.entity[i].vehicle.trip.route_id);
                     				var route = 0;
                     				for(var j = 1; j < split_routes.length; j++){
                     					if(routesIndex == split_routes[j][0]){
                     					route = split_routes[j][1];
                     					}
                     				}
                     				var svgMarkup = '<svg  width="24" height="24" xmlns="http://www.w3.org/2000/svg">' +
                     					'<rect stroke="black" fill="${FILL}" x="1" y="1" width="22" height="22" />' +
                     					'<text x="12" y="18" font-size="12pt" font-family="Arial" font-weight="bold" ' +
                     					'text-anchor="middle" fill="${STROKE}" >' + route + '</text></svg>';
                     				
                     				var busIcon = new H.map.Icon(
                     						svgMarkup.replace('${FILL}', 'white').replace('${STROKE}', 'red')),
                     					busMarker = new H.map.Marker({
                     						lat: lati,
                     						lng: lngi
                     					}, {
                     						icon: busIcon
                     					});
                     				
                     				markerList.push(busMarker);
                     				markerBusNum.push(route);
                     				length = markerBusNum.length;
                     				
                     				map.addObject(busMarker);
                     				currPos = new H.map.Marker({
                     					lat: x,
                     					lng: y
                     				});
                     				map.addObject(currPos);
                     				var text = 'Latitude: ${var1_obj.entity[i].vehicle.position.latitude}Id: ${var1_obj.entity[i].id}Alert: ${var1_obj.entity[i].alert}';
                     			}
                     		} else {
                     			for (var i = 0; i < markerList.length; i++) {
                     				markerList[i].setPosition({
                     					lat: var1_obj.entity[i].vehicle.position.latitude,lng: var1_obj.entity[i].vehicle.position.longitude
                     				});
                     			}
                     		}
                     	var svgNewMarkup = '<svg  width="24" height="24" xmlns="http://www.w3.org/2000/svg">' +
                     		'<rect stroke="black" fill="${FILL}" x="1" y="1" width="35" height="35" />' +
                     		'<text x="12" y="18" font-size="12pt" font-family="Arial" font-weight="bold" ' +
                     		'text-anchor="middle" fill="${STROKE}" >' + busChosen + '</text></svg>';
                     
                     	var busNewIcon = new H.map.Icon(svgNewMarkup.replace('${FILL}', 'blue').replace('${STROKE}', 'red'));
                     	for (var element = 0; element < markerBusNum.length; element++) {
                     		if (parseInt(markerBusNum[element]) == busChosen) {
                     			markerList[element].setIcon(busNewIcon);
                     			markerList[element].setZIndex(5);
                     		}
                     	}
                     	}
                     }
                     var t = setInterval(update, 1000);
                     var received = '<?php 
                        $result = "";
                        if (isset($_POST['route']))
                        {
                        $route = $_POST["route"];
                        }
                        $problem = FALSE;
                        if (empty($route)) {
                        	$problem = True;
                        }
                        if ($problem) {
                        	echo "Invalid Arguments";
                        } else {
                        	$file = fopen("ss.csv", "r");
                        	$line = "";
                        	while (!feof($file)) {
                        		$line = fgetcsv($file);
                        		if (strpos($line[19], ',') !== false) {
                        			$pieces = explode(",", $line[19]);
                        			for ($x = 0; $x < count($pieces); $x++) {
                        				if ($pieces[$x] == $route) {
                        					$result = $result.$line[7].
                        					"*".$line[8].
                        					"?";
                        				}
                        			}
                        		} else {
                        			if ($line[19] == $route) {
                        				$result = $result.$line[7].
                        				"*".$line[8].
                        				"?";
                        			}
                        		}
                        	}
                        	fclose($file);
                        	echo $result;
                        }?> ';
                     var stops = received.split("?");
                     var points = [];
                     for (var i = 0; i < stops.length - 1; i++) {
                     	var lati = parseFloat(stops[i].split("*")[0]);
                     	var lngi = parseFloat(stops[i].split("*")[1]);
                     	var stopMarker = new H.map.Marker({
                     		lat: lati,
                     		lng: lngi
                     	});
                     	map.addObject(stopMarker);
                     
                     	points.push(stops[i].split("*")[0] + ',' + stops[i].split("*")[1]);
                     }   
                     function drawLine(point0, point1) {
                     	var routingParameters = {
                     		'mode': 'fastest;car',
                     		'waypoint0': 'geo!' + point0,
                     		'waypoint1': 'geo!' + point1,
                     		'representation': 'display'
                     	};
                     
                     	var onResult = function (result) {
                     		var route,
                     			routeShape,
                     			startPoint,
                     			endPoint,
                     			linestring;
                     		if (result.response.route) {
                     			route = result.response.route[0];
                     			routeShape = route.shape;
                     
                     			linestring = new H.geo.LineString();
                     
                     			routeShape.forEach(function (point) {
                     				var parts = point.split(',');
                     				linestring.pushLatLngAlt(parts[0], parts[1]);
                     			});
                     
                     			startPoint = route.waypoint[0].mappedPosition;
                     			endPoint = route.waypoint[1].mappedPosition;
                     
                     			var routeLine = new H.map.Polyline(linestring, {
                     				style: {
                     					strokeColor: 'blue',
                     					lineWidth: 10
                     				}
                     			});
                     
                     			var startMarker = new H.map.Marker({
                     				lat: startPoint.latitude,
                     				lng: startPoint.longitude
                     			});
                     
                     			var endMarker = new H.map.Marker({
                     				lat: endPoint.latitude,
                     				lng: endPoint.longitude
                     			});
                     
                     			map.addObjects([routeLine, startMarker, endMarker]);
                     			map.addObjects([routeLine, startMarker, endMarker]);
                     
                     			map.setViewBounds(routeLine.getBounds());
                     		}
                     	};
                     
                     	var router = platform.getRoutingService();
                     
                     	router.calculateRoute(routingParameters, onResult,
                     		function (error) {
                     			alert(error.message);
                     		});
                     
                     }
                                          /*
                                          for(var i =0; i<points.length-1; i++){
                                          drawLine(points[i],points[i+1]);
                                          }
                                          */                       
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
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
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

