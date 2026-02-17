
<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$action=$_POST['action'];
$data=implode(',',$_POST['point']);$zoom=$_POST['zoom'];
$v=rand(0,1000);
$manifest='offlinereport.manifest';
 $myFile = fopen($manifest, "w");
 fputs($myFile,'CACHE MANIFEST
#cache version:'.$v.'
CACHE:
offlinereport2.php
arcgismap.php
FALLBACK:
/ offline.html' ); 

$arcgismap = "arcgismap.php"; 	 $myFile = fopen($arcgismap, "w");
fputs($myFile,'<html>
  <head   manifest="offlinereport.manifest">
    <script type="text/javascript" 
           src="http://maps.google.com/maps/api/js?sensor=false"></script>
</head> 
<body>
   <div id="map" style="width: 1100px; height: 1000px"></div> 

   <script type="text/javascript"> 
      var myOptions = {
         zoom: 8,
         center: new google.maps.LatLng(-2,40),
         mapTypeId: google.maps.MapTypeId.HYBRID
      };

      var map = new google.maps.Map(document.getElementById("map"), myOptions);
	  
	  var marker = new google.maps.Marker({
 position: new google.maps.LatLng(-2, 40),
 map: map,
});


var infowindow = new google.maps.InfoWindow({
 content:"ACC NO 3760014567"
 });
infowindow.open(map,marker);

  var marker = new google.maps.Marker({
 position: new google.maps.LatLng(-2, 38),
 map: map,
});


var infowindow = new google.maps.InfoWindow({
 content:"ACC NO 37709909"
 });
infowindow.open(map,marker);
 
   </script> 
  </body>
</html>');
header("LOCATION:generatemap.php");
?>