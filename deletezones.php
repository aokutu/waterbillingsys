<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ZONE ADMIN' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$zonenumber=$_GET['zone'];

$accounts='accounts'.$zonenumber;$x="DROP TABLE $accounts ";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$bills='bills'.$zonenumber;$x="DROP TABLE $bills ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$statushistory='statushistory'.$zonenumber;$x="DROP TABLE $statushistory ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$wateraccounts='wateraccounts'.$zonenumber;$x="DROP TABLE $wateraccounts ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$nonwaterbills='nonwaterbills'.$zonenumber;$x="DROP TABLE $nonwaterbills ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$mastermeters='mastermeters'.$zonenumber;$x="DROP TABLE $mastermeters ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$mastermeterbill='mastermeterbill'.$zonenumber;$x="DROP TABLE $mastermeterbill ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE clientmetersreg SET ACCOUNT='NOT INSTALLED' ,ZONE =NULL WHERE ZONE='$zonenumber'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('DELETED ZONE',ZONE),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM zones WHERE NUMBER ='$zonenumber' ";
mysqli_query($connect,$x)or die(mysqli_error($connect)); 

$x="DELETE FROM zones WHERE NUMBER='$zonenumber' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));	
header("LOCATION:zoneadmin.php");exit;
?>