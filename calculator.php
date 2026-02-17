<!doctype html>
<html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title >LAWASCO BILLING SYSTEM</title>
		 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
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
<form   method="post" > 
<br>
 <div class="container">
  <div class="row">
  <div class="col-sm-3" ></div>
    <div class="col-sm-6" id="inputs" ><h3 align="center">W.B.M.I.S </h3>
		<input type="text"   id="name"class="form-control input-sm" placeholder="USER NAME"  name="user" pattern="[0-9A-Za-z]+" title="ENTER ALPHANUMERIC ONLY"  required="on" autocomplete ="off"><br>
	<input type="text"  pattern="[0-9A-Za-z]+" title="ENTER ALPHANUMERIC ONLY"  class="form-control input-sm" placeholder="PASSWORD" id="password" name="password"  required="on" autocomplete ="off"><br>
<button type="button" class="btn btn-default"  >CALCULATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>

	</div>
	 <div class="col-sm-3" ></div>
	 
	</div>
	</div>
<br>
</form>
</body>
</html>
