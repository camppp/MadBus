<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="baidu-site-verification" content="GR6ucPEbeL" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>
    <script type="text/javascript" src="http://js.api.here.com/v3/3.0/mapsjs-data.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/js/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="http://js.api.here.com/v3/3.0/mapsjs-ui.css" />
    <title>MadBus - real time bus tracker</title>
</head>
<body data-spy="scroll" data-target=".main-nav">
<a href= "#section-story" class = "navbar-brand" style = "white-space: normal;"><i>Remember to thank the bus driver </i>ðŸ˜</a>
<div class="container"></div>
<section id="section-story" class="section-padding">
    <div class="row">
        <div class="col-md-12 col-sm-12" style="text-align: center; margin-top:5px; padding-right: 0px;padding-left: 0px;">
            <div class="container" style = "text-align: center;">
                <form class="form-inline" action="" method="post" style = "margin: 0 auto;">
                    <div style = "margin: 0 auto;">
                        <div class="form-group mb-2">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="SELECT ROUTE" style = "font-weight: bold; font-style: italic;">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input name="route" class="form-control" value="<?php echo isset($_POST['route']) ? $_POST['route'] : NULL; ?>" id="route" placeholder="Route">
                        </div>
                        <button type="submit" name="submit" type="submit" value="Submit" style = "color: white; font-weight: bold;" class="btn btn-primary mb-2">SUBMIT</button>
                        <input type="button" value="Closest Stops" onclick="getClosest();" style = "color: white;" class="btn btn-primary mb-2">
                    </div>
                </form>
            </div>
            <div id="map" style="width: 100%; height: 600px; background: grey"></div>
            <script type="text/javascript" src="js/map.js" charset="UTF-8" ></script>
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
