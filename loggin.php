<?php
session_start();
$logginid= md5(uniqid(mt_rand(), true));

$start=$_SESSION['start'];
if(!isset($start)){header("Location:accessdenied2.php");exit;}
if(empty($start)){header("Location:accessdenied2.php");exit;}
?><html lang="us"><head>
    
     <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
	  <style type="text/css" >
	
  </style>

  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title >LAWASCO </title>
				 <link rel="stylesheet"  href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<link rel="stylesheet" type="text/css" href="stylesheets/mobile.css"/>
			<style type="text/css">
			 #inputs{ background-color:#ADD8E6; border-style:double; border-radius:3%;}
			</style>
			<script>
$(document).ready(function()
{
$("#company").change(function(){
 $.post( "selectcompany.php",
$("#company").serialize(),
function(data){
$("#loadzones").load("selectzone2.php #zonesx");
//location.reload();
});
});



});		</script>
<script type="text/javascript"> 
$(document).ready(function()
{
	window.history.forward();
//if (screen.width <=950) {window.location = "/mobileversion/loggin.php";}

var browser=$.client.browser;
//if(browser !='Chrome'){alert("Use Google chrome");$(".input").prop("disabled",true);$(".button").prop("disabled",true);}
 function redirect() {
   if (screen.width >10 ) {window.location = "https://www.google.com/";}
 }
 

    function noBack()
    {
        window.history.forward();
    }
	
/*$("#company").change(function()
{
$.post( "selectzones_session.php",
$("#company").serialize(),
function(data){$("#zones").load("selectzones.php #loadedzone");
});  return false;
})*/


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
<body><br><br>
     <div class="container">
  <div class="row">
       <div class="col-sm-4"></div>
    <div class="col-sm-4" id="inputs" >

        <form  action="main.php" method="post" id="logginform"><h2 style="text-align:center;">USER LOGGIN</h2><br>
	<select class="form-control input-sm" required="on" name="company"  id="company" >
<option value="">SELECT COMPANY</option>
<option value="lawascoco_Lawasco">LAWASCO HQ</option>
<option value="lawascoco_mokowe">LAWASCO MOKOWE</option>
<option value="lawascoco_shella">LAWASCO SHELLA</option>
<?php
/*
class DBConnection
{
    public $servername = "localhost";
    public $username = "lawascoco";
    public $password = "Stealmouse@355.";

    public $dbname="lawascoco_Company";
	/*
	public $servername = "localhost";
    public $username = "root";
    public $password = "";

    public $dbname="company";
	
    public $conn;
    public function getConnection()
    {
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

        if (mysqli_connect_errno()) {
            printf("Connect failed :", mysqli_connect_error());
            exit();
        } else {
            $this->conn = $conn;
        }
        return $this->conn;
    }
}  
$db = new DBConnection();
$connect = $db->getConnection();
$x="SELECT * FROM company  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	print "<option value='".$y['name']."'>".$y['name']."</option>";		
		//$zones=$y['zones'];	
			
		}}
		*/

?>

</select><br>

<div  id="loadzones">
<select class="form-control input-sm" name="loadedzone" >
<option value=''>SELECT  ZONE</option>

</select>


</div>
<br>
<input type="hidden" name="token"  value ="<?php echo $logginid; ?>"   >
		<input type="text"   id="name"class="form-control input-sm" placeholder="USER NAME"  name="user" pattern="[0-9A-Za-z]+" title="ENTER ALPHANUMERIC ONLY"  required="on" autocomplete ="off"><br>
	<input type="password"  pattern="[0-9A-Za-z]+" title="ENTER ALPHANUMERIC ONLY"  class="form-control input-sm" placeholder="PASSWORD" id="password" name="password"  required="on" autocomplete ="off"><br>
<button type="submit" class="btn btn-default"  >LOGG IN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
<button type="reset" class="btn btn-default"  >RESET&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
<br><br></form>
	</div>
	<div class="col-sm-4"></div>
	
	</div>
	</div>
 
<br>

<br>
</form>


</body>
</html>




