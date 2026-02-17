<?php
session_start();
/*
$start=$_SESSION['start'];
if(!isset($start)){header("Location:accessdenied2.php");exit;}
if(empty($start)){header("Location:accessdenied2.php");exit;}*/
?><html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title >LAWASCO </title>
		 <link rel="stylesheet"  href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<link rel="stylesheet" type="text/css" href="stylesheets/mobile.css"/>
			<style type="text/css">
			 #inputs{ background-color:#ADD8E6; border-style:double; border-radius:3%;}
			 .form{border-style:solid;border-radius:2%;width:100%;width:95%; margin-right:1%; margin-left:1%;box-shadow: 10px 10px 10px #000000;padding:2%; }
	
		
			 
			</style>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" >
  $(document).ready(function(){ alert();  
$("#logginform").submit(function (){
var a=$("#name").val();
var b=$("#password").val();
if(a==""){alert("ENTER PASSWORD");return false;}
if(a.match(/^[a-zA-Z0-9+]/)){}else{alert(a+"INVALID ENTRY ");return false;}
if(b==""){alert("REPEAT PASSWORD");return false;}
if(b.match(/^[a-zA-Z0-9+]/)){}else{alert(b+" Password is invalid ");return false;}

if(a!=b){alert("PASSWORDS NOT MATCHING");return false;}
})	
  
 })
  
  </script>


</head>

<body>
     <div class="container">
  <div class="row">
       <div class="col-sm-4" ></div>
    <div class="col-sm-4" id="inputs" >
        <form  action="passwordreset.php" method="post" id="logginform"> 
<br>

<div  id="zones">

</div>
<br>
NEW PASSWORD
		<input type="password"   id="name"class="form-control input-sm" placeholder="PASSWORD"  name="password1" pattern="[0-9A-Za-z]+" title="ENTER ALPHANUMERIC ONLY"  required="on" autocomplete ="off"><br>
REPEAT PASSWORD	<input type="password"  pattern="[0-9A-Za-z]+" title="ENTER ALPHANUMERIC ONLY"  class="form-control input-sm" placeholder="PASSWORD" id="password" name="password2"  required="on" autocomplete ="off"><br>
<button type="submit" class="btn btn-default"  >LOGG IN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
<button type="reset" class="btn btn-default"  >RESET&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
<br><br>
</form>
	</div>
<div class="col-sm-4" ></div>	
	</div>
	</div>




<hr  class="btn-info btn-sm">

</body>
</html>




