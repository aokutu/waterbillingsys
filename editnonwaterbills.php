<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'DELETE BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{echo "ACCESS DENIED";exit;}
?>

<meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
	<style>
table{font-size:65%;}
</style>
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
  

<style>
	@media print
    {
		#nonprint{ display: none; }
        #invoice-box { display: block; }
		
    }
</style>
<div style="text-align:center;">
 
  <button class="btn-info btn-sm"  id="printbill" onclick="window.print()">PRINT</button>
</div>
<?php 
@$action=$_POST['action'];
$del=$_POST['del'];

if($action =='DELETE')
{
//////////////
foreach($del as $id)
{
  if($id <1){unset($del[$id]);}
}

foreach($del as $id)
{
$x="SELECT *  FROM  $nonwaterbills    WHERE id=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$acc=$y['account']; $date=$y['date']; $bal=$y['amount']; $meter=$y['meternumber']; $name=$y['name']; }}
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'DELETED NON WATER BILL $name ON ACC $acc;',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

}

foreach($del as $id)
{
$x="DELETE FROM  $nonwaterbills   WHERE id=$id";mysqli_query($connect,$x)or die(mysqli_error($connect));

}

$_SESSION['message']="NON WATER BILLS DELETED";


header("LOCATION:nonwaterbillsreport.php");

exit;
///////////////////	
	
}


else if($action =='PRINT')
{
//////////////
foreach($del as $id)
{
  if($id <1){unset($del[$id]);}
}

foreach($del as $id)
{
$x="SELECT *  FROM  $nonwaterbills    WHERE id=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$acc=$y['account']; $date=$y['date']; $bal=$y['amount']; $meter=$y['meternumber']; $name=$y['name']; }}
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'PRINTED  NON WATER BILL $name ON ACC $acc;',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

}


foreach($del as $id)
{
$x="SELECT *  FROM  $nonwaterbills    WHERE id=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $_SESSION['id']=$id;}}

include("backup/nonwaterbills.php");

}




$_SESSION['message']="NON WATER INVOICE DELETED";

//exit;
///////////////////	
	
}
?>



	    <!-- 	dashboard-->
 
