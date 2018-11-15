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
      <!-- Mobile Specific Metas
         ================================================== -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSS
         ================================================== -->
      <!-- Bootstrap -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/animate.css">
      <link rel="stylesheet" href="css/prettyPhoto.css">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body data-spy="scroll" data-target=".main-nav">
      <section id="section-banner">
         <div class="pattern-overlay"></div>
         <div class="container">
            <div class="row">
               <div class="banner-content wow fadeInRight">
                  <h2 class="title"> 
                     <span><font size="200">MadBus!</font></span>	
                  </h2>
                  <a href="#section-contact" class="btn btn-default">CONTACT US</a>
               </div>
            </div>
         </div>
      </section>
      <!-- section menu start -->
      <section class="section-menu">
         <div class="navbar navbar-default main-nav" role="navigation">
         <div>
            <a href="#section-story" class="navbar-brand" style>Home</a>
            <!-- main nav  -->
            <div class="collapse navbar-collapse navigation" id="bs-example-navbar-collapse-1" role="navigation">
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="#section-contact" class="heading-title"><i>Don't forget to thank the bus driver </i>😁</a></li>
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
      </section>
      <!-- section overview end -->
      <!-- section profile start -->
      <section id="section-story" class="section-padding">
         <div class="container">
         <div class="row">
            <div class="col-md-12 col-sm-12 pull-left" style="text-align: center; margin-top:5px">
               <div>
                  <form action="" method="post">
                     Find Route: <input name="route" type="text" />
                     <input name="submit" type="submit" value="Submit"/>
                  </form>
               </div>
               <div id="map" style="width: 100%; height: 400px; background: grey" />
                  <script  type="text/javascript" charset="UTF-8" >
                    var getJSON = function(url, callback) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', url, true);
                        xhr.responseType = 'json';
                        xhr.onload = function() {                      
                            var status = xhr.status;                             
							if (status == 200) {
                                callback(null, xhr.response);
                            } else {
                                callback(status);
                            }
                        };
						xhr.send();
                    };        
                    function moveMapToMadison(map){
						map.setCenter({lat:43.0731, lng:-89.4012});
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
                    defaultLayers.normal.map, {pixelRatio: pixelRatio});
                     
                    var markerList = [];
                    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
                     
                    var ui = H.ui.UI.createDefault(map, defaultLayers);
                    moveMapToMadison(map);
                     
                    var markerList = [];
                    var markerBusNum = [];
                    var length = 0;
                    var x = 0;
                    var y = 0;
                    function getLocation() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(showPosition);
                        } 
						else {
                           console.log("fuck");
                        }
                    }
                    function showPosition(position) {
                        x = position.coords.latitude;
                        y = position.coords.longitude;
                        console.log(x);
                        console.log(y);
                    }
                    getLocation();
                    var routes =[1,2,3,4,5,6,7,8,10,11,12,13,14,15,16,
                    17,18,19,20,21,22,25,26,27,28,29,30,31,32,33,34,35,
                    36,37,38,39,40,44,47,48,49,50,51,52,55,56,57,58,59,
                    63,67,68,70,71,72,73,75,78,80,81,82,84];
                    var busChosen = '<?php 
                        echo $_POST['route'];
                        ?>';
                    function update(){
                    getJSON('http://transitdata.cityofmadison.com/Vehicle/VehiclePositions.json',  function(err, data) {    
                    if (err != null) {
                        console.error(err);
                    } 
                    else if(markerList.length == 0)
					{
                        for(var i = 0; i < data.entity.length;i++){
                     		
                     		var lati = data.entity[i].vehicle.position.latitude;
                     		var lngi = data.entity[i].vehicle.position.longitude;
                     		
                     		var routesIndex = parseInt(data.entity[i].vehicle.trip.route_id)-8052;
                     		var route = routes[routesIndex];
                     		
                     		var svgMarkup = '<svg  width="24" height="24" xmlns="http://www.w3.org/2000/svg">' +
                     		'<rect stroke="black" fill="${FILL}" x="1" y="1" width="22" height="22" />' +
                     		'<text x="12" y="18" font-size="12pt" font-family="Arial" font-weight="bold" ' +
                     		'text-anchor="middle" fill="${STROKE}" >'+route+'</text></svg>';
                     		
                     		var busIcon = new H.map.Icon(
                     		svgMarkup.replace('${FILL}', 'white').replace('${STROKE}', 'red')),
                     		busMarker = new H.map.Marker({lat: lati, lng: lngi },
                     		{icon: busIcon});		
                     		
                     		markerList.push(busMarker);
                         	markerBusNum.push(route);
							length = markerBusNum.length;
                     
                     		map.addObject(busMarker);
                     		currPos = new H.map.Marker({lat: x, lng: y });
                     		map.addObject(currPos);
                            var text = `Latitude: ${data.entity[i].vehicle.position.latitude}
                     		Id: ${data.entity[i].id}
                     		Alert: ${data.entity[i].alert}`
						}
                    } 
                    else
                    {
                     	for(var i = 0; i < markerList.length;i++){
                     		markerList[i].setPosition({lat: data.entity[i].vehicle.position.latitude, lng: data.entity[i].vehicle.position.longitude});
                     	}
                    }
                    });
					var svgNewMarkup = '<svg  width="24" height="24" xmlns="http://www.w3.org/2000/svg">' +
					'<rect stroke="black" fill="${FILL}" x="1" y="1" width="35" height="35" />' +
					'<text x="12" y="18" font-size="12pt" font-family="Arial" font-weight="bold" ' +
					'text-anchor="middle" fill="${STROKE}" >'+busChosen+'</text></svg>';
                     
                    var busNewIcon = new H.map.Icon(svgNewMarkup.replace('${FILL}', 'blue').replace('${STROKE}', 'red'));
                    for (var element = 0; element < markerBusNum.length; element++) {
                        if (markerBusNum[element] == busChosen) {
                            markerList[element].setIcon(busNewIcon);
                            markerList[element].setZIndex(5);
                        }
                    }
                } 
                     var t = setInterval(update,1000);
                     
                     var received  = '<?php 
                        $result = "";
                        $route = $_POST['route'];
                        $problem = FALSE;
                        if(empty($route)){
                        $problem = True;
                        }
                        if($problem){
                           echo "Invalid Arguments";
                        }
                        else {
                        $file = fopen("ss.csv","r");
                        $line = "";
                        while(! feof($file))
                         {
                         $line = fgetcsv($file);
                         if(strpos($line[19], ',') !== false){
                         	$pieces = explode(",", $line[19]);
                         	for ($x = 0; $x < count($pieces); $x++) {
                         		if($pieces[$x] == $route){
                         			$result = $result . $line[7] . "*" . $line[8] . "?";
                         		}
                        	 }
                         }
                         else{
                         	if($line[19] == $route){
                         		$result = $result . $line[7] . "*" . $line[8] . "?";
                        	}
                         }
                        }
                        fclose($file);
                        echo $result;
                        }
                        ?>';
                     console.log(received);
                     var stops = received.split("?");
                     var points = [];
                     for(var i = 0; i< stops.length-1; i++){
                     	var lati = parseFloat(stops[i].split("*")[0]);
                     	var lngi = parseFloat(stops[i].split("*")[1]);
                     	console.log(lati + " " + lngi);
                     	var stopMarker = new H.map.Marker({lat:lati, lng: lngi});
                     	map.addObject(stopMarker);
                     	
                     	points.push(stops[i].split("*")[0]+','+stops[i].split("*")[1]);
                     }
                     
                     
                     function drawLine(point0,point1){
                     var routingParameters = {
                       'mode': 'fastest;car',
                       'waypoint0': 'geo!'+point0,
                       'waypoint1': 'geo!'+point1,
                       'representation': 'display'
                     };
                     
                     var onResult = function(result) {
                       var route,
                         routeShape,
                         startPoint,
                         endPoint,
                         linestring;
                       if(result.response.route) {
                       route = result.response.route[0];
                       routeShape = route.shape;
                     
                       linestring = new H.geo.LineString();
                     
                       routeShape.forEach(function(point) {
                         var parts = point.split(',');
                         linestring.pushLatLngAlt(parts[0], parts[1]);
                       });
                     
                       startPoint = route.waypoint[0].mappedPosition;
                       endPoint = route.waypoint[1].mappedPosition;
                     
                       var routeLine = new H.map.Polyline(linestring, {
                         style: { strokeColor: 'blue', lineWidth: 10 }
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
                       function(error) {
                         alert(error.message);
                       });
                     
                     }
                     console.log(points.length);
                     /*
                     for(var i =0; i<points.length-1; i++){
                      console.log("fuckkkk");
                     drawLine(points[i],points[i+1]);
                     }
                     */
                     
                  </script>
               </div>
            </div>
         </div>
      </section>
      <!-- section profile end -->
      <!-- section testimonial start -->
      <!-- section contact start -->
      <section id="section-contact" class="section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2 class="heading-title">CONTACT US</h2>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 col-sm-6 wow fadeInRight">
                  <div class="contact-form">
                     <form class="contact-box" method="post" name = "contact">
                        <div class="form-group">
                           <label>Name*</label>
                           <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                           <label>Email address*</label>
                           <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                           <label>Message*</label>
                           <input type="text" class="form-control" id="message" name="message">
                        </div>
                        <div class="row">
                           <div class="col-md-12">
								<form>
									<input class="btn btn-default" onclick="Contact()" value="SUBMIT" id = "contact">
								</form>
				</div>
			</div>				            			
                     </form>	
						<script>
                        function sleep(milliseconds) {
                        	var start = new Date().getTime();
                        	for (var i = 0; i < 1e7; i++) {
                        		if ((new Date().getTime() - start) > milliseconds){
									break;
								}
                        	}
                        }
                        function Contact() {
                           	var name = document.forms["contact"]["name"].value;
                           	var email = document.forms["contact"]["email"].value;
                           	var message = document.forms["contact"]["message"].value;
                           	var dataString = 'name1=' + name + '&email1=' + email + '&message1=' + message;
                        	if (name == '' || email == '' || message == '') {
                        	alert("Please Fill All Fields");
                        	} 
							else {
								window.location.href = "Contact.php?w1=\"" + name + "\"&w2=\"" + email + "\"&w3=\"" + message + "\"";
                        	}
                        }
						</script>            			
                  </div>
               </div>
               <div class="col-md-6 col-sm-6 wow fadeInLeft">
                  <div class="contact-left">
                     <p> Got questions or opportunities for us? <br/>Just eave your comments below </p>
                     <div class="location">
                        <p>Credits:</p>
                        <p><i>Kejia Fan</i></p>
                        <p><i>Yao Yao</i></p>
                        <p><i>York Li</i></p>
                        <p><i>Yuxuan Liu</i></p>
                     </div>
                     <ul>
                        <li><span>Email :</span> <a>liu686@wisc.edu</a></li>
                        <li><span>Phone :</span> <a>608-622-5867</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- section contact end -->
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
