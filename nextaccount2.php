<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BILLING'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$_SESSION['account'];
	$action=$_POST['action'];
	if ($action =='next')
	{
	$x="SELECT ACCOUNT FROM  $accountstable WHERE  account >'".$_SESSION['account']."'   LIMIT 1 ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account']=$y['ACCOUNT'];}}	
		
	}
	else if ($action =='previous')
	{
	$x="SELECT ACCOUNT FROM  $accountstable WHERE  account <'".$_SESSION['account']."'   ORDER BY ACCOUNT DESC   LIMIT 1 ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account']=$y['ACCOUNT'];}}	
		
	}

header("LOCATION:fieldbilling.php")
?>

