<?php
session_start();
$start=$_SESSION['start'];
if(!isset($start)){header("Location:accessdenied2.php");exit;}
if(empty($start)){header("Location:accessdenied2.php");exit;}
?><!doctype html>
<html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title >LAWASCO BILLING SYSTEM</title>
		 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<link rel="stylesheet" type="text/css" href="stylesheets/mobile.css"/>
			<style type="text/css">
			 #inputs{ background-color:#ADD8E6; border-style:double; border-radius:3%;}
			 form{border-style:solid;border-radius:2%;width:100%;width:95%; margin-right:1%; margin-left:1%;box-shadow: 10px 10px 10px #000000;padding:2%; }
			 img{ width 10%;height 20%;
			 -webkit-box-reflect: below 0%
			 -webkit-linear-gradient(bottom, white, transparent 40%, transparent); 
			   text-shadow: 0 1px 0 #ccc,
               0 2px 0 #c9c9c9,
               0 3px 0 #bbb,
               0 4px 0 #b9b9b9,
               0 5px 0 #aaa,
               0 6px 1px rgba(0,0,0,.1),
               0 0 5px rgba(0,0,0,.1),
               0 1px 3px rgba(0,0,0,.3),
               0 3px 5px rgba(0,0,0,.2),
               0 5px 10px rgba(0,0,0,.25),
               0 10px 10px rgba(0,0,0,.2)
			 } 
			 h3{ -webkit-box-reflect: below 2px
			 -webkit-linear-gradient(bottom, white, transparent 40%, transparent); 
			   text-shadow: 0 1px 0 #ccc,
               0 2px 0 #c9c9c9,
               0 3px 0 #bbb,
               0 4px 0 #b9b9b9,
               0 5px 0 #aaa,
               0 6px 1px rgba(0,0,0,.1),
               0 0 5px rgba(0,0,0,.1),
               0 1px 3px rgba(0,0,0,.3),
               0 3px 5px rgba(0,0,0,.2),
               0 5px 10px rgba(0,0,0,.25),
               0 10px 10px rgba(0,0,0,.2),
               0 20px 20px rgba(0,0,0,.15);font-family:"Comic Sans MS";			 
			 }
			 
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
var browser=$.client.browser;
//if(browser !='Chrome'){alert("Use Google chrome");$(".input").prop("disabled",true);$(".button").prop("disabled",true);}


 $("#company").click(function()
{
$.post( "selectzones_session.php",
$("#company").serialize(),
function(data){$("#zones").load("selectzones.php #loadedzone");
});  return false;
})

if(screen.width <=480){window.location="/mobileversion/loggin.php";}

$("#name").click( function (){
})
$("#restore").prop("disabled",true);
$( "#tabs" ).tabs();
$(".search").hide();
$(".tbl_container").show();
$("#name").autocomplete({serviceUrl:"/search.php"});
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
<body   onLoad="noBackx();"  oncontextmenu="return false;"  >
<hr  class="btn-info btn-sm">

 <div class="container">
  <div class="row">
  <div class="col-sm-3" ></div>
    <div class="col-sm-5" >
	<h3 align="center">LAWASCO  WATER BILLING SYSTEM </h3>
	</div>
  <div class="col-sm-4" ></div>

  </div>
  </div>
  
  
<hr  class="btn-info btn-sm">
<form  action="main.php" method="post" id="logginform"> 
<br>
 <div class="container">
  <div class="row">
  <div class="col-sm-3" ></div>
    <div class="col-sm-5" id="inputs" ><br>
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

</div>
<br>

		<input type="text"   id="name"class="form-control input-sm" placeholder="USER NAME"  name="user" pattern="[0-9A-Za-z]+" title="ENTER ALPHANUMERIC ONLY"  required="on" autocomplete ="off"><br>
	<input type="password"  pattern="[0-9A-Za-z]+" title="ENTER ALPHANUMERIC ONLY"  class="form-control input-sm" placeholder="PASSWORD" id="password" name="password"  required="on" autocomplete ="off"><br>
<button type="submit" class="btn btn-default"  >LOGG IN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
<button type="reset" class="btn btn-default"  >RESET&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
<br><br>
<h4   align="center" > <strong>ACCOUNT SUSPENDED</strong></h4>
	</div>
	 <div class="col-sm-3" ><img src ="ICON27.jpg"  width="115%"  height="110%" ></div>
	  <div class="col-sm-1" ></div>
	</div>
	</div>
<br>
</form>
<hr  class="btn-info btn-sm">

</body>
</html>
