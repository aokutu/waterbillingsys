<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ header("Location:exit.php");exit;}

if($password =='123456'){header("Location:changedefault.php"); exit;}/**/

?>
 
		 <link rel="stylesheet"  href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<link rel="stylesheet" type="text/css" href="stylesheets/mobile.css"/>
			
	<script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" class="" ></script>
<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="pluggins/jquery.client.js"></script>		 <link rel="stylesheet"  href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<link rel="stylesheet" type="text/css" href="stylesheets/mobile.css"/>

	<script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" class="" ></script>
<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="pluggins/jquery.client.js"></script>		 <link rel="stylesheet"  href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<link rel="stylesheet" type="text/css" href="stylesheets/mobile.css"/>
			
	<script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" class="" ></script>
<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="pluggins/jquery.client.js"></script>		 <link rel="stylesheet"  href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			
			
	<script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" class="" ></script>
<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="pluggins/jquery.client.js"></script>
<style>
button{text-align:right; font-size:120%;}
body {
  background-color:white;
}
</style>
<body    scroll="no" style="overflow: hidden" >
<div  id="loggoff" style="text-align:right;" >
 <div class="container">
  <div class="row"><div class="col-sm-1"><img src="logo.png" style="text-align:right;border:5%;border-color:white;" width="120%" height="7%" /></div>
<div class="col-sm-9" style="text-align:center;text-decoration: underline overline;font-size:135%;"  ></div>
<div class="col-sm-2">

</div>
</div>
</div>  
<div>
<iframe align="right"  src="frames.php"  width="100%" height="100%" style="border:0px;">

</iframe>


<div class="modal fade" id="prepostmessage" role="dialog">

  <div class="modal-dialog modal-lg"  >

  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="prepostcontent"> <img src ='giphy.gif'><h2></div></div></div>
  </div>
  <div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="content"> </div></div></div>
  </div>
</body>