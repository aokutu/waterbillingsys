 <html  manifest="maps.manifest" >

<head>
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

      var map = new google.maps.Map(document.getElementById("map"), myOptions); var marker = new google.maps.Marker({
 position: new google.maps.LatLng(-2.259877,40.897374),
 map: map,
});


var infowindow = new google.maps.InfoWindow({
 content:'ACC NO 37600100006'
 });
infowindow.open(map,marker); var marker = new google.maps.Marker({
 position: new google.maps.LatLng(-2.2223,39.0004),
 map: map,
});


var infowindow = new google.maps.InfoWindow({
 content:'ACC NO 37608745680'
 });
infowindow.open(map,marker); var marker = new google.maps.Marker({
 position: new google.maps.LatLng(-2.2443,40.11143),
 map: map,
});


var infowindow = new google.maps.InfoWindow({
 content:'ACC NO 37500302700'
 });
infowindow.open(map,marker);</script> </body></html>