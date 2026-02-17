<?php
session_start();
$_SESSION['start']='start';
$start=$_SESSION['start'];
if(!isset($start)){header("Location:accessdenied2.php");exit;}
if(empty($start)){header("Location:accessdenied2.php");exit;}
?><!doctype html>
<html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title >HADDASSAH BILLING SOFTWARE</title>
		 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<style type="text/css">
			 #inputs{ background-color:#ADD8E6; border-style:double; border-radius:3%;}
			</style>
	<script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" class="" ></script>
  
	<SCRIPT type="text/javascript">

    window.history.forward();

    function noBack() { window.history.forward(); }

</SCRIPT>
<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="pluggins/jquery.client.js"></script>
<script type="text/javascript"> 
$(document).ready(function()
{

 $("#company").click(function()
{
$.post( "selectzones_session.php",
$("#company").serialize(),
function(data){$("#zones").load("selectzones.php #loadedzone");
});  return false;
})
$( "#tabs" ).tabs();
$(".search").hide();
$(".tbl_container").show();
$("#logginform").submit(function (){
var a=$("#name").val();
var b=$("#password").val();
if(a==""){alert("ENTER USER");return false;}
if(a.match(/^[a-zA-Z0-9+]/)){}else{alert(a+" Name is invalid ");return false;}
if(b==""){alert("ENTER PASSWORD");return false;}
if(b.match(/^[a-zA-Z0-9+]/)){}else{alert(b+" Password is invalid ");return false;}
})

});</script>
</head>
<body   onLoad="noBackx();" >

<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">

<form  action="main.php" method="post" id="logginform"> 

 <div class="container">
  <div class="row">
  <div class="col-sm-3" ></div>
    <div class="col-sm-6" id="inputs" ><h3 align="center">HADDASSAH BILLING	SOFTWARE</h3><br>
		<select class="form-control input-sm" required="on" name="company"  id="company" >
<option value="">SELECT COMPANY</option>
<?php 
$connect=mysqli_connect('localhost','root','','company');

$x="SELECT * FROM company  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	print "<option value='".$y['name']."'>".$y['name']."</option>";		
		$zones=$y['zones'];	
			
		}}

?>

</select><br>

<div  id="zones">
<select class="form-control input-sm"   required="on" >
<option value=''>SELECT  ZONE</option>
</select>

</div><br>
		<input type="text"   id="name"class="form-control input-sm" placeholder="USER NAME"  name="user"  required="on" autocomplete ="off"><br>
	<input type="password"  class="form-control input-sm" placeholder="PASSWORD" id="password" name="password"  required="on" autocomplete ="off"><br>
<button type="submit" class="btn-info btn-lg"  >LOGGIN</button>&nbsp;<button type="reset" class="btn-info btn-lg">RESET</button>
<br><br>
<h4 align="center" >PASSWORD  RESET  LOGGIN NOW!</h4>
	</div>
	 <div class="col-sm-3" ></div>
	</div>
	</div>

</form>
<hr>
</body>
</html>







