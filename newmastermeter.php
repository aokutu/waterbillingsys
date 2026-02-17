 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$meternumber=addslashes(strtoupper($_POST['meternumber']));
@$serialnumber=addslashes(strtoupper($_POST['serialnumber']));
@$location=addslashes(strtoupper($_POST['location']));
@$longittude=addslashes(strtoupper($_POST['longittude']));
@$lattitude=addslashes(strtoupper($_POST['lattitude']));
@$meterreading=addslashes(strtoupper($_POST['meterreading']));
@$date=$_POST['date'];

$x="SELECT number FROM zones  WHERE NUMBER !='$zone' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$mastermeters2='mastermeters'.$i;
	$x="SELECT * FROM  $mastermeters2  WHERE METERNUMBER='$meternumber' OR  SERIALNUMBER ='$serialnumber' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{$_SESSION['message']="MASTER METER ".$meternumber." EXISTS";
 exit;}
		}}
$x="SELECT * FROM $mastermeters WHERE METERNUMBER ='$meternumber'  OR  SERIALNUMBER='$serialnumber'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{$_SESSION['message']="MASTER METER ".$meternumber." EXISTS";exit;}			
$x="INSERT INTO $mastermeters (METERNUMBER,SERIALNUMBER,LOCATION,LONGITUDE,LATTITUDE,READING,DATE) 
	VALUES('$meternumber','$serialnumber','$location','$longittude','$lattitude','$meterreading',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'CREATED  MASTER METER NUMBER $meternumber',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
$_SESSION['message']="MASTER METER ".$meternumber." CREATED";
?>