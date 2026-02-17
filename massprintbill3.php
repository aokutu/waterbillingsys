<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once('loggedstatus.php');
include_once('password.php');
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']='ACCESS  DENIED'; header('LOCATION:accessdenied4.php');exit;}
?>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
	<style>
#header{ background-color: #80DCF0; height:400px; }
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;          
  width: 100%;
  position: absolute;
}


	#zoneheader1{ -webkit-box-reflect: below 2px
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
			   text-align:center;
			 
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  	<script type="text/javascript">

    window.history.forward();

    function noBack() { window.history.forward(); }

</script>

<style>
	@media print
    {
		#nonprint{ display: none; }
        #invoice-box { display: block; }
		
    }
</style>
<body  onLoad="noBackx();"  oncontextmenu="return false;"  >
<div style="text-align:center;">
 
  <button class="btn-info btn-sm"  id="printbill" onclick="window.print()">PRINT</button>
</div>
<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
 
@$printbill=$_POST['printbill'];
@$_SESSION['printbill']=$_POST['$printbill'];
$readingdate=$_SESSION['date'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  ACCESS  REGEXP  'BILLING'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


$_SESSION['printbill']=$printbill;

foreach($printbill as $account)
{
  if($account ==""){unset($printbill[$account]);}
}

foreach($printbill as $account)
{
$x="SELECT ACCOUNT  FROM $billstable WHERE ACCOUNT ='$account' AND  DATE <='$readingdate'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1 ){unset($printbill[$account]);}
}


foreach($printbill as $account)
{
 
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'PRINTED BILL ACC :$account',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
include("backup/massprintbill4.php");
 
}

?>
	<div  id="nonprint">



		
		
		</div>
		</body>