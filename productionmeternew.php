<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'PRODUCTION METER'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$reffnumber=$_POST['reffnumber'];$reffnumber=addslashes(strtoupper($reffnumber)); $_SESSION['reffnumber']=$reffnumber;
@$location=strtoupper(addslashes($_POST['location']));
@$meterreading=$_POST['meterreading'];$meterreading=addslashes($meterreading);


$x="SELECT * FROM productionmeters  WHERE   refferencenumber='$reffnumber'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

if(mysqli_num_rows($x)>0){$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}




if (($reffnumber !=NULL))
{
$x="SELECT  MAX(id) FROM   productionmeters  ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $id=$y['MAX(id)']+1;	}}
	
$x="INSERT INTO productionmeters(refferencenumber,location,reading,date)
 VALUES('$reffnumber','$location','$meterreading',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'CREATED   NEW PRODUCTION METER ACCOUNT  :$reffnumber',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="METER CREATED"; exit;
}

?>
