<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

<!-- META LIB -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Bij Garage Heuten kunt u terecht voor alle soorten herstellingen en onderhouden van uw auto. Helststraat 53, 2630 Aartselaar - 0497893521">
<meta name="keywords" content="Garage, Heuten, Aartselaar, Auto, Herstellingen, Herstellingen, Onderhoud">
<meta name="author" content="2Schaeferson.be">
<meta name="robot" content="index,follow" />
<meta name="language" content="nl" />
<meta name="revisit-after" content="3 Days" />

<!-- SCRIPT LIB -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" media="only screen and (max-width: 320px)" href="css/style-phone.css" />
<link rel='stylesheet' media='screen and (min-width: 321px) and (max-width: 1280px)' href='css/style-960.css' />
<link rel='stylesheet' media='screen and (min-width: 1281px)' href='css/style-1100.css' />
<link href="img/favicon.ico" rel="icon" type="image/x-icon" />
    
<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.fancybox').fancybox();

    });
</script>

<script type="text/javascript"> 
var $buoop = {}; 
$buoop.ol = window.onload; 
window.onload=function(){ 
 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
 var e = document.createElement("script"); 
 e.setAttribute("type", "text/javascript"); 
 e.setAttribute("src", "//browser-update.org/update.js"); 
 document.body.appendChild(e); 
} 
</script> 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2371667-4', 'garage-heuten.be');
  ga('send', 'pageview');

</script>
<title>Garage Heuten</title>
</head>

<body>
	<div id="nav-stroke">
	<div id="nav">
		<ul>
			<a href="index.html"><li class="selected">Home</li></a>
			<a href="service.html"><li>Service</li></a>
            <a href="racing.html"><li>Racing</li></a>
			<a href="ligging.html"><li>Ligging</li></a>
			<a href="contact.html"><li>Contact</li></a>
		</ul>
    </div>
</div>
<div id="wrapper">
<div id="header">
	<div id="header-left">
    <a href="index.html"><div id="logo"></div></a>
    </div>
    <div id="header-right">
    	<div id="sub-box">
            <div class="sub_box_img"><img src="img/sub_box_snel.jpg" width="155" height="55" /></div>
            <div class="sub_box_title">Snel</div>
            <div class="sub_box_text">Wij werken aan een hoog tempo, zo hoeft u niet lang te wachten op een herstelling of onderhoud.</div>
        </div>
        
	  <div id="sub-box">
		    <div class="sub_box_img"><img src="img/sub_box_types.jpg" width="155" height="55" /></div>
            <div class="sub_box_title">Alle Types</div>
            <div class="sub_box_text">Wij werken aan elk type wagen van elk bouwjaar, zo kan uw oldtimer ook bij ons op herstelling.</div>
		</div>
        
		<div id="sub-box">
            <div class="sub_box_img"><img src="img/sub_box_prijs.jpg" width="155" height="55" /></div>
            <div class="sub_box_title">Beste Prijs</div>
            <div class="sub_box_text">Voor de beste prijs moet u bij ons zijn, zo herstellen wij uw wagen aan een uitstekend tarief.</div>
		</div>
        
  	  <div id="sub-box-last">
            <div class="sub_box_img"><img src="img/sub_box_qualiteit.jpg" width="155" height="55" /></div>
            <div class="sub_box_title">Kwaliteit</div>
            <div class="sub_box_text">De materialen die wij gebruiken zijn van de beste kwaliteit, zo weet u zeker dat de herstelling aan uw wagen nog jaren mee gaat.</div>
        </div>
    </div>
    
</div>
    <div id="content">
        <div id="service-box-container">
            <div id="content-title">Hier kan u ons huidig wagenaanbod bekijken.<br>Voor alle bijkomstige informatie staan wij steeds ter beschikking! <a href="contact.html">Contacteer ons</a>.</div>
            
            <?php
            include 'functions.php';
            include 'config/config.php';
            dbconnect();

            if($connect)
            {
                toon_auto_main();
                mysqli_close($connect);
            }

            else
            {
                die("Kan geen verbinding maken met de database");   
            }
        ?>
            
            
        </div>      
    </div>
    <footer>© Garage Heuten | Design by <a href="http://www.2schaeferson.be">2Schaeferson.be</a></footer>
            
</div>
</body>
</html>
