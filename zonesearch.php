<?php
session_start();
$company=$_SESSION['company'];
$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.',$company);
@$zone=$_POST['loadedzone'];
$_SESSION['zone']=$zone;
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED";exit;}

////////////////

$_SESSION['accountstable']='accounts'.$zone;
$_SESSION['billstable']='bills'.$zone;
$_SESSION['meterstable']='meters'.$zone;
$_SESSION['wateraccountstable']='wateraccounts'.$zone;
$_SESSION['statushistorytable']='statushistory'.$zone;
$_SESSION['nonwaterbills']='nonwaterbills'.$zone;
$_SESSION['mastermeters']='mastermeters'.$zone;
$_SESSION['mastermeterbill']='mastermeterbill'.$zone;

$x="SELECT MAX(ACCOUNT),MIN(ACCOUNT) FROM  accounts$zone";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account1']=$y['MIN(ACCOUNT)'];$_SESSION['account2']=$y['MAX(ACCOUNT)'];}}

$x="SELECT  ZONE FROM zones WHERE  NUMBER='$zone'";
  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$zonename=$y['ZONE'];$_SESSION['zonename']=$zonename;}}
$_SESSION['message']=$zonename." ZONE SELECTED";
print $_SESSION['user']. " @ ".$zonename;
//header("LOCATION:mainpage.php");
///////////////////
exit;
?>