<html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title >HADDAH-PARK-SOFTWARE</title>
		 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<link rel="stylesheet" type="text/css" href="stylesheets/mobile.css"/>
			<style type="text/css">
			 #inputs{ background-color:#ADD8E6; border-style:double; border-radius:3%;}
			 form{border-style:solid;border-radius:2%;width:100%;width:95%; margin-right:1%; margin-left:1%;}
			 img{ width 10%;height 20%;} 
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
<body   onLoad="noBackx();"  oncontextmenu="return false;"  ><hr  class="btn-info btn-sm">
<form  action="main.php" method="post" id="logginform"> 
<br>
 <div class="container">
  <div class="row">
  <div class="col-sm-3" ></div>
    <div class="col-sm-6" id="inputs" ><h3 align="center">HADDAH-PARK </h3>
	COUNTY/TOWN
	<select class="form-control input-sm" required="on" name="company" >
<option value="">SELECT COUNTY</option>
<option value="">KILIFI COUNTY </option>
<option value="">LAMU COUNTY </option>
<option value="">TANA RIVER COUNTY </option>
</select><br>
REGION
<select class="form-control input-sm" required="on" name="company" >
<option value="">SELECT REGION</option>

</select><br>
STREET/AVENUE
<select class="form-control input-sm" required="on" name="company" >
<option value="">SELECT ST./AVE</option>
</select><br>
LANE 
<select class="form-control input-sm" required="on" name="company" >
<option value="">SELECT ST./AVE</option>
</select><br>
<select class="form-control input-sm" required="on" name="company" >
<option value="">SELECT PARKING ID</option>
</select><br>
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ACTION" data-placement="bottom">
     <label class="checkbox-inline"> 
        <input type="radio" name="action"     id="optionsRadios3" 
            value="RESTOCK" >SEARCH
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="action" id="optionsRadios4" 
            value="UN-STOCK">BOOKING
     </label> 
	 </a>

<div  id="zones">
</div>
<br>
<button type="submit" class="btn btn-default"  >LOGG IN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
<button type="reset" class="btn btn-default"  >RESET&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
<br><br>
	</div>
	 <div class="col-sm-3" ></div>
	 
	</div>
	</div>
<br>
</form>
<hr  class="btn-info btn-sm">
<div class="container"  id="footer">
  <div class="row">

  </div></div>
</body>
</html>
