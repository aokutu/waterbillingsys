<?php
session_start();
$_SESSION['token']=$_POST['token'];
if(!isset($_POST['token'])){header("LOCATION:loggin.php"); exit;}
$user =$_POST['user']; $user=addslashes($user);
$password=$_POST['password'];$password=addslashes($password);
$company=$_POST['company']; $_SESSION['company']=$company;
$zone=$_POST['loadedzone']; $_SESSION['zone']=$zone;

$_SESSION['accountstable']='accounts'.$zone;
$_SESSION['billstable']='bills'.$zone;
$_SESSION['meterstable']='meters'.$zone;
$_SESSION['wateraccountstable']='wateraccounts'.$zone;
$_SESSION['statushistorytable']='statushistory'.$zone;
$_SESSION['nonwaterbills']='nonwaterbills'.$zone;
$_SESSION['mastermeters']='mastermeters'.$zone;
$_SESSION['mastermeterbill']='mastermeterbill'.$zone;
if(empty($zone)){header("Location:accessdenied2.php");exit;}
if (!isset($zone)){header("Location:accessdenied2.php");exit;}
if(empty($user)){header("Location:accessdenied2.php");exit;}
if (!isset($user)){header("Location:accessdenied2.php");exit;}
if(empty($password)){header("Location:accessdenied2.php");exit;}
if (!isset($password)){header("Location:accessdenied2.php");exit;}
$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.',$company);
$connect2=mysqli_connect('localhost','lawascoco','Stealmouse@355.','lawascoco_Company');
$x="UPDATE clock SET CURRENTDATE =CURRENT_DATE WHERE CURRENTDATE ='0000-00-00'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT  ZONE FROM zones WHERE NUMBER ='$zone' ";
  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $_SESSION['zonename']=$y['ZONE'];}} 
	/*
$x="SELECT  DATEDIFF(DATE_ADD(CURRENT_DATE, INTERVAL 7 HOUR),LOCKDATE) AS ddays FROM clock";
  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$days=$y['ddays']; if($days >0){ header("LOCATION:resetclock.php");exit;};}}
		*/
	
/* OVER RIDE   LOCK  DATE  CODE ******************
$x="SELECT  DATEDIFF(LOCKDATE,CURRENT_DATE) AS ddays FROM clock";
  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$days=$y['ddays']; if($days <=0){header("LOCATION:trialexpired.php");exit;};}}	
	$_SESSION['days']=$days;
****************************/
	
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  LOGGED ='SUSPEND'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{header("Location:accessdenied3.php");exit;}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
$_SESSION['user']=$user;$_SESSION['password']=$password;$_SESSION['zone']=$zone;
$x="SELECT MAX(ACCOUNT),MIN(ACCOUNT) FROM  accounts$zone";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account1']=$y['MIN(ACCOUNT)'];$_SESSION['account2']=$y['MAX(ACCOUNT)'];}}
 
$_SESSION['date1']=date('Y-m-d');$_SESSION['date2']=date('Y-m-d');
$x="UPDATE users  SET LOGGED='ON' WHERE NAME='$user'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 7 HOUR),'Log in',DATE_ADD(CURRENT_DATE, INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE clock SET CURRENTDATE=CURRENT_DATE";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT  ZONE FROM zones WHERE  NUMBER='$zone'";
  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$zonename=$y['ZONE'];$_SESSION['zonename']=$zonename;}}
		
$x="SELECT * FROM users  WHERE  name='$user' AND password='123456' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{header("Location:resetpassword.php");exit;}	
header("Location:frames.php");
}
else{header("Location:accessdenied2.php");exit;}

?>
