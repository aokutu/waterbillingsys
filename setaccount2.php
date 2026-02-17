<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
$account=$_POST['account']; $account=strtoupper(addslashes($account));
$x="SELECT *  FROM $accountstable WHERE account='$account'  AND STATUS='CONNECTED' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{while ($y=@mysqli_fetch_array($x))
{$_SESSION['previousreading']=$y['email'];}}

$_SESSION['account']=$account;


$x="SELECT MAX(DATE)  FROM $billstable WHERE ACCOUNT='$account'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$billdate=$y['MAX(DATE)'];$_SESSION['billingdate']=$y['MAX(DATE)'];}}


$x="SELECT LAST_DAY('$billdate')  AS XX,YEAR('$billdate') AS YR,MONTH('$billdate') AS MNTH ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['billdaytwo']=$y['XX'];$yr=$y['YR']; $mnth=$y['MNTH']; if(strlen($mnth)==1){$mnth='0'.$mnth;} $_SESSION['billmonth']=$yr."-".$mnth;$_SESSION['billdayone']=$yr."-".$mnth."-01"; 
	}}	
$_SESSION['month']=$month;
@$_SESSION['account']=$_POST['account'];
$_SESSION['message']=$_SESSION['billdayone']."SEARCHING  ACCOUNT BALANCE";exit;

$_SESSION['message']="ACCOUNT SEARCH"; exit;
?>
