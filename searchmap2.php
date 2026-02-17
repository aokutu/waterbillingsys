<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'GENERATE MAP'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED";exit;}
@$maptype=$_POST['maptype'];


unlink("offlinemap.html");

$x="TRUNCATE TABLE MAPPING  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="select avg(lattitude),avg(longitude) FROM  MAPPING ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $latcenter=round($y['avg(lattitude)'],10);$longcenter=round($y['avg(longitude)'],10);}}
	
	
	//$x="INSERT INTO MAPPING(LATTITUDE,LONGITUDE,ACCOUNT,CLIENT) SELECT  LATTITUDE,LONGITUDE,METERNUMBER,CONCAT('MASTER METER') FROM  $mastermeters ";
	//mysqli_query($connect,$x)or die(mysqli_error($connect));
	
	
	$channels = array();



$a="SELECT NAME  FROM CHANNELS GROUP BY NAME ";
$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
		{
		
		 while ($y=@mysqli_fetch_array($a))
		{
			
		array_push($channels, $y['NAME']);	
			
		}}

	
$x="select avg(lattitude),avg(longitude) FROM  MAPPING ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $latcenter=round($y['avg(lattitude)'],10);$longcenter=round($y['avg(longitude)'],10);}}	
$_SESSION['message']="GENERATDED MAPS";

$mapx = "mapping3.html"; 
 $myFile = fopen($mapx, "w");

fputs($myFile,  ' <html  >

<head>
			
   <script type="text/javascript" 
           src="http://maps.google.com/maps/api/js?sensor=false"></script>
</head> 
<body>

<div style="display:block; width:100%;">
  <div style="width:80%; float: left; display: inline-block;">
  <h3>HADDASSAH SOFTWARE GOOGLEMAPS</h3>
<style type="text/css">
			body{background-color:#ADD8E6 }
			 #map{border-style:solid;border-radius:4%;width:98%; margin-right:1%; margin-left:1%; background-color:#FFFFFF;margin-top:2%;margin-bottom:2%}
			h4{ text-align:center; font-weight:bolder; text-decoration:underline; }
			</style>
			  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" /><link rel="stylesheet"  href="stylesheets/dashboard.css" />

   <div id="map" style="width: 900px; height: 500px"></div> 

   <script type="text/javascript"> 
      var myOptions = {
         zoom: 13,
         center: new google.maps.LatLng("'.$lattitude.'","'.$longitude.'"),
         mapTypeId: google.maps.MapTypeId.HYBRID
      };

      var map = new google.maps.Map(document.getElementById("map"), myOptions);
	   ////////////DRaw lines////////////
	   ');
	
	foreach($channels as $channel)
	{
	fputs($myFile,'var line = new google.maps.Polyline({path: [');
$x="SELECT NAME,LATTITUDE,LONGITUDE FROM  CHANNELS WHERE NAME='".$channel."'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		fputs($myFile, ' new google.maps.LatLng('.$y['LATTITUDE'].','.$y['LONGITUDE'].'),');		
			
		}}
		
	fputs($myFile,'
        
    
    ],
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 1,
    map: map
});  ');
	}
	
		
		
		
	fputs($myFile,'
	  ////////////////////////////
	  
	///////////////////add click to track new  mapping/////////////////////
	
	var infowindow = null;
	google.maps.event.addListener(map, "click", function(e) {
  if (infowindow != null)
    //infowindow.close();

  infowindow = new google.maps.InfoWindow({
    content: "<b>Mouse Coordinates : </b><br><b>Latitude : </b>" + e.latLng.lat() + "<br><b>Longitude: </b>" + e.latLng.lng(),
    position: e.latLng
  });
  $("#lattitude").val(e.latLng.lat());$("#longitude").val(e.latLng.lng());
  
  infowindow.open(map);
});

///////////////////////////////////////////////////////////////////////

var infowindow = null;
	google.maps.event.addListener(map, "click", function(e) {
  if (infowindow != null)
    //infowindow.close();

  infowindow = new google.maps.InfoWindow({
    content: "<b>Mouse Coordinates : </b><br><b>Latitude : </b>" + e.latLng.lat() + "<br><b>Longitude: </b>" + e.latLng.lng(),
    position: e.latLng
  });
  $("#lattitude2").val(e.latLng.lat());$("#longitude2").val(e.latLng.lng());
   $("#lattitude4").val(e.latLng.lat());$("#longitude4").val(e.latLng.lng());
   $("#lattitude6").val(e.latLng.lat());$("#longitude6").val(e.latLng.lng());
  infowindow.open(map);
});

var infowindow = null;
	google.maps.event.addListener(map, "rightclick", function(e) {
  if (infowindow != null)
    //infowindow.close();

  infowindow = new google.maps.InfoWindow({
    content: "<b>Mouse Coordinates : </b><br><b>Latitude : </b>" + e.latLng.lat() + "<br><b>Longitude: </b>" + e.latLng.lng(),
    position: e.latLng
  });
  $("#lattitude3").val(e.latLng.lat());$("#longitude3").val(e.latLng.lng());
  $("#lattitude5").val(e.latLng.lat());$("#longitude5").val(e.latLng.lng());
  infowindow.open(map);
});

	
	///////////////////add mouse move  to track new  mapping/////////////////////
	google.maps.event.addListener(map, "mousemove", function(e) {
  $("#lattitude").val(e.latLng.lat());$("#longitude").val(e.latLng.lng());
  
 
});

///////////////////////////////////////////////////////////////////////	

var infowindow = new google.maps.InfoWindow({
 content:"ACC NO 37600100060<br>CENTER   <br>CENTER"
 }); ');
 
 	$x="select * FROM  $accountstable WHERE LATTITUDE !='' AND LONGITUDE !=''	";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		fputs($myFile, '
var infowindow = new google.maps.InfoWindow({
 content:"METER NUMBER '.$y['account'].'<br>'.$y['client'].'<br>'.$y['status'].'"
 });
infowindow.open(map,marker); var marker = new google.maps.Marker({
 position: new google.maps.LatLng('.$y['lattitude'].','.$y['longitude'].'),icon:"http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
 map: map,
});
');		
			
		}}
		
		
 
 
 fputs($myFile,'
 
infowindow.open(map,marker); var marker = new google.maps.Marker({
 position: new google.maps.LatLng(".$latcenter.",".$longcenter."),
 map: map,
});

var infowindow = new google.maps.InfoWindow({
 content:"ACC NO 21001vvx<br>VIVIAN<br>CONNECTED"
 });
infowindow.open(map,marker); var marker = new google.maps.Marker({
 position: new google.maps.LatLng(-2.3780361162,40.7078731543),
 map: map,
});

infowindow.open(map,marker);</script>
  
  


<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif; text-transform:uppercase;}
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 

* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 50%;
  width: 25%;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 50%;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 70px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
#chathistory
{
	width: 100%; 
	overflow-y: scroll;      
  height: 180px;            //  <-- Select the height of the body
   //position: absolute;	
	
}
</style>
  <script type="text/javascript" >
  $(document).ready(function(){ 
  
  $("#chathistory").load("chathistory.php #chathist");
  
  $("#distcalc").submit(function()
{
$.post( "sessionregistry.php",
$("#distcalc").serialize(),
function(data){
$("#distance").load("distcalc2.php #results");return false;});
return false; 
})

  $("#accountmapping").submit(function()
{$("#prepostmessage").modal("show");
$.post( "accountmapping.php",
$("#accountmapping").serialize(),
function(data){
	$("#content").load("message.php #content");
	$("#prepostmessage").modal("hide"); $("#message").modal("show"); 

//$("#distance").load("distcalc2.php #results");return false;});
return false; 
})

return false;
 })
  })
  
  </script>
  
<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readCountry.php",
		data:"keyword="+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
 
</head>


<form >
MOUSE  POINTER POSITION
  LAT<input type="text"  width="5%" class="form-control input-sm"  id="lattitude">LONG<input width="5%" type="text" class="form-control input-sm"  id="longitude">
 </div>
    <div style="width:20%; float: left; display: inline-block;">
  </form>
  
  
    <form  id="accountmapping" method="post" action="accountmapping.php" >
  LOCK ACCOUNT
  ACCOUNT

  <div class="frmSearch">
ACCOUNT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
<input  style="text-transform:uppercase" name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>

<div id="suggesstion-box"></div>
</div>
  LAT<input type="text" name="latt1" class="form-control input-sm" id="lattitude6">LONG<input name="long1" type="text" class="form-control input-sm"  id="longitude6">
 </div>
    <div style="width:20%; float: left; display: inline-block;">
  
	<button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  </form>
  
  
  <form  id="distcalc" method="post" >
  CALCULATE DISTANCE
  LAT<input type="text" name="latt1" class="form-control input-sm" id="lattitude2">LONG<input name="long1" type="text" class="form-control input-sm"  id="longitude2">
 </div>
    <div style="width:20%; float: left; display: inline-block;">
 
	POINT 2
  LAT<input type="text"  name="latt2" class="form-control input-sm" id="lattitude3">LONG<input type="text" name="long2"  class="form-control input-sm"  id="longitude3">
 </div>
    <div style="width:20%; float: left; display: inline-block;">
	UNITS
	 <label class="checkbox-inline"> 
        <input type="radio" name="units"    value="METERS" >METERS
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="units"    value="KILO METERS"> KILO METERS
     </label> 
	<button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  </form>
  <div id="distance"  >XXXXX</div>
  
   <form  id="lockcordinates" method="post" action="channelmapping.php" >
  LOCK CHANNEL/ROUTE
  <input type="text" name="channel" class="form-control input-sm" id="channel">
  LAT<input type="text" name="latt4" class="form-control input-sm" id="lattitude4">LONG<input name="long4" type="text" class="form-control input-sm"  id="longitude4">
 </div>
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>

  </form>
  
  

  
  
  
  
</div>


 <div class="modal fade" id="prepostmessage" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="prepostcontent"> <img src ="giphy.gif"><h2></div></div></div>
  </div>
 <div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="content"> </div></div></div>
  </div>
 </body></html>
 ');

?>
