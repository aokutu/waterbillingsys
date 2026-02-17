<?php 
session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW BILLS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$account=$_POST['account']; $account=strtoupper(addslashes($account));
if($account==""){$account=1;}
$account=strtoupper(addslashes($account));
if($account >0 )
{
$x="SELECT account FROM $accountstable WHERE account='$account' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ 
	$_SESSION['min2']=$account;
	header("LOCATION:statements.php");exit;}
	else{header("LOCATION:accessdenied4.php");}

}
header("LOCATION:accessdenied4.php");exit;
?>
